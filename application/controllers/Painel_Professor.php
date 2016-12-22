<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Painel_Professor
 *
 * @author Joao_Paulo
 */
class Painel_Professor extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("funcao"));
        $this->load->model("Quiz_model","quiz");
        
    }
    
    public function index(){
        
        $professor = $this->session->professor;
        
	$this->load->view('professor/header',$this->session->professor);
        $this->load->view('professor/home',$professor);
        $this->load->view('professor/footer');
        
    }
    
    //Adicionar a escola
    public function adicionar_escola() {
        
        $this->load->model('Escola_Ano_Model','escola');
        $escola = $this->escola;
        
        $dados['nome_escola'] = strtolower($_POST['nome_escola']);
        $dados['ensino'] = strtolower($_POST['ensino']);
        $dados['ano'] = strtolower($_POST['ano']);
        
        $fez = $escola->inserir_escola_ano($dados);
        if($fez){
            redirect('Painel_Professor/fazer_quiz');
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("Escola e ensino e ano já existe!");';
            echo '</script>';
            $link = base_url()."index.php/Painel_Professor/fazer_quiz";
            echo '<a href="'.$link.'">Voltar a Pagina Anterior!</a>';
        }
        
    }
    
    //Começar o Quiz
    public function fazer_quiz(){
        
        $professor = $this->session->professor;
       
        
	$this->load->view('professor/header',$this->session->professor);
        $this->load->view('professor/fazer_quiz',$professor);
        $this->load->view('professor/footer');
          
    }
    

    public function fazer_pergunta(){
        
        //session professor nunha variavel
        $professor = $this->session->professor;
        
        //dados recebe post
        $dados = $_POST;
        
        //verifica se tem nome equal, para evitar registro dublicados
        if(isset($dados['nome'])){
            $dados['slug'] = $dados['nome'] ." ".$professor['id'];
            
            $dados['slug'] = funcao::removerLetrasEspeciais($dados['slug']);
            $dados['slug'] = url_title($dados['slug'], 'dash', TRUE);
            
            $inserir = $this->quiz->pode_inserir($dados['slug']);

            if($inserir){
                $this->quiz->inserir_quiz($dados);
            }
        }
        
        $qui = $this->quiz->get_quiz($professor['id']);
        $professor['quiz_professor'] = $qui;
        
        if(isset($this->session->numero_pergunta)){
            
            $professor['numero_pergunta'] = $this->session->numero_pergunta;
        }
       
	$this->load->view('professor/header',$this->session->professor);
        $this->load->view('professor/fazer_quiz',$professor);
        $this->load->view('professor/footer');
          
    }
    
    public function adicionar_pergunta(){
        
        $this->load->model("Pergunta_model","pergunta");
        
        $dados = array(
            'pergunta'=>$_POST['pergunta'],
            'op_a'=>$_POST['op_a'],
            'op_b'=>$_POST['op_b'],
            'op_c'=>$_POST['op_c'],
            'resposta'=>$_POST['resposta'],
            'id_quiz'=>$_POST['id_quiz']
        );
        
        $this->pergunta->inserir_pergunta($dados);
        
        //se no existe numero_pergunta criar
        if(isset($this->session->numero_pergunta)){
            $this->session->numero_pergunta = $this->session->numero_pergunta + 1;
        }else{
            $this->session->set_userdata('numero_pergunta', 2);
        }
        //fim
        
        redirect("Painel_Professor/fazer_pergunta");
        
    }
    
    public function quiz_concluido(){
        
        $this->session->numero_pergunta = 1;
        
        $this->load->view('professor/header',$this->session->professor);
        $this->load->view('professor/quiz_concluido');
        $this->load->view('professor/footer');
        
    }
    
    public function visualizar_editar_perfil(){
        
        $prof = $this->session->professor;
        $password = funcao::criptografiar($prof['senha']);
        $prof['senha'] = $password;
        
        $this->load->view('professor/header',$prof);
        $this->load->view('professor/visualizar_editar_perfil',$prof);
        $this->load->view('professor/footer');
    }
    
    public function atualizar_perfil(){
        
        $this->load->model("Professor_model","professor");
        
        $email = $this->session->professor['email'];
        
        $id = $this->session->professor['id'];
        $dados = $_POST;
        
        $password = funcao::criptografiar($dados['senha']);
        $dados['senha'] = $password;
        
        $atualizou = $this->professor->atualizar_perfil($id, $dados);
        
        if($atualizou){
            $professor = Professor_model::logar_Professor($email);
            $this->session->professor = $professor;
            redirect("Painel_Professor/visualizar_editar_perfil");
        } else {
            echo '<h1>Não foi possivel atualizar</h1>';
        }
        
    }
    
    public function atualizar_imagem(){   
        
        $this->load->model("Professor_model","professor");
        
        $id = $this->session->professor['id'];
        //print_r($_FILES['imagem']);
        $imagem = $_FILES['imagem'];
        $podeatualizar = true;
        if($imagem['type'] == 'image/png'){
                
            $imagem['name'] = 'perfil-'.$id.'.png';
            
        }else if($imagem['type'] == 'image/jpeg'){
            
            $imagem['name'] = 'perfil-'.$id.'.jpg';
            
        }else if($imagem['type'] == 'image/gif'){
            
            $imagem['name'] = 'perfil-'.$id.'.gif';
            
        }else{
            echo '<link rel="stylesheet" href="'.base_url().'/asserts/css/bootstrap.min.css">';
            if($imagem['type'] == ''){
                redirect("Painel_Professor/visualizar_editar_perfil");
            
            }else{
                $mensage = "Isso não é uma imagem: ".$imagem['type'];
            }
            funcao::mensagem_bootstrap($mensage, "alert-info");
            $podeatualizar = false;
        }
        
        //Vai atualizar se tiver uma imagem
        if($podeatualizar){
            $destino = 'asserts/img/professor/' . $imagem['name'];
            $arquivo_tmp = $imagem['tmp_name'];
            move_uploaded_file( $arquivo_tmp, $destino  );

            $atualizou = $this->professor->atualizar_imagem($id, $destino);
            if($atualizou){
                $email = $this->session->professor['email'];
                $prof = $this->professor->logar_Professor($email);
                $this->session->professor = $prof;
                redirect("Painel_Professor/visualizar_editar_perfil");
            }
        }
          
    }
    
    //Começa as funções de quiz
    //Primeira
    public function visualizar_quiz(){
        
        $prof = $this->session->professor;
        $id = $prof['id'];
        // 1 que dizer todos os quizes ativos
        $prof['quizes_1'] = $this->quiz->get_quizes_prof($id, 1);
        $prof['quizes_0'] = $this->quiz->get_quizes_prof($id, 0);
        
        $this->load->view('professor/header',$prof);
        $this->load->view('professor/visualizar_quiz',$prof);
        $this->load->view('professor/footer');
        
    }
    //Segunda
    public function editar_quiz($id){
        
        $this->load->model("Pergunta_model","pergunta");
        $p = $this->pergunta;
        
        $prof = $this->session->professor;
        $id_prof = $prof['id'];
        $prof['quiz_editar'] = $this->quiz->get_quiz_editar($id_prof, $id);
        
        $prof['perguntas'] = $p->get_perguntas($id);
        
        $this->load->view('professor/header',$prof);
        $this->load->view('professor/editar_quiz',$prof);
        $this->load->view('professor/footer');
    }
    //Terceira
    public function atualizar_quiz($id){
        
        $dados = $_POST;
        
        $exec = $this->quiz->atualizar_quiz($id, $dados);
        
        if($exec){
            redirect("Painel_Professor/visualizar_quiz");
        }
    }
    //Quarta
    public function excluir_quiz($id) {
        
        $prof = $this->session->professor;
        $id_professor = $prof['id'];
        $q = $this->quiz;
        
        $ehmesmo = $q->quiz_ehdo_professor($id, $id_professor);
        
        if($ehmesmo){
            $exec = $q->excluir_quiz($id);
            if($exec){
                redirect("Painel_Professor/visualizar_quiz");
            }else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
        
    }//fim das funções de quiz

    //Começa funções de perguntas
    //Primeira
    public function editar_pergunta($id){

        $this->load->model("Pergunta_model","pergunta");
        $p = $this->pergunta;
        $prof = $this->session->professor;

        $prof['pergunta'] = $p->get_pergunta_especifica($id);

        $this->load->view('professor/header',$prof);
        $this->load->view('professor/visualizar_pergunta',$prof);
        $this->load->view('professor/footer');
       
    }
    //Segunda
    public function atualizar_pergunta($id){
        
        $this->load->model("Pergunta_model","pergunta");
        $p = $this->pergunta;
        
        $dados = $_POST;
        
        $exec = $p->atualizar_pergunta($id, $dados);
        
        if($exec){
            redirect("Painel_Professor/editar_pergunta/".$id);
        }
        
    }
    //Terceira
    public function excluir_pergunta($id) {
        
        $this->load->model("Pergunta_model","pergunta");
        $pe = $this->pergunta;
        
        $qui = $this->quiz;
        
        $prof = $this->session->professor;
        $id_professor = $prof['id'];
        
        $id_quiz = $pe->get_id_quiz($id);
        $ehmesmo = $qui->quiz_ehdo_professor($id_quiz, $id_professor);
        
        if($ehmesmo){
            
            $exec = $pe->deletar_pergunta($id);
            if($exec){
                $link = "Painel_Professor/editar_quiz/".$id_quiz;
                redirect($link);
            }
            else{
                redirect(base_url());
            }
        }else{
            redirect(base_url());
        }
        
    }
    
    
}
