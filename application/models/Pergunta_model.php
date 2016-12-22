<?php

/**
 * Description of Pergunta_model
 *
 * @author Joao_Paulo
 */
class Pergunta_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        
    }
    
    public function inserir_pergunta($dados){
        
        $this->db->insert('pergunta', $dados);
        
    }
    
    public function get_perguntas($id_quiz){
        
        $query = $this->db->query("SELECT * "
                . "FROM `pergunta` WHERE id_quiz = $id_quiz "
                . "ORDER BY id DESC");
        
        if($query != null){
            $perguntas = $query->result_array();
            return $perguntas;
        }
        else{
            return null;
        } 
    }
    
    public function get_perguntas_slug($slug) {
        
        $sql = "SELECT * FROM pergunta". 
	" WHERE id_quiz = (SELECT id FROM quiz WHERE slug = '".$slug."')";
        
        $query = $this->db->query($sql);
        
        if($query != null){
            $lista_pergunta = $query->result_array();
            return $lista_pergunta;
        }
        else{
            return null;
        } 
        
    }
    
    public function get_pergunta_especifica($id){
        
        $query = $this->db->query("SELECT * "
                . "FROM `pergunta` WHERE id = $id ");
        
        if($query != null){
            $pergunta = $query->row_array();
            return $pergunta;
        }
        else{
            return null;
        } 
    }
    
    public function atualizar_pergunta($id, $dados){
        
        
        $this->db->set('pergunta', $dados['pergunta']);
        $this->db->set('op_a', $dados['op_a']);
        $this->db->set('op_b', $dados['op_b']);
        $this->db->set('op_c', $dados['op_c']);
        $this->db->set('resposta', $dados['resposta']);
        
        $this->db->where('id', $id);
        
        return $this->db->update('pergunta');
        
    }
    
    public function deletar_pergunta($id){
        
        $this->db->where('id', $id);
        return $this->db->delete('pergunta');
        
    }
    
    public function deletar_pergunta_quiz($id_quiz){
        
        $this->db->where('id_quiz', $id_quiz);
        return $this->db->delete('pergunta');
        
    }

    public function get_id_quiz($id_pergunta){

        $query = $this->db->query("SELECT id_quiz "
                . "FROM `pergunta` WHERE id = $id_pergunta ");

        if($query != null){
            $pergunta = $query->row_array();
            return $pergunta['id_quiz'];
        }
        else{
            return 0;
        } 
        
    }
    
}
