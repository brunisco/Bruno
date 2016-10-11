<h2>Aviso</h2>
<?php
  $p_nome     = $_POST['txtnome'];
  $p_nasc     = $_POST['txtnasc'];
  $p_email    = $_POST['txtemail'];
  $p_telefone = $_POST['txttelefone'];
  $imagem     = "../../layout/images/client/alert_icon.png";
  $voltar     = "?folder=profile&file=ff_fmupdpersonal_profile";

  if($p_nome==""){
    $msg = "Preencha o campo nome.";
  }else if($p_nasc==""){
      $msg = "Preencha o campo nascimento.";
    }else if($p_email==""){
        $msg = "Preencha o campo e-mail.";
      }else if($p_telefone==""){
          $msg = "Preencha o campo telefone.";
      }else{
        /*a sintaxe do select do select selecioná o id do usuário e verificará se não existe um e-mail igual no banco. E o usuário tem que ser diferente do id da sessão */
        $sql_sel_clients               = "SELECT * from clients WHERE email='".$p_email."' AND users_id<>'".$_SESSION['idUsuario']."'";

        $sql_sel_clients_preparado     = $conexaobd->prepare($sql_sel_clients);

        $sql_sel_clients_preparado->execute();

          if($sql_sel_clients_preparado->rowCount()==0){ /*quando o registro do clients for atualizado, atualizará o clients*/
            $sql_upd_clients           = "UPDATE clients SET name='".$p_nome."', birthdate='".$p_nasc."', email='".$p_email."', phone='".$p_telefone."' WHERE users_id='".$_SESSION['idUsuario']."'";

            $sql_upd_clients_preparado = $conexaobd->prepare($sql_upd_clients);

            $sql_upd_clients_resultado = $sql_upd_clients_preparado->execute();

            if($sql_upd_clients_resultado==true){
              $msg    = "Dados alterados com sucesso!";
              $imagem = "../../layout/images/client/done_icon.png";
              $voltar = "?folder=profile&file=ff_view_profile";
            }else{
              $msg = "Erro ao atualizar seu cadastro.";
            }
          }else{
            $msg = "Esse e-mail já está em uso.";
          }
        }
 ?>
<div id='mensagem'>
	<h1><img src="<?php echo $imagem ?>" height='60px' width='60px'><?php echo $msg; ?></h1>
	<a href="<?php echo $voltar ?>"><button type="button">Retornar</button></a>
</div>
