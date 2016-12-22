<section class="container">
    
    <div class="row">
        <!--Widgets-->
        <div class="col-md-1">
            
            
        </div>    
        
        <!--Conteudo-->
        <div class="col-md-10">
            <?php
                if($lista_quiz != null){
            ?>
            <h3>Lista de Quiz Para Fazer</h3>
            <div class="card scoll-y">
                
                <?php 
                    foreach ($lista_quiz as $quiz) {
                ?>
                <div class="quiz">
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                                $imagem = '';
                                if($quiz['imagem'] == null){
                                    $imagem = base_url()."asserts/img/perfil.png";
                                }
                                else{
                                    $imagem = base_url().$quiz['imagem'];
                                }
                                $link = base_url()."index.php/Painel_Aluno/"
                                        . "realizar_quiz/".$quiz['slug']."/1";
                            ?>
                            <img src="<?php echo $imagem; ?>" class="img-professor" />
                        </div>
                        <div class="col-md-8">
                            <strong class="nome-professor">
                               <?php echo $quiz['nome_do_professor']." ". $quiz['sobrenome'] ;?>
                            </strong><br/><br/>
                            <strong class="dados-quiz">
                                Nome do Quiz: <?php echo $quiz['nome_do_quiz'];?> <br/>
                                Disciplina: <?php echo $quiz['disciplina']; ?><br/>
                                Nota Para Passar: <?php echo $quiz['por_para_passar']; ?> <br/>
                                Numeros de Perguntas: <?php echo $quiz['quant_de_perguntas']; ?>
                            </strong>
                            <hr/>
                            <a href="<?php echo $link; ?>" class="btn btn-success">Fazer O Quiz</a>
                        </div>
                    </div>
                    
                </div>
 
            <?php } ?>
                
            </div><!--Fim do card-->
            <?php
                }else{ ?>
                    <h3>Não Tem Quiz Para Fazer</h3>
                    <div class="card">
                        <h2>Por favor espere alguns dos seus professores postarem algum quiz.</h2>
                    </div>
                <?php }
            ?>
            
            <?php
                if($lista_quiz_2 != null){
            ?>
            <h3>Lista de Quiz Já Feito</h3>
            <div class="card scoll-y">
                
                <?php 
                    foreach ($lista_quiz_2 as $quiz) {
                ?>
                <div class="quiz">
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                                $imagem = '';
                                if($quiz['imagem'] == null){
                                    $imagem = base_url()."asserts/img/perfil.png";
                                }
                                else{
                                    $imagem = base_url().$quiz['imagem'];
                                }
                                $link = base_url()."index.php/Painel_Aluno/"
                                        . "realizar_quiz/".$quiz['slug']."/1";
                            ?>
                            <img src="<?php echo $imagem; ?>" class="img-professor" />
                        </div>
                        <div class="col-md-8">
                            <strong class="nome-professor">
                               <?php echo $quiz['nome_do_professor']." ". $quiz['sobrenome'] ;?>
                            </strong><br/><br/>
                            <strong class="dados-quiz">
                                Nome do Quiz: <?php echo $quiz['nome_do_quiz'];?> <br/>
                                Disciplina: <?php echo $quiz['disciplina']; ?><br/>
                                Nota Para Passar: <?php echo $quiz['por_para_passar']; ?> <br/>
                                Numeros de Perguntas: <?php echo $quiz['quant_de_perguntas']; ?>
                            </strong>
                            <hr/>
                            <?php
                                $link_pdf = base_url()."index.php/Gerar_Pdf/quiz_em_pdf/".$quiz['slug'];
                                $link_resultado = base_url()."index.php/Gerar_Pdf"
                                        . "/resultado_em_pdf/".$quiz['id'];
                            ?>
                            
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle"
                                        type="button" 
                                        data-toggle="dropdown">
                                    Exportar Quiz
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li>
                                      <a target='_blank' href="<?php echo $link_pdf; ?>">Quiz em PDF</a>
                                  </li>
                                  <li>
                                      <a target='_blank' href="<?php echo $link_resultado; ?>">Resultado em PDF</a>
                                  </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            <?php }//fim do for
            ?>
                </div><!--Fim do card-->
            <?php    
                }//fim do if
            ?>
             
            
            
        </div> 
        
    </div>
    
</section>