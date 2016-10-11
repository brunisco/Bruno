      <h1> Aviso </h1>
      <section>
        <div class="mensagem">
        <?php
          $g_id = $_GET['id'];

          $msg_titulo       = "Erro!";
          $class_titulo     = "erro";
          $img              = "../../layout/images/admin/alert.png";
          /*Aqui vou selecionar no banco apenas o id da reserva que foi recebido por GET*/
          $sql_sel_bookings              = "SELECT id FROM bookings WHERE id='".$g_id."' AND status='0'";

          $sql_sel_bookings_preparado    = $conexaobd->prepare($sql_sel_bookings);

          $sql_sel_bookings_preparado->execute();

          if($sql_sel_bookings_preparado->rowCount()==1){
            /*O update faz a atualização de registros no bd conforme o que eu quero atualizar*/
            $sql_upd_bookings           = "UPDATE bookings SET status='1' WHERE id='".$g_id."'";

            $sql_upd_bookings_preparado = $conexaobd->prepare($sql_upd_bookings);

            $sql_upd_bookings_resultado = $sql_upd_bookings_preparado->execute();

            if($sql_upd_bookings_resultado==true){
              $msg = "Reserva confirmada com sucesso.";
              $msg_titulo = "Confirmação";
              $class_titulo = "sucesso";
            }else{
                $msg = "Erro ao confirmar a reserva.";
            }
          }else{
              /*Se o id for diferente de 0, exibirá a msg abaixo*/
              $msg = "Essa reserva possui um status diferente de pendente. Portanto essa reserva já foi declinada, cancelada (pelo cliente) ou confirmada.";
          }
           ?>
          <!--class erro e sucesso -->
          <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
          <p><?php echo $msg ?></p><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
          <a href="?folder=bookings&file=ff_view_bookings"><img src="../../layout/images/admin/back.png"/>Voltar</a>
        </div>
      </section>
    </div>
    <footer>
      Holiday`s Festival &copy; 2017
    </footer>
  </body>
</html>
