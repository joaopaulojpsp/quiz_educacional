<?php
/**
 * Description of Escola_Ano_Model
 *
 * @author Joao_Paulo
 */
class Escola_Ano_Model extends CI_Model{
 
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        
    }
    
    public function inserir_escola_ano($dados) {
        
        $sql = "SELECT * FROM `escola_ano` WHERE nome_escola = '".$dados['nome_escola']."'"
                . " AND ensino = '".$dados['ensino']."' AND ano = '".$dados['ano']."' ";
        
        $query = $this->db->query($sql);
        $consulta = $query->row_array();
        if(sizeof($consulta) > 0){
            return false;
        } else {
            return $this->db->insert('escola_ano', $dados);
        }
        
    }
    
    public function selecione_Id($escola, $ensino, $ano) {
        
        $dados = array(
          'nome_escola' => $escola,
          'ensino' => $ensino,
          'ano' => $ano
        );
        
        $this->db->select('id');
        $query = $this->db->get_where('escola_ano',$dados, 1);
        
        if($query != null){
            $quarda_id = $query->row_array();
            return $quarda_id['id'];
        }
        return 0;
    }
    
    public function carregar_escola() {
        
        $sql = 'SELECT DISTINCT nome_escola FROM `escola_ano` ORDER BY id DESC';
        $query = $this->db->query($sql);
        
        if($query != NULL){
            $escolas = $query->result_array();
            $nomes_escolas = array();
            foreach ($escolas as $escola){
                
                $nomes_escolas[] = $escola['nome_escola'];
            }
            
            return $nomes_escolas;
        }
        
        return null;
    }
    
    public function carregar_ensino($nome_escola) {
        
        $sql = 'SELECT DISTINCT ensino FROM `escola_ano` where nome_escola = "'.$nome_escola.'"';
        $query = $this->db->query($sql);
        
        if($query != NULL){
            $escolas = $query->result_array();
            $ensinos = array();
            foreach ($escolas as $escola){
                $ensinos[] = $escola['ensino'];
            }
            return $ensinos;
        }
        return null;
        
    }
    
    public function carregar_ano($nome_escola) {
        
        $sql = 'SELECT ano FROM `escola_ano` where nome_escola = "'.$nome_escola.'"';
        $query = $this->db->query($sql);
        
        if($query != NULL){
            $escolas = $query->result_array();
            $anos = array();
            foreach ($escolas as $escola){
                $anos[] = $escola['ano'];
            }
            return $anos;
        }
        return null;
        
    }
    
}