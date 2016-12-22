<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Todas as funções de ajax vai ficar aqui
 *
 * @author Joao_Paulo
 */
class Ajax extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Escola_Ano_Model','escola');
       
    }
    
    public function carregar_escola() {
        
        $nomes_escolas = $this->escola->carregar_escola();
        
        $nomes = '';
        $ensinos = null;
        $ht_ensinos = '';
        $anos = null;
        $ht_anos = '';
            
        $nomes = $this->tranforma_opcao($nomes_escolas);
        $nome = $nomes_escolas[0];
        
        $ensinos = $this->escola->carregar_ensino($nome);        
        $anos = $this->escola->carregar_ano($nome);
        
        $html_id = $this->tranforma_opcao_2($nome,$ensinos, $anos);
        
        $ht_ensinos = $html_id['ht_ensinos'];
        $ht_anos = $html_id['ht_anos'];
        
        $data = array(
            'nomes' => $nomes,
            'ht_ensinos' => $ht_ensinos,
            'ht_anos' => $ht_anos,
            'id' => $html_id['id']
        );
        
        //Either you can print value or you can send value to database
        echo json_encode($data);
    }
    
    
    public function mudar_escola() {
        
        $escola = $_POST['nome_escola'];
        
        $ensinos = $this->escola->carregar_ensino($escola);
        $anos = $this->escola->carregar_ano($escola);
        
        $html_id = $this->tranforma_opcao_2($escola, $ensinos, $anos);
        
        $data = $html_id;
        
        //Either you can print value or you can send value to database
        echo json_encode($data);
    }
    
    public function mudar_ensino_ou_ano() {
        
        $escola = $_POST['nome_escola'];
        $ensino = $_POST['ensino'];
        $ano = $_POST['ano'];
        
        $id = $this->escola->selecione_Id($escola, $ensino, $ano);
        
         $data = array(
            'id' => $id
        );
        
        echo json_encode($data); 
    }
    
    
    //Função que transforma array em coleção de option para select html
    public function tranforma_opcao($nomes) {
        
        $html = '';
        
        foreach ($nomes as $nome) {
            $html .= '<option value="'.$nome.'">';
            $html .= $nome;
            $html .= '</option>';
         }
        
        return $html;
    }
    
    //Função que transforma array em coleção de option para select html
    public function tranforma_opcao_2($escola,$ensinos, $anos) {
        
        //Variavel que vai guarda dois array de string e um id
        $html = array();
        
        $ht_ensinos = '';
        foreach ($ensinos as $ensino) {
            $ht_ensinos .= '<option value="'.$ensino.'">';
            $ht_ensinos .= $ensino;
            $ht_ensinos .= '</option>';
         }
         
        $ht_anos = '';
        foreach ($anos as $ano) {
            $ht_anos .= '<option value="'.$ano.'">';
            $ht_anos .= $ano;
            $ht_anos .= '</option>';
        }
        
        $id =  $this->escola->selecione_Id($escola, $ensinos[0], $anos[0]);
        $html['id'] = $id;
        $html['ht_ensinos'] = $ht_ensinos;
        $html['ht_anos'] = $ht_anos;
       
        return $html;
    }
    
    
}
