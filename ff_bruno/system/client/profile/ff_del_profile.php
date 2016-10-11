<h2> Aviso </h2>
<?php
  $imagem = "../../layout/images/client/done_icon.png";
  $g_id = $_GET['id'];

  $sql_sel_bookings = "SELECT id FROM bookings WHERE ((clients_id='".$g_id."') AND (status=0 OR status=1))";

  $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

  $sql_sel_bookings_preparado->execute();

  if($sql_sel_bookings_preparado->rowCount()>0){ /*se a executação da sintaxe acima retornar algum valor, significa que existe alguma reserva pendente ou confirmada relacionada ao cliente*/
    $msg = "Não é possível excluir este cliente, pois existem registros de reservas (pendentes ou confirmadas) associados a ele.";
    $imagem = "../../layout/images/client/alert_icon.png";
  }else{
    $sql_upd_bookings = "UPDATE bookings SET clients_id=NULL WHERE clients_id='".$g_id."'"; /*seta todas as reservas relacionadas ao cliente que está tentando se excluir para NULL*/

    $sql_upd_bookings_preparado = $conexaobd->prepare($sql_upd_bookings);

    $sql_upd_bookings_resultado = $sql_upd_bookings_preparado->execute();

    if($sql_upd_bookings_resultado==true){
      $sql_del_clients           = "DELETE FROM clients WHERE users_id='".$_SESSION['idUsuario']."'";

      $sql_del_clients_preparado = $conexaobd->prepare($sql_del_clients); /*prepara para se conectar com o banco*/

      $sql_del_clients_resultado = $sql_del_clients_preparado->execute(); /*executa a sintaxe no banco*/

    if($sql_del_clients_resultado==true){
        /*deleta u usuário também usando as variáveis de sessão*/
        $sql_del_users           = "DELETE FROM users WHERE id='".$_SESSION['idUsuario']."'";

        $sql_del_users_preparado = $conexaobd->prepare($sql_del_users);

        $sql_del_users_resultado = $sql_del_users_preparado->execute();
    }

    if($sql_del_users_resultado==true){ /*se a exclusão do usuário for efetuada com sucesso, o usuário é redirecionado para a página de visitante do festival*/
      header('Location: ../../security/authentication/ff_logout_authentication.php ');
    }else{ /*se houver algum erro, é dado essa mensagem.*/
      $msg = "Erro ao efetuar exclusão de cadastro.";
      $imagem = "../../layout/images/client/alert_icon.png";
    }
  }else{
    $msg = "Erro ao desvincular reservas canceladas e/ou declinadas desse usuário.";
    $imagem = "../../layout/images/client/alert_icon.png";
  }
}


?>
<div id='mensagem'>
	<h1><img src="<?php echo $imagem ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
	<a href="?folder=profile&file=ff_view_profile"><button type="button">Retornar</button></a>
</div>
