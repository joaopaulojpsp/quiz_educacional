<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Painel_Aluno
 *
 * @author Joao_Paulo
 */

class Painel_Aluno extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("funcao"));
        $this->load->model("Quiz_model","quiz");
          
    }
    
    public function index(){
        
        $aluno = $this->session->aluno;
        
	$this->load->view('aluno/header',$aluno);
        $this->load->view('aluno/home',$aluno);
        $this->load->view('aluno/footer');
        
    }
    
    //Começo da parte do perfil do aluno
    public function visualizar_editar_perfil() {
        
        $aluno = $this->session->aluno;
        $password = funcao::criptografiar($aluno['senha']);
        $aluno['senha'] = $password;
        
        $this->load->view('aluno/header',$aluno);
        $this->load->view('aluno/visualizar_editar_perfil',$aluno);
        $this->load->view('aluno/footer');
        
    }
    
    public function atualizar_perfil(){
        
        $this->load->model("Aluno_model","aluno");
        
        $email = $this->session->aluno['email'];
        
        $id = $this->session->aluno['id'];
        $dados = $_POST;
        
        $password = funcao::criptografiar($dados['senha']);
        $dados['senha'] = $password;
        
        $atualizou = $this->aluno->atualizar_perfil($id, $dados);
        
        if($atualizou){
            $aluno = $this->aluno->logar_aluno($email);
            $this->session->aluno = $aluno;
            redirect("Painel_Aluno/visualizar_editar_perfil");
        } else {
            echo '<h1>Não foi possivel atualizar</h1>';
        }
        
    }
    
    public function atualizar_imagem(){   
        
        $this->load->model("Aluno_model","aluno");
        
        $id = $this->session->aluno['id'];
       
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
                redirect("Painel_Aluno/visualizar_editar_perfil");
            
            }else{
                $mensage = "Isso não é uma imagem: ".$imagem['type'];
            }
            funcao::mensagem_bootstrap($mensage, "alert-info");
            $podeatualizar = false;
        }
        
        //Vai atualizar se tiver uma imagem
        if($podeatualizar){
            $destino = 'asserts/img/aluno/' . $imagem['name'];
            $arquivo_tmp = $imagem['tmp_name'];
            move_uploaded_file( $arquivo_tmp, $destino  );

            $atualizou = $this->aluno->atualizar_imagem($id, $destino);
            if($atualizou){
                $email = $this->session->aluno['email'];
                $alun = $this->aluno->logar_Aluno($email);
                $this->session->aluno = $alun;
                redirect("Painel_Aluno/visualizar_editar_perfil");
            }
        }
          
    }
    
    //Fim da parte do perfil do Aluno
    
    //Começo para realizar o Quiz
    //Aqui vai listar os quizes
    function lista_de_testes() {
        
        $this->load->model('Quiz_model','quiz');
        $q = $this->quiz;
        
        $this->load->model('Quiz_Aluno_model','quiz_aluno');
        $qa = $this->quiz_aluno;
        
        
        $aluno = $this->session->aluno;
        $password = funcao::criptografiar($aluno['senha']);
        $aluno['senha'] = $password;
        
        $id_escola_ano = $aluno['id_escola_ano'];
        $lista_quiz = $q->get_lista_quiz_aluno($id_escola_ano);
        $id_aluno = $aluno['id'];
        
        $qa->crear_se_nao_existe($lista_quiz, $id_aluno);
        
        $aluno['lista_quiz'] = $q->get_lista_quiz_aluno_nao_feito($id_escola_ano, $id_aluno);
        $aluno['lista_quiz_2'] = $q->get_lista_quiz_aluno_ja_feito($id_escola_ano,$id_aluno);
        
        $this->load->view('aluno/header',$aluno);
        $this->load->view('aluno/lista_de_testes',$aluno);
        $this->load->view('aluno/footer');
        
    }
    //Aqui o aluno vai realizar o quiz
    function realizar_quiz($slug, $ordem) {
        
        $this->load->model('Quiz_model','quiz');
        $q = $this->quiz;
        
        $this->load->model('Quiz_Aluno_model','quiz_aluno');
        $qa = $this->quiz_aluno;
        
        $this->load->model('Pergunta_model','pergunta');
        $p = $this->pergunta;
       
        $aluno = $this->session->aluno;
        
        $aluno['ordem'] = $ordem;
        $password = funcao::criptografiar($aluno['senha']);
        $aluno['senha'] = $password;
        
        $aluno['quiz'] = $q->get_quiz_slug($slug);
        
        $lista_pergunta = $p->get_perguntas_slug($slug);
        $aluno['pergunta_atual'] = $lista_pergunta[$ordem - 1];
        $aluno['ordem'] = $ordem;
        $aluno['slug'] = $slug;
        
        $aluno['info_quiz'] = $this->atualizar_info_quiz($aluno, $qa);
        
        $this->session->aluno = $aluno;
        
        $this->load->view('aluno/header',$aluno);
        $this->load->view('aluno/realizar_quiz',$aluno);
        $this->load->view('aluno/footer');
       
        
    }
    
    public function verificar_resposta($ordem){
        
        $this->load->model('Resultado_model','resultado');
        $r = $this->resultado;
        
        $this->load->model('Quiz_Aluno_model','quiz_aluno');
        $qa = $this->quiz_aluno;
        
        $resposta_aluno = strtoupper($_POST['resposta']);
        $resposta_correta = $this->session->aluno['pergunta_atual']['resposta'];
        
        $id_aluno = $this->session->aluno['id'];
        $id_pergunta = $this->session->aluno['pergunta_atual']['id'];
        $id_quiz = $this->session->aluno['quiz']['id'];
        
        //Informação sobre o quiz
        $info_quiz = $this->session->aluno['info_quiz'];
        
        if($resposta_aluno == $resposta_correta){
            $r->acertou($id_aluno, $id_pergunta, $id_quiz);
            $qa->mais_um_acerto($info_quiz);
            
        } else {
            $r->errou($id_aluno, $id_pergunta, $id_quiz);
            $qa->mais_um_error($info_quiz);
            
        }
        
        //Verificar se pode continuar
        $numero_pergunta = $this->session->aluno['quiz']['quant_de_perguntas'];
        
        if($ordem < $numero_pergunta){
            $qa->atualizar_status($info_quiz['id'], "estou fazendo");
            $qa->atualizar_questao_atual($info_quiz);
            $slug = $this->session->aluno['quiz']['slug'];
            $url = "Painel_Aluno/realizar_quiz/".$slug ."/".($ordem + 1);
            redirect($url);
        } else {
            
            $aluno = $this->session->aluno;
            $_SESSION['aluno']['info_quiz'] = $this->atualizar_info_quiz($aluno, $qa);
            $info_quiz = $this->atualizar_info_quiz($aluno, $qa);
            
            $acertos = $info_quiz['acertos'];
            $quiz_porcen = $this->session->aluno['quiz']['por_para_passar'];
            
            $numero = $acertos/$numero_pergunta;
            $porgentagem = $numero * 100;
            $status = '';
            
            if($porgentagem >= $quiz_porcen){
                $status = "ja-fiz-e-passei";
                $qa->atualizar_status($info_quiz['id'], $status);
            }else{
                $status = "ja-fiz-e-reprovei";
                $qa->atualizar_status($info_quiz['id'], $status);
            }
            
            redirect("Painel_Aluno/quiz_concluido/".$status);
        }
        
    }
    
    public function quiz_concluido($status) {
        
        $this->load->model("Aluno_model","aluno");
        $a = $this->aluno;
        
        $aluno = $this->session->aluno;
        
        $aluno['status_quiz'] = $status;
        
        
        $aluno['mensagem_pontos'] = "";
        if(isset($_SESSION['aluno']['info_quiz'])){
            
            $erros = $aluno['info_quiz']['erros'];
            $acertos = $aluno['info_quiz']['acertos'];
            
            $_SESSION['erros'] = $erros;
            $_SESSION['acertos'] = $acertos;
            
            $aluno['mensagem_pontos'] = "Acertos são multiplicado por 3 e"
                . " erros são multiplicado por dois e no final faz uma subtração <br /> <br />"
                . " Acertos: ".$acertos." X 3 = ".($acertos*3)."<br />"
                . " Erros: ".$erros." X 2 = ".($erros*2)."<br />"
                . "Total de Pontos: ".($acertos*3)." - ".($erros*2)." = ".(($acertos*3)-($erros*2)).""
                . "<br />";
        
            $id_aluno = $aluno['id'];
            $pontos_atual = $aluno['pontos'];
            $pontos_ganhos = (($acertos*3)-($erros*2));

            $a->addPontos($id_aluno, $pontos_atual, $pontos_ganhos); 
        }

        
        $this->load->view('aluno/header',$aluno);
        $this->load->view('aluno/quiz_concluido',$aluno);
        $this->load->view('aluno/footer');
        
        
        $aluno = $a->logar_aluno($_SESSION['aluno']['email']);
        $_SESSION['aluno'] = $aluno;
                
    }
    
    
    private function atualizar_info_quiz($aluno, $qa){
        
        $info_quiz = $qa->get_info_quiz_aluno($aluno['id'], $aluno['quiz']['id']);        
        return $info_quiz;
        
        
        
    }
    
}
