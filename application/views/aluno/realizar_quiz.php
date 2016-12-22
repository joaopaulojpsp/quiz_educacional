<section class="container">
    
    <?php
        if(isset($info_quiz)){
            $acertos = $info_quiz['acertos'];
            $erros = $info_quiz['erros'];
            
            $pontos = ($acertos * 3) - ($erros * 2);
        }else{
            redirect("Painel_Aluno/lista_de_testes");
        }
    ?>
    
    <?php
        $animation = array();
        
        $animation[] = 'zoomIn';
        $animation[] = 'zoomInDown';
        $animation[] = 'zoomInLeft';
        $animation[] = 'slideInUp';
        $animation[] = 'slideInDown';
        $animation[] = 'bounceIn';
        $animation[] = 'bounceInDown';
        $animation[] = 'pulse';
        
        $escolha = rand(0, 7);
        
        $anim = $animation[$escolha];
        
    ?>
    
    <div class="row">
        <!--Widgets-->
        <div class="col-md-2">
            <div class="widgets">
                
                <div class="info pontos">
                    <h4>Pontos</h4>
                    <strong><?php echo $pontos; ?></strong>
                    <?php
                        $link = base_url(). "index.php/Painel_Aluno/"
                                . "realizar_quiz/".$slug."/".$info_quiz['questao_atual'];
                        
                        if($info_quiz['questao_atual'] > $ordem){
                            echo '<a href="'.$link.'" '
                                    . 'class="form-control btn btn-info">'
                                    . 'Ir Para o'.$info_quiz['questao_atual'].''
                                    . '</a>';
                        }
                    ?>
                </div>
                
                <div class="info acertos">
                    <h4>Acertos</h4>
                    <strong><?php echo $acertos; ?></strong>
                </div>

                <div class="info erros">
                    <h4>Erros</h4>
                    <strong><?php echo $erros; ?></strong>
                </div>
                
            </div> <!--Widgets-->
        </div>    <!--Coluna dos widgets-->
        <!--Conteudo-->
        
        <?php 
            if($quiz != null and $pergunta_atual != null){
        ?>
                <div class="col-md-8">
                    
                    <form>
                        <h3 class="center"><?php echo $quiz['nome'].' - '.$quiz['disciplina']; ?></h3>
                    </form>
                    <?php 
                        $url = base_url()."index.php/Painel_Aluno/verificar_resposta/".$ordem;
                    ?>
                    <form class="animated <?php echo $anim ?>" action="<?php echo $url; ?>" method="post" style="margin-bottom: 50px; padding:20px" id="responder-perguntas">
                        <h2>
                            <?php echo $ordem.") ". $pergunta_atual['pergunta'];?>
                        </h2>
                        <br/>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" value="a">
                                A) <?php echo $pergunta_atual['op_a'];?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" value="b">
                                B) <?php echo $pergunta_atual['op_b'];?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" value="c">
                                C) <?php echo $pergunta_atual['op_c'];?>
                            </label>
                        </div>
                        <hr/>
                        <input type="submit" value="Confirmar" class="btn btn-success btn-lg">
                        
                   </form>
                
                    <?php
                        $agora = (($info_quiz['questao_atual'] - 1) / $quiz['quant_de_perguntas']) * 100;
                        
                    ?>
                    
                    <form style="margin-bottom: 50px">
                        <h3>Seu Progresso</h3>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info progress-bar-striped"
                                role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100" 
                            style="width:<?php if($agora != 0)echo round($agora); else echo '5'; ?>%">
                                
                              <?php echo round($agora); ?>%
                              
                            </div>
                        </div>
                    </form>
                    
                </div>
        <?php
            }
        ?>
    </div>
</section>