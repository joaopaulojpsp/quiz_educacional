<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of EntraNoQuiz
 *
 * @author Joao_Paulo
 */
class EntraNoQuiz extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("funcao"));
          
    }

    public function index(){
        
       $this->load->view('home/header');
       $this->load->view('home/main');
       $this->load->view('home/footer');
        
    }
    
    public function login_ou_registra_professor() {
        
        if(isset($this->session->professor)){
            $this->session->unset_userdata('professor');
        }
        
        $this->load->view('professor/login-ou-registra');
    }
    
    public function registra_professor(){
        $this->load->model("Professor_model","professor");
        
        $dados = $_POST;
        $password = $dados['senha'];
        $dados['senha'] = funcao::criptografiar($password); 
         
        $registrou = $this->professor->registra_professor($dados);
        if($registrou){  
            redirect("EntraNoQuiz/fazer_login_professor");
        }
        else{
            $mensagem = "E-mail já existe, tente com outro e-mail";
            $tipo = "alert-warning";
            $dados = array('mensagem'=>$mensagem, "tipo"=>$tipo);
            $this->load->view('professor/login-ou-registra',$dados);
        }
        
        
    }
    
    public function fazer_login_professor(){
        
        $mensagem = "Registro feito com sucesso!";
        $dados = array('mensagem'=>$mensagem);
	$this->load->view('professor/login-ou-registra',$dados);
        
    }
    
    public function logar_professor(){
        $this->load->model("Professor_model","professor");
        
        
        $email = $_POST['email'];
        $password = funcao::criptografiar($_POST['senha']);
        $senha = $password;
        
        $professor = $this->professor->logar_professor($email);
        if($professor != null){
            if($professor['senha'] == $senha){
                
                $this->session->set_userdata('professor', $professor);
                redirect("Painel_Professor");   
            }else{
                $mensagem = "Senha incorreta!";
                $tipo = "alert-danger";
                $dados = array('mensagem'=>$mensagem,'tipo'=>$tipo);
                $this->load->view('professor/login-ou-registra',$dados);
            }
        }else{
            $mensagem = "Email não existe! Faça o Registro!";
            $tipo = "alert-info";
            $dados = array('mensagem'=>$mensagem,'tipo'=>$tipo);
            $this->load->view('professor/login-ou-registra',$dados);
            
        }  
    }//Fim das funções do professor
    
    //Começa as funções do aluno
    public function login_ou_registra_aluno() {
        
        if(isset($this->session->professor)){
            $this->session->unset_userdata('professor');
        }
        
        $this->load->view('aluno/login-ou-registra');
    }
    // Fazer login
    public function fazer_login_aluno(){
        
        $mensagem = "Registro feito com sucesso!";
        $dados = array('mensagem'=>$mensagem);
	$this->load->view('aluno/login-ou-registra',$dados);
        
    }
    //Logar aluno
    public function logar_aluno(){
        
        $this->load->model("Aluno_model","aluno");
        
        
        $email = $_POST['email'];
        $password = funcao::criptografiar($_POST['senha']);
        $senha = $password;
        
        $aluno = $this->aluno->logar_aluno($email);
        if($aluno != null){
            if($aluno['senha'] == $senha){
                
                $this->session->set_userdata('aluno', $aluno);
                redirect("Painel_Aluno");
            }else{
                $mensagem = "Senha incorreta!";
                $tipo = "alert-danger";
                $dados = array('mensagem'=>$mensagem,'tipo'=>$tipo);
                $this->load->view('aluno/login-ou-registra',$dados);
            }
        }else{
            $mensagem = "Email não existe! Faça o Registro!";
            $tipo = "alert-info";
            $dados = array('mensagem'=>$mensagem,'tipo'=>$tipo);
            $this->load->view('aluno/login-ou-registra',$dados);
            
        }  
        
    }

    public function registra_aluno() {
        
        $this->load->model("Aluno_model","aluno");
        
        $dados = $_POST;
        $password = $dados['senha'];
        $dados['senha'] = funcao::criptografiar($password); 
         
        $registrou = $this->aluno->registra_aluno($dados);
        if($registrou){  
            redirect("EntraNoQuiz/fazer_login_aluno");
        }
        else{
            $mensagem = "E-mail já existe, tente com outro e-mail";
            $tipo = "alert-warning";
            $dados = array('mensagem'=>$mensagem, "tipo"=>$tipo);
            $this->load->view('professor/login-ou-registra',$dados);
        }
         
    }
    
    
}
