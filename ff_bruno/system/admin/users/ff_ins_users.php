<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $p_usuario = $_POST['txtusuario'];
      $p_senha   = $_POST['pwdadmin'];

      $msg_titulo = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";

      if($p_usuario==""){
        $msg = "Preencha o campo usuário.";
      }else if($p_senha==""){
          $msg = "Preencha o campo senha.";
        }else{
          $sql_sel_users = "SELECT username FROM users WHERE username='".$p_usuario."'"; //Seleciona o campo da tabela "username" com permissão "0"

          $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); //prepara o código para a execução no SGDB

          $sql_sel_users_preparado->execute(); //usa a variável preparado e utilizado o metódo execute.

          if($sql_sel_users_preparado->rowCount()==0){

            $sql_ins_users = "INSERT INTO users (username, password, permission) VALUES ('".$p_usuario."', '".$p_senha."', '0')"; //instruçào para inserir alguma coisa no BD

            $sql_ins_users_preparado = $conexaobd->prepare($sql_ins_users); //prepara para ser executado no SGDB

            $sql_ins_users_resultado = $sql_ins_users_preparado->execute(); //Armazena o valor do retorno da executação da instrução, verdadeiro ou falso

            if($sql_ins_users_resultado==true){ //se a sintaxe estiver correta é exibido as mensagens
              $msg = "Cadastro de usuário efetuado com sucesso."; //Se não encontrar nenhum erro, exibe a mensagem.
              $msg_titulo = "Confirmação"; //título da mensagem
              $class_titulo = "sucesso";
            }else{
              $msg = "Erro ao efetuar o cadastro de usuário.";
            }
          }else{
            $msg   = "Este usuário já existe.";
          }
        }
     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=users&file=ff_fmins_users"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
