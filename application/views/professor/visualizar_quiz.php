<section class="container">
    
    <!--Tabela de Quizes Ativos-->
    <div class="row">
        <div class="col-md-12">
            <h3>Quiz Ativos</h3>
            <form class="scrool">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Disciplina</th>
                        <th>Perguntas</th>
                        <th>% para passar</th>
                        <th>Data Inicio</th>
                        <th>Data Fim</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($quizes_1 as $quiz){
                                echo '<tr>';
                                $id_quiz = $quiz['id'];
                                $base = base_url();
                                $link = $base ."index.php/Painel_Professor/editar_quiz/".$id_quiz; 
                                echo '<td> <a href="'.$link.'">'.$quiz['nome'].'</a></td>';
                                echo '<td>'.$quiz['disciplina'].'</td>';
                                echo '<td>'.$quiz['quant_de_perguntas'].'</td>';
                                echo '<td>'.$quiz['por_para_passar'].'</td>';
                               
                                $inicio = $quiz['data_inicio'];
                                $fim = $quiz['data_fim'];
                                
                                echo '<td>'. $inicio .'</td>';
                                echo '<td>'. $fim .'</td>';
                                
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                
            </form>
            
        </div>
        
    </div>
    
    <!--Tabela de Quizes Inativos-->
    <div class="row">
        <div class="col-md-12">
            <h3 style="margin-top: 70px">Quiz Inativos</h3>
            <form style="margin-bottom: 40px"  class="scrool">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Disciplina</th>
                        <th>Perguntas</th>
                        <th>% para passar</th>
                        <th>Ativar Quiz</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($quizes_0 as $quiz){
                                echo '<tr>';
                                $id_quiz = $quiz['id'];
                                $base = base_url();
                                $link = $base ."index.php/Painel_Professor/editar_quiz/".$id_quiz; 
                                echo '<td> <a href="'.$link.'">'.$quiz['nome'].'</a></td>';
                                
                                echo '<td>'.$quiz['disciplina'].'</td>';
                                echo '<td>'.$quiz['quant_de_perguntas'].'</td>';
                                echo '<td>'.$quiz['por_para_passar'].'</td>';
                                
                                $url = base_url()."index.php/Painel_Professor/ativar_quiz/".$quiz['id'];
                                $butao = '<a href="'.$url.'" class="btn btn-success">Ativar</a>';
                                echo '<td>'.$butao.'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                
            </form>
            
        </div>
        
    </div>
    
</section>

