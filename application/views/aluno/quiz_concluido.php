<script type="text/javascript">
    //carregando modulo visualization
      google.load("visualization", "1", {packages:["corechart"]});
      
	  //função de monta e desenha o gráfico
      function drawChart() {
	//variavel com armazenamos os dados, um array de array's 
	//no qual a primeira posição são os nomes das colunas
	var data = google.visualization.arrayToDataTable([
          ['Acertos', 'Quando eu acertei e errei'],
          ['Acertos', <?php echo $_SESSION['acertos'];?>],
          ['Erros', <?php echo $_SESSION['erros'];?>]
          
        ]);
		//opções para exibição do gráfico
        var options = {
          		title: 'Seu Resultado',//titulo do gráfico
		is3D: true // false para 2d e true para 3d o padrão é false
        };
		//cria novo objeto PeiChart que recebe 
		//como parâmetro uma div onde o gráfico será desenhado
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		//desenha passando os dados e as opções
        chart.draw(data, options);
      }
	//metodo chamado após o carregamento
	google.setOnLoadCallback(drawChart);

</script>

<section class="container">
    
    <div class="row">

        <div class="col-md-10">
            
        <?php if($status_quiz == 'ja-fiz-e-passei'){ ?>
            
                <div class="jumbotron jumbotron-green">

                    <h1>Conclui o Quiz</h1> 
                    <p>
                        <?php
                            if(isset($mensagem_pontos)){
                                echo $mensagem_pontos; 
                            }
                        ?>
                    </p>
                    <p>
                        Você Passou no Quiz.
                        Parabéns você Passou!!!
                    </p>
                </div>
            
          <?php  } 
            else{
          ?>
                <div class="jumbotron jumbotron-red">

                    <h1>Conclui o Quiz</h1> 
                    <p>
                        <?php
                            echo $mensagem_pontos;
                        ?>
                    </p>
                    <p>
                        Você reprovou. Que pena!<br/>
                        Estude mais, para na proxima vez você passar.
                    </p>
                </div>
            
            <?php
            }
            ?>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-10">
            
            <div id="chart_div" style="margin-bottom: 40px;width: 900px; height: 500px;"></div>
            
        </div>
    </div>
    
</section>
