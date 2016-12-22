

<section class="container">
    
    <?php if(isset($quiz_professor)){ ?>
    
    
    
    <div class="row">
        <div class="col-md-10"><h3>Agora você precisa adicionar perguntas ao quiz</h3>
                    
        <form action="" method="post" style="margin-bottom: 20px">                 

            <div class="form-group" >
                <label>Nome:</label>
                <input type="text" class="form-control capitalize" name="nome" maxlength="100" value="<?php echo $quiz_professor['nome']; ?>" disabled>
            </div>
            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Disciplina:</label>
                        <input type="text" disabled class="form-control capitalize" maxlength="40" name="disciplina" value="<?php echo $quiz_professor['disciplina']; ?>">
                    </div>
                </div>
  
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Quantidade de Perguntas:</label>
                        <input type="number" disabled="" class="form-control" value="<?php echo $quiz_professor['quant_de_perguntas']; ?>" name="quant_de_perguntas">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>A Porgentagem de Acertos</label>
                        
                        <div class="espaco_texto">
                            <select name="por_para_passar" disabled>
                                <option><?php echo $quiz_professor['por_para_passar'];?></option>
                        </select>% de Acertos</div>
                    </div>
                </div>
                
            </div> 
        </form></div>
    </div>    
    <?php }
        else{ 
            
?>
    <div class="row">
        <div class="col-md-10">
            <h3>Escolha a Escola e o Ano</h3>
            <form>
                <div class="form-group">
                    <label>Escola:</label>
                    <select class="form-control capitalize" id='nome_escola' name="nome_escola">
                       <!--Select vai ser preencido via Ajax--> 
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <label>Ensino:</label>
                        <select class="form-control capitalize" name="ensino" id="ensino">
                            <!--Select vai ser preencido via Ajax--> 
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Ano:</label>
                        <select class="form-control capitalize" name="ano" id="ano">
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="#myModal"  style="margin-top:30px;margin-bottom:10px" 
                           class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Adicionar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10"><h3>Criar o Quiz</h3>
                    
        <form action="<?php echo base_url(); ?>index.php/Painel_Professor/fazer_pergunta" method="post" style="margin-bottom: 20px">                 

            <div class="form-group" >
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome" maxlength="100" required>
            </div>
            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Disciplina:</label>
                        <input type="text" required class="form-control capitalize" maxlength="40" name="disciplina">
                    </div>
                </div>
                
                <!--Campo se esta ativo-->
                <input type="hidden" name="ativo" value="1" />
                
                 <!--Campo id da escola_ano-->
                <input type="hidden" name="id_escola_ano" value="0" id="id_escola_ano" />
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Quantidade de Perguntas:</label>
                        <input type="number" required class="form-control" name="quant_de_perguntas" min="5" max="50">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>A Porgentagem de Acertos</label>
                        
                        <div class="espaco_texto"><select name="por_para_passar">
                            <option>60</option>
                            <option>70</option>
                            <option>80</option>
                            <option>85</option>
                        </select>% de Acertos</div>
                    </div>
                </div>
                
            </div>
            
            <!--Id do professor-->
            <input type="hidden" name="id_professor" value="<?php echo $id;?>">
            
            <!--Data de Inicio-->
            <?php
                //Um dia
                $minuto = 60;
                $hora = 60 * $minuto;
                $dia = 24 * $hora;
                
                $cinco_dias = $dia * 5;
                
                timezones('UM3');
                $datestring = '%Y-%m-%d';
                $agora = time();
                
                $inicio = mdate($datestring, $agora);
                $fim = mdate($datestring, $agora + $cinco_dias);
                
            ?>
            <input type="hidden" name="data_inicio" value="<?php echo $inicio;?>">
            
            <!--Data de Fim-->
            <input type="hidden" name="data_fim" value="<?php echo $fim;?>">
            
            <div class="form-group" style="margin-top: 20px">
                <input type="submit" class="btn btn-success btn-lg" value="Criar">
                <input type="reset" class="btn btn-warning btn-lg" value="Apagar">
            </div>

        </form></div>
        
    </div>
        <?php }?>
    
    
    <?php 
        //Aqui serve para saber se ja derminou ou não o quiz
        //Se derminou manda para a pagina de concluido o quiz
        if(isset($quiz_professor)){
            if(isset($numero_pergunta)){
                if($numero_pergunta > $quiz_professor['quant_de_perguntas']){
                    redirect("Painel_Professor/quiz_concluido");
                }
            }
    ?>
            <div class="row">
        <div class="col-md-10"><h3>Adicionar Perguntas</h3>
                    
            <form action="<?php echo base_url(); ?>index.php/Painel_Professor/adicionar_pergunta" method="post" id="pergunta" style="margin-bottom: 40px">                 

            <div class="form-group">
                <label><?php if(isset($numero_pergunta)){
                echo $numero_pergunta." ";}else{ echo "1 ";} ?>| Pergunta:</label>
                <textarea required class="form-control" name="pergunta" rows="7" maxlength="3000"></textarea>
            </div>
                
            <div class="form-group">
                <label>Opcao A:</label>
                <input type="text" class="form-control" name="op_a" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao B:</label>
                <input type="text" class="form-control" name="op_b" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao C:</label>
                <input type="text" class="form-control" name="op_c" maxlength="300" required>
            </div>
                
                <div class="row"><div class="col-md-4">
                    <div class="form-group">
                        <label>Escolha a opcao correta</label>
                        
                        <div class="espaco_texto">Opcao 
                            <select name="resposta">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>

                        </select></div>
                    </div>
            </div></div>
            
            <!--Campo do id do quiz-->    
            <input type="hidden" name="id_quiz" value="<?php echo $quiz_professor['id']; ?>">   
            
            <div class="form-group" style="margin-top: 20px">
                <input type="submit" class="btn btn-success btn-lg" value="Adicionar">
                <input type="reset" class="btn btn-warning btn-lg" value="Apagar">
            </div>
                    
        </form></div>
        
    </div>
    <?php }else{
        
?>
    <div class="row">
        <div class="col-md-10"><h3>Crie um quiz para adicionar perguntas</h3>
                    
            <form action="" id="pergunta" style="margin-bottom: 40px">                 

            <div class="form-group">
                <label>1| Pergunta:</label>
                <textarea required class="form-control" name="pergunta" rows="7" maxlength="3000"></textarea>
            </div>
                
            <div class="form-group">
                <label>Opcao A:</label>
                <input type="text" class="form-control" name="op_a" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao B:</label>
                <input type="text" class="form-control" name="op_b" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao C:</label>
                <input type="text" class="form-control" name="op_c" maxlength="300" required>
            </div>
                
                <div class="row"><div class="col-md-4">
                    <div class="form-group">
                        <label>Escolha a opcao correta</label>
                        
                        <div class="espaco_texto">Opcao 
                            <select name="resposta">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                        </select></div>
                    </div>
            </div></div>
                    
        </form></div>
    </div>
    <?php }?> 
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <form action="<?php echo base_url()?>index.php/Painel_Professor/adicionar_escola" method="post" enctype="multipart/form-data">
         
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adicione a Escola e Ano</h4>
      </div>
      <div class="modal-body">
         <div class="form-group">
                    <label>Escola:</label>
                    <input type="text" class="form-control" name="nome_escola" required="" />
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Ensino:</label>
                        <select class="form-control" name="ensino" >
                            <option value="fundamental">Fundamental</option>
                            <option value="medio">Medio</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Ano:</label>
                        <select class="form-control" name="ano">
                            <option value="1">1º</option>
                            <option value="2">2º</option>
                            <option value="3">3º</option>
                            <option value="4">4º</option>
                            <option value="5">5º</option>
                            <option value="6">6º</option>
                            <option value="7">7º</option>
                            <option value="8">8º</option>
                            <option value="9">9º</option>
                        </select>
                    </div>
                    
                </div>
          
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Adicionar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </form>
  </div>
</div>