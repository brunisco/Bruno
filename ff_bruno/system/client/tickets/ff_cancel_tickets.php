<h2> Aviso </h2>
<?php
  $p_codigo    = $_POST['txtcodigo'];
  $p_motivo    = $_POST['selmotivo'];
  $p_descricao = $_POST['txadescricao'];

  $imagem  = "../../layout/images/client/alert_icon.png";
  $voltar  = "?folder=tickets&file=ff_fmcancel_tickets&id=".$p_codigo.""; /*se der algum erro e o usuário clicar em retornar, o id é enviado para a página de fmcancel*/

  if($p_codigo==""){
    $msg = "Código da reserva vazio. Por favor tente novamente.";
    }else if($p_motivo==""){
      $msg = "Selecione um motivo.";
  }else{
      $sql_sel_suspendedbookigs = "SELECT bookings_id, reason, comment FROM suspendedbookings WHERE bookings_id='".$p_codigo."'";

      $sql_sel_suspendedbookigs_preparado = $conexaobd->prepare($sql_sel_suspendedbookigs);

      $sql_sel_suspendedbookigs_preparado->execute();

      if($sql_sel_suspendedbookigs_preparado->rowCount()==0){
        $sql_ins_suspendedbookings = "INSERT INTO suspendedbookings (bookings_id, reason, comment) VALUES ('".$p_codigo."', '".$p_motivo."', '".$p_descricao."')";
        /*insere os valores digitados na tabela de suspendedbookings*/
        $sql_ins_suspendedbookings_preparado = $conexaobd->prepare($sql_ins_suspendedbookings);

        $sql_ins_suspendedbookings_resultado = $sql_ins_suspendedbookings_preparado->execute();

        if($sql_ins_suspendedbookings_resultado){
          /*se o insert der certo, o status da tabela bookings é trocado para 2 (cancelada)*/
          $sql_upd_bookings = "UPDATE bookings SET status='2' WHERE id='".$p_codigo."'";

          $sql_upd_bookings_preparado = $conexaobd->prepare($sql_upd_bookings);

          $sql_upd_bookings_resultado = $sql_upd_bookings_preparado->execute();

          if($sql_upd_bookings_resultado){
            $msg = "Reserva cancelada com sucesso.";
            $imagem = "../../layout/images/client/done_icon.png";
            $voltar = "?folder=tickets&file=ff_view_tickets";

          }else{
              $msg = "Erro ao efetuar cancelamento da reserva.";
          }
        }else{
            $msg = "Erro ao efetuar cancelamento da reserva.";
        }
      }else{
          $msg = "Erro ao efetuar cancelamento da reserva.";
      }
  }

?>
<div id='mensagem'>
	<h1><img src="<?php echo $imagem ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
	<a href="<?php echo $voltar ?>"><button type="button">Retornar</button></a>
</div>
