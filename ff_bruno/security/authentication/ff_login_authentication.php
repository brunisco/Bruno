  <div class="area_cadvalidacao"><!--Abre área de validação do login php-->

    <!-- Armazena os campos do login em uma variável-->
    <?php
      $p_login      = $_POST['txtlogin'];
      $p_senhalogar = $_POST['pwdlogin'];
      $img = "layout/images/guest/error.png";

    //Verifica se os dados inseridos estão preenchidos
      if($p_login==""){
        $msg = "Preencha o campo login.";
      }else if($p_senhalogar==""){
          $msg = "Preencha o campo senha.";
        }else{
          $sql_sel_users           = "SELECT id, username, password, permission FROM users WHERE username='".$p_login."' AND password='".$p_senhalogar."'"; //Seleciona da tabela users quando  o usuário e a senha forem iguais ao que foi digitado

          $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);

          $sql_sel_users_preparado->execute();

          if($sql_sel_users_preparado->rowCount()>0){
            $sql_sel_users_dados = $sql_sel_users_preparado->fetch(); //armazena os dados encontrados num array

            session_start(); //inicia a sessão

            $_SESSION['idUsuario'] = $sql_sel_users_dados['id']; //armazena na sessão o id do usuário para saber quem está autenticado

            $_SESSION['usuario']   = $sql_sel_users_dados['username']; //armazena na sessão o usuário para mostrar nas telas do back-end

            $_SESSION['permissao'] = $sql_sel_users_dados['permission']; //armazena na sessão para mostrar o que ele pode acessar

            $_SESSION['idSessao']  = session_id(); //armazena o id da sessão para futura implementação de segurança

            if($_SESSION['permissao']==0){ //se a permissão for 0 ele redirecionará para a área administrativa
              header('Location: system/admin/ff_main_admin.php');
            }else if($_SESSION['permissao']==1){ //se a permissão for 1 ele mostrará a mensagem de sistema em manuntenção
                header('Location: system/client/ff_main_client.php');
              }else{
                $msg = "Permissão inválida.";
          }
        }else{
          $msg = "Dados de autenticação incorretos.";
        }
      }

     ?>
     <img src="<?php echo $img; ?>" class="imgs_validacao"/> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
     <h1><?php  echo $msg; ?></h1>
   </div> <!--Fecha área validação de login php-->
