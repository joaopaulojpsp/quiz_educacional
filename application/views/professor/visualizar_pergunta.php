<section class="container">
    
    <div class="row">
        <div class="col-md-12"><h3>Atualizar Pergunta</h3>
            <?php
                $link = base_url()."index.php/Painel_Professor/atualizar_pergunta/".$pergunta['id'];
            ?>        
            <form action="<?php echo $link; ?>" method="post" id="pergunta" style="margin-bottom: 40px">                 
                
                <!--Id da pergunta-->
                <input type="hidden" name="id" value="<?php echo $pergunta['id'] ?>" />
            
            <div class="form-group">
                <label>
                |Pergunta:</label>
                <textarea required class="form-control" 
                          name="pergunta" rows="7" 
                          maxlength="3000"><?php echo $pergunta['pergunta'] ?></textarea>
            </div>
                
            <div class="form-group">
                <label>Opcao A:</label>
                <input type="text" class="form-control" 
                       value="<?php echo $pergunta['op_a'] ?>" name="op_a" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao B:</label>
                <input type="text" class="form-control"
                       value="<?php echo $pergunta['op_b'] ?>" name="op_b" maxlength="300" required>
            </div>
            <div class="form-group">
                <label>Opcao C:</label>
                <input type="text" class="form-control" 
                      value="<?php echo $pergunta['op_c'] ?>"  name="op_c" maxlength="300" required>
            </div>
                
                <div class="row"><div class="col-md-4">
                    <div class="form-group">
                        <label>Escolha a opcao correta</label>
                        
                        <div class="espaco_texto">Opcao 
                            <select name="resposta">
                                <option><?php echo $pergunta['resposta'] ?></option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>

                        </select></div>
                    </div>
            </div></div>
             
            
            <div class="form-group" style="margin-top: 20px">
                <!--Atualizar pergunta-->
                <input type="submit" class="btn btn-success btn-lg" value="Atualizar Pergunta">
                
                <!--Ativar o modal para perguntar se quer mesmo excluir-->
                <a href="#myModal" data-toggle="modal" data-target="#myModal"
                   class="btn btn-danger btn-lg" >Excluir Pergunta</a>
            </div>
                    
        </form></div>
        
    </div>
    
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
         
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Excluir Pergunta</h4>
      </div>
      <div class="modal-body">
          <p>Você quer mesmo excluir esta Pergunta?</p>
      </div>
      <div class="modal-footer">
          <?php
              $link = base_url().'index.php/Painel_Professor/excluir_pergunta/'.$pergunta['id'];
          ?>
          <a href="<?php echo $link; ?>" class="btn btn-success">Excluir</a>
        <a href="#" class="btn btn-default" data-dismiss="modal">Cancelar</a>
      </div>
    </div>
    
  </div>
    
</div>
