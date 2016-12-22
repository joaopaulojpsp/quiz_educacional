<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
         <!-- Icone -->
        <link rel="shortcut icon" 
              href="<?php echo base_url();?>asserts/img/home/logo-quiz-educacional-300x275-78.png"
              type="image/x-icon">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>/asserts/css/bootstrap.min.css">
        
        <!--Para Animação-->
        <link rel="stylesheet" href="<?php echo base_url();?>asserts/css/home/animate.min.css">
        
        <!-- Estilo do aluno -->
        <link rel="stylesheet" href="<?php echo base_url();?>/asserts/css/estilo-aluno.css">

        <!-- jQuery library -->
        <script src="<?php echo base_url();?>/asserts/js/jquery-3.1.1.min.js"></script>
        
        <!-- Graficos -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="<?php echo base_url();?>/asserts/js/bootstrap.min.js"></script>
        
        <title>Painel do Aluno</title>
        
        <?php 
            if(!isset($id)){
                redirect(base_url());
            }
        ?>
    
        
    </head>
    <body>
        
        <nav class="navbar navbar-azul">
            <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/Painel_Aluno">Quiz Educacional</a>
                </div>
                <?php 
                    $link = base_url()."index.php/Painel_Aluno/";
                    $perfil = $link ."visualizar_editar_perfil";
                ?>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $link;?>">Home</a></li>
                  <li><a href="<?php echo $link.'lista_de_testes'; ?>">Realizar Quiz</a></li>
                  <li><a href="#">Administra Notas</a></li> 
                  <li><a href="#">Relatorios</a></li> 
                  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    <li><a href="#">
                            <span class="glyphicon glyphicon-book"></span> Pontos: <?php echo $pontos; ?>
                        </a>
                    </li>
                    
                    <li><a href="<?php echo $perfil;?>"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                    <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                </ul>
                
            </div>
        </nav>
        
        
