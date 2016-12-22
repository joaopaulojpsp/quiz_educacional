<?php

/**
 * Description of Quiz_model
 *
 * @author Joao_Paulo
 */

class Quiz_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        
    }
    
    public function inserir_quiz($dados){
        
        $this->db->insert('quiz', $dados);
        
    }
    
    public function get_quiz($id){
        
        //SELECT * FROM `quiz` WHERE id_professor = 1 ORDER BY id DESC LIMIT 1
        
        $query = $this->db->query("SELECT * FROM `quiz` WHERE id_professor = $id ORDER BY id DESC LIMIT 1");
        
        if($query != null){
            $qui = $query->row_array();
            return $qui;
        }
        else{
            return null;
        } 
        
    }
    
    public function get_quiz_editar($id_professor, $id){
        
        //SELECT * FROM `quiz` WHERE id_professor = 1 ORDER BY id DESC LIMIT 1
        
        $query = $this->db->query("SELECT * FROM `quiz` WHERE id_professor = $id_professor "
                . "and  id = $id");
        
        if($query != null){
            $qui = $query->row_array();
            return $qui;
        }
        else{
            return null;
        } 
        
    }
    
    public function get_quiz_slug($slug) {
        
        // comando sql para ter uma lista de quiz
        $sql = "SELECT * FROM quiz WHERE slug = '".$slug."'";
        
        $query = $this->db->query($sql);
        
        if($query != null){
            $quiz = $query->row_array();
            return $quiz;
        }else{
            return NULL;
        }
        
    }
    
    public function get_quizes_prof($id, $ativo){
        
        $query = $this->db->query("SELECT id, nome, disciplina, quant_de_perguntas,"
                . "por_para_passar, date_format(data_inicio, '%d/%m/%Y') as data_inicio,"
                . "date_format(data_fim, '%d/%m/%Y') as data_fim"
                . " FROM `quiz` WHERE id_professor = $id "
                . "and ativo = $ativo ORDER BY id DESC");
        
        if($query != null){
            $quizes = $query->result_array();
            return $quizes;
        }
        else{
            return null;
        }
   
    }
    
    public function get_lista_quiz_aluno($id_escola_ano) {
        
        // comando sql para ter uma lista de quiz
        $sql = "SELECT quiz.id, quiz.nome as nome_do_quiz, quiz.disciplina,".
            " quiz.quant_de_perguntas, quiz.por_para_passar, quiz.slug ,". 
            " professor.nome as nome_do_professor, professor.sobrenome, professor.imagem". 
            " FROM `quiz`, `professor`". 
            " WHERE quiz.id_professor = professor.id".
            " AND quiz.id_escola_ano = ".$id_escola_ano." ORDER BY id DESC LIMIT 15";
            
        
        $query = $this->db->query($sql);
        
        if($query != null){
            $lista_quiz = $query->result_array();
            return $lista_quiz;
        }else{
            return NULL;
        }
        
    }
    
    public function get_lista_quiz_aluno_nao_feito($id_escola_ano, $id_aluno) {
        
        // comando sql para ter uma lista de quiz
        $sql = "SELECT quiz_aluno.status, quiz.nome as nome_do_quiz, quiz.disciplina,".
            " quiz.quant_de_perguntas, quiz.por_para_passar, quiz.slug ,". 
            " professor.nome as nome_do_professor, professor.sobrenome, professor.imagem". 
            " FROM `quiz`, `professor`,`quiz_aluno`". 
            " WHERE quiz.id_professor = professor.id".
            " AND quiz.id_escola_ano = ".$id_escola_ano." AND quiz_aluno.id_aluno = ".$id_aluno.
            " AND quiz_aluno.id_quiz = quiz.id AND (quiz_aluno.status LIKE '%vou%'"
                . " or quiz_aluno.status LIKE '%estou%')";
        
        $query = $this->db->query($sql);
        
        if($query != null){
            $lista_quiz = $query->result_array();
            return $lista_quiz;
        }else{
            return NULL;
        }
        
    }
    
    public function get_lista_quiz_aluno_ja_feito($id_escola_ano, $id_aluno) {
        
        // comando sql para ter uma lista de quiz
        $sql = "SELECT quiz.id, quiz_aluno.status, quiz.nome as nome_do_quiz, "
                . "quiz.disciplina, quiz.quant_de_perguntas, "
                . "quiz.por_para_passar, quiz.slug , "
                . "professor.nome as nome_do_professor, "
                . "professor.sobrenome, professor.imagem "
                . "FROM `quiz`, `professor`,`quiz_aluno` "
                . "WHERE quiz.id_professor = professor.id "
                . "AND quiz.id_escola_ano = ".$id_escola_ano." "
                . "AND quiz_aluno.id_aluno = ".$id_aluno." "
                . "AND quiz_aluno.id_quiz = quiz.id "
                . "AND quiz_aluno.status LIKE '%ja-fiz%' ";
        
        $query = $this->db->query($sql);
        
        if($query != null){
            $lista_quiz = $query->result_array();
            return $lista_quiz;
        }else{
            return NULL;
        }
        
    }
    
    public function pode_inserir($slug){
        
        $query = $this->db->get_where('quiz', array('slug' => $slug), 1);
        $linha = $query->row_array();
        if(sizeof($linha) > 1){
            return false;
        }
        return true;
        
    }
    
    public function atualizar_quiz($id, $dados){
        
        
        $this->db->set('nome', $dados['nome']);
        $this->db->set('disciplina', $dados['disciplina']);
        $this->db->set('quant_de_perguntas', $dados['quant_de_perguntas']);
        $this->db->set('por_para_passar', $dados['por_para_passar']);
        
        $this->db->where('id', $id);
        
        return $this->db->update('quiz');
        
    }
    
    public function quiz_ehdo_professor($id_quiz, $id_professor) {
        
        $matriz = array(
            'id'=>$id_quiz,
            'id_professor'=>$id_professor
        );
        
        $query = $this->db->get_where('quiz', $matriz, 1);
        $linha = $query->row_array();
        if(sizeof($linha) > 1){
            return true;
        }
        return false;
    }
    
    public function excluir_quiz($id) {
        
        $this->db->where('id', $id);
        $exclui = $this->db->delete('quiz');
        
        if($exclui){
            //Aqui pode retorna true ou false
            $this->load->model("Pergunta_model","pergunta");
            $p = $this->pergunta;
            return $p->deletar_pergunta_quiz($id);
            
        }
        return false;
        
    }
    

    
}
