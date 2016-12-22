<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Gerar_Pdf
 *
 * @author Joao_Paulo
 */
class Gerar_Pdf extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library('FPDF/fpdf','','pdf');
        $this->load->model('Quiz_model','quiz');
        
    }
    
    
    public function quiz_em_pdf($slug) {
        
        $this->load->model('Pergunta_model','pergunta');
        
       $quiz = $this->quiz->get_quiz_slug($slug);
       $id_quiz = $quiz['id']; 
       
       $lista_perguntas = $this->pergunta->get_perguntas($id_quiz);
       
       $this->gerar_quiz_pdf($quiz, $lista_perguntas);
       
    }
    
    public function resultado_em_pdf($id_quiz) {
        
        
    }
    
    
    private function gerar_quiz_pdf($quiz, $lista_perguntas) {
        
        $pdf = $this->pdf;
        $pdf->AddPage();
        
        $nome_quiz = utf8_decode($quiz['nome']);
        $disciplina = utf8_decode($quiz['disciplina']);
        
        $pdf->SetFont('Arial','B',20);
        $this->imprimi_linha($pdf, "Assunto: ".$nome_quiz." - Disciplina: ".$disciplina, "", 10);
        $pdf->Cell(20,15,"",0,1,'L');//quebra de linha
        
        $count = 1;
        foreach ($lista_perguntas as $pergunta) {
            
            $texto_pergunta = utf8_decode($pergunta['pergunta']);
            $option_a = utf8_decode($pergunta['op_a']);
            $option_b = utf8_decode($pergunta['op_b']);
            $option_c = utf8_decode($pergunta['op_c']);
            
            $pdf->SetFont('Arial','B',13);
            $this->imprimi_linha($pdf, $count.") ".$texto_pergunta);
            $pdf->Cell(20,4,"",0,1,'L');//quebra de linha
            
            $pdf->SetFont('Arial','',10);
            $pdf->ln(2);
            $this->imprimi_linha($pdf, 'A) '.$option_a);
            $pdf->ln(4);
            $this->imprimi_linha($pdf, 'B) '.$option_b);
            $pdf->ln(4);
            $this->imprimi_linha($pdf, 'C) '.$option_c);
            $pdf->ln(4);
            $pdf->ln(10);//quebra de linha
             
            $count = $count + 1;
        }
        
        $this->imprimir_resposta($pdf, $lista_perguntas);
        
        $pdf->Output();
        
    }
    
    private function imprimi_linha($pdf, $string, $espaco = 5){
        
        $pdf->Write($espaco, $string);
        
    }
    
    function imprimir_resposta($pdf,$respostas){
        
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(180,20,"Respostas",1,1,'C');
        $pdf->Cell(20,15," ",0,1,'L');//quebra de linha
        
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(30,17,"Pergunta",1,0,'C');
        $pdf->Cell(50,17,"Resposta",1,1,'C');
        
        $pdf->SetFont('Arial','',14);
        $cont = 1;
        foreach ($respostas as $resposta) {
            
            $pdf->Cell(30,17,"".$cont."",1,0,'C');
            $pdf->Cell(50,17,$resposta['resposta'],1,1,'C');
            
            $cont++;
        }
        
    }
    
    
    
}
