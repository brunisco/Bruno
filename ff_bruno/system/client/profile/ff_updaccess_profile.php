<h2> Aviso </h2>
<?php
  $p_senha = $_POST['pwdcliente']; /*recebe o valor do formulário fmupdaccess*/
  $imagem  = "../../layout/images/client/alert_icon.png";
  $voltar  = "folder=profile&file=ff_fmupdaccess_profile.php";

  if($p_senha==""){ /*se o usuário não preencher o campo da senha*/
    $msg = "Preencha o campo senha"; /*exibirá essa msg*/
  }else {
      /*se o campo senha for preenchido, a sintaxe abaixo vai fazer com que os dados sejam alterados*/
      $sql_upd_users            = "UPDATE users SET password='".$p_senha."' WHERE username='".$_SESSION['usuario']."'";
      /*prepara para a conexão com o bd*/
      $sql_upd_users_preparado  = $conexaobd->prepare($sql_upd_users);
      /*executa a sintaxe no bd para realizar a atualização dos dados*/
      $sql_upd_users_preparado->execute();

          if($sql_upd_users_preparado==true){ /*se tudo ocorrer bem, dará a msg abaixo*/
            $msg    = "Senha alterada com sucesso!";
            $imagem = "../../layout/images/client/done_icon.png";
            $voltar = "?folder=profile&file=ff_view_profile";
          }else{
              $msg  = "Erro ao alterar senha.";
          }
        }

?>
<div id='mensagem'>
	<h1><img src="<?php echo $imagem; ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
	<a href="<?php echo $voltar; ?>"><button type="button">Retornar</button></a>
</div>
