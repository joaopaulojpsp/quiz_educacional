<div class="container" style="margin-bottom: 100px">
    
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($nome)){
            ?>
            <h3>Visualize o seu perfil ou atualize alguma informação</h3>
            
            <form action="<?php echo base_url();?>index.php/Painel_Professor/atualizar_perfil" method="post">
                
                <!--Canto da imagem do perfil-->
                <div class="row">
                    <div class="col-md-4">
                        <?php 
                        if(isset($imagem)){
                            if($imagem == null){
                        ?>    
                                <image src="<?php echo base_url();?>/asserts/img/perfil.png" 
                                   class="img-thumbnail" style="width: 100%;height: 300px" />
                        <?php
                            }else{
                                ?>
                                <image src="<?php echo base_url()."/".$imagem;?>" 
                                   class="img-thumbnail" style="width: 100%; height: 40%" />
                                <?php
                            }
                        
                        }else{?>
                            <image src="<?php echo base_url();?>/asserts/img/perfil.png" 
                                   class="img-thumbnail" style="width: 100%; height: 300px" />
                        <?php } ?>
                        <a href="#myModal"  style="margin-top:10px;margin-bottom:10px" 
                           class="btn btn-info" data-toggle="modal" data-target="#myModal">Atualizar Imagem</a>
                    </div>
                    
                    
                    <!--Canto do formulario-->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control" value="<?php echo $nome;?>" name="nome" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label>Sobrenome:</label>
                            <input type="text" required class="form-control" value="<?php echo $sobrenome;?>" maxlength="40" name="sobrenome">
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" value="<?php echo $email;?>" disabled="" />
                        </div>
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="text" class="form-control" value="<?php echo $senha;?>" name="senha" value="" />
                        </div>
                        <div class="form-group">
                            <label>Pequena Descrição de sua Formação:</label>
                            <textarea name="formacao" class="form-control" rows="7" maxlength="800" ><?php echo $formacao;?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" value="Atualizar" class="btn btn-success btn-lg"/>    
                            <a href="#"  class="btn btn-danger btn-lg">Excluir a Conta</a>
                        </div>
                        
                    </div>
                </div>  
                
            </form>
            
                <?php 
                }
                ?>
        </div>
    </div>
    
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <form action="<?php echo base_url()?>index.php/Painel_Professor/atualizar_imagem" method="post" enctype="multipart/form-data">
         
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Faça upload de sua imagem</h4>
      </div>
      <div class="modal-body">
          <input type="file" name="imagem" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Atualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
  </div>
</div>
    
</div>