<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php

      $p_id         = $_POST['hidid']; //atribui o id recebido da ff_fmupd_users.php á uma variável
      $p_usuario    = $_POST['txtusuario'];
      $p_senha      = $_POST['pwdadmin'];
      $voltar       = "?folder=users&file=ff_fmupd_users&id=".$p_id."";

      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";



      if($p_usuario==""){ //se usuário estiver vazio
        $msg = "Preencha o campo usuário."; //exibe essa mensagem
      }else if($p_senha==""){ //se senha estiver vazio
          $msg = "Preencha o campo senha."; //exibe essa mensagem
        }else{ //se tudo estiver preenchido, executa as linhas abaixo
            $sql_sel_users = "SELECT username FROM users WHERE username='".$p_usuario."' AND id<>'".$p_id."'"; //seleciona a tabela users para alteraço dos cmapo de usuário e id

            $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); //prepara para a execução no SGBD

            $sql_sel_users_preparado->execute(); //executa no SGBD

              if($sql_sel_users_preparado->rowCount()==0){

                $sql_upd_users = "UPDATE users SET username='".$p_usuario."', password='".$p_senha."' WHERE id='".$p_id."'";

                $sql_upd_users_preparado = $conexaobd->prepare($sql_upd_users);

                $sql_upd_users_resultado = $sql_upd_users_preparado->execute();

                if($sql_upd_users_resultado==true){
                  $msg          = "Cadastro de usuário alterado com sucesso!";
                  $msg_titulo   = "Confirmação";
                  $class_titulo = "sucesso";
                  $voltar       = "?folder=users&file=ff_fmins_users";
                }else{ //abre condicional do resultado da execução
                    $msg = "Erro ao alterar o cadastro do usuário.";
                  } //fecha condicional do resultado de execução
                }else{ //abre verificação da existência do usuário
                  $msg = "Esse usuário já existe.";
                } //fecha verificação da existência do usuário
              } //fecha validação dos campos
     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="<?php echo $voltar; ?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
