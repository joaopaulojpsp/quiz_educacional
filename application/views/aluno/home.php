
<section class="container">
    
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
        
        <div class="col-md-10">
            <div class="jumbotron jumbotron-blue animated <?php echo $anim;?>">
        
                <h1>Bem Vindo <?php echo $nome; ?></h1> 

                <p>Quiz Educacional é um sistema web para realização de Quiz.
                Feito para alunos testarem seus conhecimentos.</p>
                
                <p>Quiz Educacional também calcular sua nota e mostra suas nota em
                diferentes graficos, meu nome é joao</p>
                
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-6">
           
	
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
    
    
</section>

