<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $p_idreserva  = $_POST['txtcodreserva']; /*recebe o id via get da página ff_fmdecline*/
      $p_motivo     = $_POST['selmotivo']; /*rece o motivo via get da página ff_fmdecline*/
      $p_comentario = $_POST['txacomentario']; /*recebe o motivo via get da página ff_fmdecline*/

      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";
      $voltar = "?folder=bookngs&file=ff_fmdecline_bookings.php&id=".$p_idreserva."";

      if($p_idreserva==""){
        $msg = "O campo código da reserva está vazio.";
      }else if($p_motivo==""){
          $msg = "Preencha o campo motivo.";
      }else{
          /*seleciona o id de reservas onde o id do bd tem que ser igual ao id recebido via get*/
          $sql_sel_bookings = "SELECT id FROM bookings WHERE id='".$p_idreserva."' AND status='0'";

          $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

          $sql_sel_bookings_preparado->execute();

          if($sql_sel_bookings_preparado->rowCount()==1){ /*se ele achar um registro, insere na tabela de reservas suspensas os valores nos campos abaixo*/
            $sql_ins_suspendedbookings               = "INSERT INTO suspendedbookings (bookings_id, reason, comment) VALUES ('".$p_idreserva."', '".$p_motivo."', '".$p_comentario."')";

            $sql_ins_suspendedbookings_preparado     = $conexaobd->prepare($sql_ins_suspendedbookings);

            $sql_ins_suspendedbookings_resultado     = $sql_ins_suspendedbookings_preparado->execute();

            if($sql_ins_suspendedbookings_resultado){ /*se ele inserir com sucesso na tabela de suspendedbookings o status da tabela bookings é alterado para declinado*/
              $sql_upd_bookings = "UPDATE bookings SET status='3' WHERE id='".$p_idreserva."'";

              $sql_upd_bookings_preparado            = $conexaobd->prepare($sql_upd_bookings);

              $sql_upd_bookings_resultado            = $sql_upd_bookings_preparado->execute();

              if($sql_upd_bookings_resultado){ /*se não houver nenhum problema na inserção ou alteração do registro, a reserva é declinada*/
                $msg    = "Reserva declinada com sucesso.";
                $msg_titulo = "Confirmação";
                $class_titulo = "sucesso";
                $voltar = "?folder=bookings&file=ff_view_bookings";
              }else{
                  $msg = "Erro ao declinar reserva.";
            }
          }else{
            $msg = "Erro ao declinar reserva.";
          }
        }else{
          $msg = "Erro ao declinar reserva.";
        }
      }
     ?>

    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="<?php echo $voltar ?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
