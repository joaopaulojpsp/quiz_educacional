

        <footer>
            <p><strong>Criado por João Paulo Sena Padilha</strong></p>
            <p>Contato: <a href="https://mailto:joaopaulojpsp@gmail.com">
            joaopaulojpsp@gmail.com</a>.</p>
        </footer>

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
