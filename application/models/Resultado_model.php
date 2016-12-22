<?php

/**
 * Description of Resultado_model
 *
 * @author Joao_Paulo
 */
class Resultado_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function acertou($id_aluno, $id_pergunta, $id_quiz) {
        
        $dados = array(
            'id_aluno' => $id_aluno,
            'id_pergunta' => $id_pergunta,
            'id_quiz' => $id_quiz,
            'acertou' => TRUE
        );
        
        $id = $this->existe_id($id_aluno, $id_pergunta);
        if($id == 0){
            
            $this->db->insert('resultado', $dados);
        }
        else{
            
            $this->db->set('acertou', $dados['acertou']);
            $this->db->where('id', $id);
            $this->db->update('resultado');
        }
    }
    
    public function errou($id_aluno, $id_pergunta, $id_quiz){
        
        $dados = array(
            'id_aluno' => $id_aluno,
            'id_pergunta' => $id_pergunta,
            'id_quiz' => $id_quiz,
            'acertou' => FALSE
        );
        
       $id = $this->existe_id($id_aluno, $id_pergunta);
        if($id == 0){
            
            $this->db->insert('resultado', $dados);
        }
        else{
            
            $this->db->set('acertou', $dados['acertou']);
            $this->db->where('id', $id);
            $this->db->update('resultado');
        }
        
    }
    
    private function existe_id($id_aluno, $id_pergunta){
        
        $dados = array(
            'id_aluno' => $id_aluno,
            'id_pergunta' => $id_pergunta
        );
        
        $query = $this->db->get_where('resultado', $dados, 1);
        $linha = $query->row_array();
        if(sizeof($linha) > 1){
            return $linha['id'];
        }
        return 0;
    }
    
    
}
