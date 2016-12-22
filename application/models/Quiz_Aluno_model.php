<?php

/**
 * Description of Quiz_Aluno_model
 *
 * @author Joao_Paulo
 */
class Quiz_Aluno_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function get_info_quiz_aluno($id_aluno, $id_quiz){
        
        $info_quiz = $this->existe_info($id_aluno, $id_quiz);
        
        if($info_quiz != null){
            return $info_quiz;
        }else{
            $dados = array(
                "id_aluno" => $id_aluno,
                "id_quiz" => $id_quiz
            );
            $this->db->insert('quiz_aluno', $dados);
            
            return $this->get_info_quiz_aluno($id_aluno, $id_quiz);
        }
        
    }
    
    public function crear_se_nao_existe($lista_quiz, $id_aluno) {
        
        foreach ($lista_quiz as $quiz) {
            
            $this->get_info_quiz_aluno($id_aluno, $quiz['id']);
            
        }
        
    }
    
    public function mais_um_acerto($info_quiz){
        
        $novo_acertos = $info_quiz['acertos'] + 1;
        $id = $info_quiz['id'];
        
        $this->db->set('acertos', $novo_acertos);
        $this->db->where('id', $id);
        return $this->db->update('quiz_aluno');
   
    }
    
    public function mais_um_error($info_quiz){
        
        $novo_erros = $info_quiz['erros'] + 1;
        $id = $info_quiz['id'];
        
        $this->db->set('erros', $novo_erros);
        $this->db->where('id', $id);
        return $this->db->update('quiz_aluno');
        
    }
    
    public function atualizar_questao_atual($info_quiz){
        
        $nova_questao_atual = $info_quiz['questao_atual'] + 1;
        $id = $info_quiz['id'];
        
        $this->db->set('questao_atual', $nova_questao_atual);
        $this->db->where('id', $id);
        return $this->db->update('quiz_aluno');
        
    }

    public function atualizar_status($id, $status) {
        
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        return $this->db->update('quiz_aluno');
        
    }
    
    private function existe_info($id_aluno, $id_quiz){
        
        $query = $this->db->query("SELECT * "
                . "FROM `quiz_aluno` WHERE id_aluno = $id_aluno"
                . " and id_quiz = $id_quiz");
        
        if($query != null){
            $info_quiz = $query->row_array();
            return $info_quiz;
        }
        else{
            return null;
        } 
        
    }
    
}
