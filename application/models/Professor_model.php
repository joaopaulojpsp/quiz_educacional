<?php

/**
 * Description of Professor_model
 *
 * @author Joao_Paulo
 */

class Professor_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    private function verificar_email($email){
        
        $query = $this->db->get_where('professor', array('email' => $email), 1);
        $linha = $query->row_array();
        if(sizeof($linha) > 1){
            return false;
        }
        return true;
        
    }
    
    public function registra_Professor($dados){
        
        $pode_registra = Professor_model::verificar_email($dados['email']);
        
        if($pode_registra){
            $this->db->insert('professor', $dados);
            return true;
        }
        return false;
        
    }
    
    public function logar_Professor($email){
        
        $query = $this->db->get_where('professor', array('email' => $email), 1);
        if($query != null){
            $professor = $query->row_array();
            return $professor;
        }
        return null;
        
    }
    
    public function atualizar_perfil($id, $dados){
        
        
        $this->db->set('nome', $dados['nome']);
        $this->db->set('sobrenome', $dados['sobrenome']);
        $this->db->set('senha', $dados['senha']);
        $this->db->set('formacao', $dados['formacao']);
        
        $this->db->where('id', $id);
        
        return $this->db->update('professor');
        
    }
    
    public function atualizar_imagem($id, $nomeImagem){
        
        $this->db->set('imagem', $nomeImagem);
        
        $this->db->where('id', $id);
        
        return $this->db->update('professor');
    }
    
    
    
}
