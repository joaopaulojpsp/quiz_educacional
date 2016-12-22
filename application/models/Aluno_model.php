<?php

/**
 * Description of Aluno_model
 *
 * @author Joao_Paulo
 */
class Aluno_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    //Função private
    private function verificar_email($email){
        
        $query = $this->db->get_where('aluno', array('email' => $email), 1);
        $linha = $query->row_array();
        if(sizeof($linha) > 1){
            return false;
        }
        return true;
        
    }
    //fim
    
    
    public function registra_aluno($dados){
        
        $pode_registra = Aluno_model::verificar_email($dados['email']);
        
        if($pode_registra){
            $this->db->insert('aluno', $dados);
            return true;
        }
        return false;
        
    }
    
    public function logar_aluno($email) {
        
        $query = $this->db->get_where('aluno', array('email' => $email), 1);
        if($query != null){
            $aluno = $query->row_array();
            return $aluno;
        }
        return null;
    }
    
    
    public function atualizar_perfil($id, $dados) {
        
        $this->db->set('nome', $dados['nome']);
        $this->db->set('sobrenome', $dados['sobrenome']);
        $this->db->set('senha', $dados['senha']);
        $this->db->set('status', $dados['status']);
        
        $this->db->where('id', $id);
        
        return $this->db->update('aluno');
        
    }
    
     public function atualizar_imagem($id, $nomeImagem){
        
        $this->db->set('imagem', $nomeImagem);
        
        $this->db->where('id', $id);
        
        return $this->db->update('aluno');
    }
    
    public function addPontos($id_aluno, $pontos_atual, $pontos_ganhos){
        
        $pontos = $pontos_atual + $pontos_ganhos;
        
        $this->db->set('pontos', $pontos);
        
        $this->db->where('id', $id_aluno);
        
        return $this->db->update('aluno');
        
    }
    
}
