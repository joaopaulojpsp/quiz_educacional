<?php


/**
 * Description of funcao
 *
 * @author Joao_Paulo
 */
class funcao {
    
    public static function mensagem_bootstrap($mensagem, $tipo='alert-success', $imprime=true){
        
        $valor = "<div class='alert $tipo'><strong>Avisso: </strong>$mensagem</div>";
        if($imprime){
            echo $valor;
        }else{
            return $valor;
        }
        
    }
    
    public function tranforma_opcao($nomes) {
        
        $html = '';
        
        foreach ($nomes as $nome) {
            $html .= '<option value="'.$nome.'">';
            $html .= $nome;
            $html .= '</option>';
         }
        
        return $html;
    }
    
    public static function criptografiar($senha){
		
        $senha = strrev($senha);


        for($i = 0;$i < strlen($senha);$i++){

            if($senha[$i] == '0'){
                    $senha[$i] = 'a';
            }else if($senha[$i] == '1'){
                    $senha[$i] = 'b';
            }else if($senha[$i] == '2'){
                    $senha[$i] = 'c';
            }else if($senha[$i] == '3'){
                    $senha[$i] = 'd';
            }else if($senha[$i] == '4'){
                    $senha[$i] = 'e';
            }
            else if($senha[$i] == '5'){
                    $senha[$i] = 'f';
            }
            else if($senha[$i] == '6'){
                    $senha[$i] = 'g';
            }else if($senha[$i] == '7'){
                    $senha[$i] = 'h';
            }else if($senha[$i] == '8'){
                    $senha[$i] = 'i';
            }else if($senha[$i] == '9'){
                    $senha[$i] = 'j';
            }
            else if($senha[$i] == 'a'){
                    $senha[$i] = '0';
            }else if($senha[$i] == 'b'){
                    $senha[$i] = '1';
            }else if($senha[$i] == 'c'){
                    $senha[$i] = '2';
            }else if($senha[$i] == 'd'){
                    $senha[$i] = '3';
            }else if($senha[$i] == 'e'){
                    $senha[$i] = '4';
            }
            else if($senha[$i] == 'f'){
                    $senha[$i] = '5';
            }
            else if($senha[$i] == 'g'){
                    $senha[$i] = '6';
            }else if($senha[$i] == 'h'){
                    $senha[$i] = '7';
            }else if($senha[$i] == 'i'){
                    $senha[$i] = '8';
            }else if($senha[$i] == 'j'){
                    $senha[$i] = '9';
            }

	}
	return $senha;
		
    }
    
    public static function removerLetrasEspeciais($palavra) {
        
        $novaPalavra = $palavra;
        
        $novaPalavra = str_replace("ç", "c", $novaPalavra);
        $novaPalavra = str_replace("ã", "a", $novaPalavra);
        $novaPalavra = str_replace("á", "a", $novaPalavra);
        $novaPalavra = str_replace("à", "a", $novaPalavra);
        $novaPalavra = str_replace("é", "e", $novaPalavra);
        $novaPalavra = str_replace("ê", "e", $novaPalavra);
        $novaPalavra = str_replace("í", "i", $novaPalavra);
        $novaPalavra = str_replace("ó", "o", $novaPalavra);
        $novaPalavra = str_replace("õ", "o", $novaPalavra);
        $novaPalavra = str_replace("ô", "o", $novaPalavra);
        $novaPalavra = str_replace("ò", "o", $novaPalavra);
        $novaPalavra = str_replace("ü", "u", $novaPalavra);
        $novaPalavra = str_replace("ñ", "n", $novaPalavra);
        
        return $novaPalavra;
        
    }
    
}
