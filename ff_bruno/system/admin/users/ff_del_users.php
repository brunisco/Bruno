<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $g_id         = $_GET['id'];//Recendo o id via GET da página ff_fmins_users
      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";


      if($g_id==""){ //Verifica se o usuário está vazio
        $msg = "Usuário inexistente."; //Se estiver, é exibido essa mensagem
      }else{
        $sql_sel_users           = "SELECT id FROM users WHERE permission='0'";

        $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users);

        $sql_sel_users_preparado->execute();

        if($sql_sel_users_preparado->rowCount()==1){ /*se houver apenas um usuário adm cadastrado, o usuário não poderá ser excluído exibindo a msg abaixo*/
          $msg = "Seu usuário não pode ser excluído por ser o único usuário administrador cadastrado.";
        }else{
          $sql_del_users = "DELETE FROM users WHERE id='".$g_id."'"; //Sintaxe para deletar o id recebido

          $sql_del_users_preparado = $conexaobd->prepare($sql_del_users); //Prepara para deletar

          $sql_del_users_resultado = $sql_del_users_preparado->execute(); //Aqui executará a sintaxe.

         if($sql_del_users_resultado==true){
           $msg          = "Cadastro de usuário excluído com sucesso."; //Se não encontrar nenhum erro, exibe a mensagem.
           $msg_titulo   = "Confirmação"; //título da mensagem
           $class_titulo = "sucesso";
            if($g_id==$_SESSION['idUsuario']){ /*se o adm se auto-excluir o mesmo é redirecionado para a página de logout*/
              header('Location: ../../security/authentication/ff_logout_authentication.php');
            }
          }
        }
      }

     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=users&file=ff_fmins_users"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
