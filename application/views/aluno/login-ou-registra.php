<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>/asserts/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="<?php echo base_url()?>/asserts/js/jquery-3.1.1.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="<?php echo base_url()?>/asserts/js/bootstrap.min.js"></script>
        
        <title>Login ou Registro do(a) Aluno(a)</title>
        
        <style type="text/css">
            body{
                background: #fafafa;
            }
            .input-group{
                margin-top: 20px;
            }
            form{
                border: 1px solid black;
                padding: 10px;
                background-color: #fff;
                border-radius: 10px;
                margin-top: 20px;
                box-shadow: 5px 4px 3px #777;
            }
            h3{
                margin-top: 20px;
                border-bottom: 1px solid black;
            }
            .margin-top{
                margin-top: 20px;
            }
            select{
                text-transform: capitalize;
            }
        </style>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <!--Primeira coluna para fazer login-->
                <div class="col-md-6">
                    <h3>Login para Aluno</h3>
                    <form action="<?php echo base_url(); ?>index.php/EntraNoQuiz/logar_aluno" method="post">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="senha" placeholder="Senha">
                      </div>
                      
                      <div class="form-group margin-top">
                         <input type="submit" value="Login" class="btn btn-success"/>    
                         <input type="reset" value="Apagar" class="btn btn-warning" />
                      </div>  
                        
                        
                    </form>
                    <!--Canto de mensagens-->
                    <form>
                        <h3>Canto para Avissos</h3>
                        <?php
                            if(isset($mensagem)){
                                if(isset($tipo)){
                                   funcao::mensagem_bootstrap($mensagem,$tipo); 
                                }
                                else{   
                                    funcao::mensagem_bootstrap($mensagem);
                                }
                                
                            }
                            
                            
                        ?>
                    </form>
                    
                </div>
                
           <!--Segunda coluna para fazer Registro-->
                <div class="col-md-6">
                    <h3>Registra Aluno</h3>
                    
                    <form action="<?php echo base_url(); ?>index.php/EntraNoQuiz/registra_aluno" method="post" >
                        
                        <!--Campo invisivel para registra id da escola_ano-->
                        <input type="hidden" value="0" name="id_escola_ano" id="id_escola_ano"/>
                        
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="nome" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label>Sobrenome:</label>
                            <input type="text" required class="form-control" maxlength="40" name="sobrenome">
                        </div>
                        <div class="form-group">
                            <label>Escola:</label>
                            <select class="form-control" id='nome_escola'>
                               <!--Select vai ser preencido via Ajax--> 
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Ensino:</label>
                                <select class="form-control" id="ensino">
                                    <!--Select vai ser preencido via Ajax--> 
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Ano:</label>
                                <select class="form-control" id="ano">
                                    <!--Select vai ser preencido via Ajax--> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" name="email" maxlength="50" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" class="form-control" name="senha" maxlength="15" required>
                        </div>
                    
                        <div class="form-group">
                            <input type="submit" value="Registra" class="btn btn-success"/>    
                            <input type="reset" value="Apagar" class="btn btn-warning" />
                        </div>
                       
                    </form>
                    
                </div>
           
           
            </div>
        </div>
        
        
         <!--Script de Ajax com JQuery -->
        <script type="text/javascript">
            $(function(){
     
                //quando carregar a pagina
               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url(); ?>" + "index.php/Ajax/carregar_escola",
                   dataType: 'json',
                   data: {},
                   success: function(opcoes){
                       $('#nome_escola').html(opcoes.nomes);
                       $('#ensino').html(opcoes.ht_ensinos);
                       $('#ano').html(opcoes.ht_anos);
                       $('#id_escola_ano').val(opcoes.id);
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown){
                       alert("Erro!");
                       for(i in XMLHttpRequest) {
                           if(i!="channel")
                               document.write(i +" : " + XMLHttpRequest[i] +"<br>");

                       }
                   }

               }); 

               //quando mudar o select da escola atualizar os selects e o id_escola
               $('#nome_escola').change(function (){
                   var nome_escola = $('#nome_escola').val();
                   $.ajax({
                       type: "POST",
                       url: "<?php echo base_url(); ?>" + "index.php/Ajax/mudar_escola",
                       dataType: 'json',
                       data: {
                           nome_escola : nome_escola
                       },
                       success: function(opcoes){
                           $('#ensino').html(opcoes.ht_ensinos);
                           $('#ano').html(opcoes.ht_anos);
                           $('#id_escola_ano').val(opcoes.id);
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown){
                           alert("Erro!");
                           for(i in XMLHttpRequest) {
                               if(i!="channel")
                                   document.write(i +" : " + XMLHttpRequest[i] +"<br>");

                           }
                       }

                   }); 
               });

               //quando mudar o select ensino ou ano da escola atualizar o id_escola
               $('#ensino, #ano').change(function (){
                   var nome_escola = $('#nome_escola').val();
                   var ensino = $('#ensino').val();
                   var ano = $('#ano').val();
                   $.ajax({
                       type: "POST",
                       url: "<?php echo base_url(); ?>" + "index.php/Ajax/mudar_ensino_ou_ano",
                       dataType: 'json',
                       data: {
                           nome_escola : nome_escola,
                           ensino: ensino,
                           ano: ano
                       },
                       success: function(opcoes){
                           $('#id_escola_ano').val(opcoes.id);
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown){
                           alert("Erro!");
                           for(i in XMLHttpRequest) {
                               if(i!="channel")
                                   document.write(i +" : " + XMLHttpRequest[i] +"<br>");

                           }
                       }

                   }); 
               });

            });
        </script>
        
    </body>
</html>
