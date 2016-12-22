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
        
        <!-- Estilo do professor -->
        <link rel="stylesheet" href="<?php echo base_url();?>/asserts/css/estilo-professor.css">

        <!-- jQuery library -->
        <script src="<?php echo base_url();?>/asserts/js/jquery-3.1.1.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="<?php echo base_url();?>/asserts/js/bootstrap.min.js"></script>
        
        <title>Painel do Professor</title>
        
        <?php 
            if(!isset($id)){
                redirect(base_url());
            }
        ?>
        
        
    </head>
    <body>
        
        <nav class="navbar navbar-verde">
            <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/Painel_Professor">Quiz Educacional</a>
                </div>
                
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo base_url(); ?>index.php/Painel_Professor">Home</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/Painel_Professor/fazer_quiz">Fazer Quiz</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/Painel_Professor/visualizar_quiz">Visualizar Quiz</a></li> 
                  <li><a href="#">Visualizar Alunos</a></li> 
                  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url();?>index.php/Painel_Professor/visualizar_editar_perfil"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                    <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                </ul>
                
            </div>
        </nav>
        
        
