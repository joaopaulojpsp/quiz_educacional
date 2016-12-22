<section class="container">

    <?php
        if($quiz_editar != null){
    ?>
    
    <div class="row">
        <div class="col-md-10"><h3>Edite o Quiz</h3>
        <?php
            $link = base_url()."index.php/Painel_Professor/atualizar_quiz/".$quiz_editar['id'];
        ?>            
            <form action="<?php echo $link; ?>" method="post" style="margin-bottom: 20px">                 

            <div class="form-group" >
                <label>Nome:</label>
                <input type="text" class="form-control capitalize" name="nome" maxlength="100" value="<?php echo $quiz_editar['nome']; ?>">
            </div>
            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Disciplina:</label>
                        <input type="text" class="form-control capitalize" maxlength="40" name="disciplina" value="<?php echo $quiz_editar['disciplina']; ?>">
                    </div>
                </div>
  
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Quantidade de Perguntas:</label>
                        <input type="number" class="form-control" value="<?php echo $quiz_editar['quant_de_perguntas']; ?>" name="quant_de_perguntas">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>A Porgentagem de Acertos</label>
                        
                        <div class="espaco_texto">
                            <select name="por_para_passar">
                                <option><?php echo $quiz_editar['por_para_passar'];?></option>
                                <option>60</option>
                                <option>70</option>
                                <option>80</option>
                                <option>85</option>
                        </select>% de Acertos</div>
                    </div>
                </div>
                
            </div> 
            
            <div class="form-group" style="margin-top: 20px">
                <input type="submit" class="btn btn-success btn-lg" value="Atualizar Quiz">
                
                <!--Ativar o modal que pergunta se quer mesmo excluir o quiz-->
                <a href="#myModal" data-toggle="modal" data-target="#myModal"
                   class="btn btn-danger btn-lg">Excluir Quiz</a>
            </div>
            
        </form></div>
    </div>    
        <?php }else{
            $base = base_url();
            redirect($base);
        }
        ?>
    
    <div class="row">
    <div class="col-md-12">
    <h3>Perguntas</h3>
    <form class="scrool" style="margin-bottom: 40px">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Pergunta</th>
                        <th>Resposta</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($perguntas as $pergunta){
                                echo '<tr>';
                                $id_pergunta = $pergunta['id'];
                                $base = base_url();
                                $link = $base ."index.php/Painel_Professor/editar_pergunta/".$id_pergunta; 
                                $perg = substr($pergunta['pergunta'], 0, 250);
                                echo '<td> <a href="'.$link.'">'.$perg.'</a></td>';
                                echo '<td>'.$pergunta['resposta'].'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                
            </form>
            
        </div>
        
    </div>
    
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
         
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Excluir Quiz</h4>
      </div>
      <div class="modal-body">
          <p>Você quer mesmo excluir este Quiz?</p>
          <p>Você excluindo este quiz você excluir todas as perguntas
          relacionada a este quiz.</p>
      </div>
      <div class="modal-footer">
          <?php
              $link = base_url().'index.php/Painel_Professor/excluir_quiz/'.$quiz_editar['id'];
          ?>
          <a href="<?php echo $link; ?>" class="btn btn-success">Excluir</a>
        <a href="#" class="btn btn-default" data-dismiss="modal">Cancelar</a>
      </div>
    </div>
    
  </div>
    
</div>
