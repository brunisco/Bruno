<!DOCTYPE html>
<?php
  include "../../../security/database/ff_connection_database.php";
 ?>
<html>
  <head>
    <title>Holiday`s Festival - Cadastre-se</title>
    <meta charset="utf-8">
    <meta name="author" content="Bruno Luis da Silva">
    <meta name="description" content="Pagina de validação de cadastro.">
    <meta name="keywords" content="Validação, Cadastro, Holiday Festival, Validação de Cadastro, Dados, PHP">
    <link rel="stylesheet" href="../../../layout/css/ff_guest_css.css">
    <script src="../../../addons/js/ff_guestformsvalidate_js.js"></script>
  </head>
  <body>
    <header>
      <img src="../../../layout/images/guest/logo.png" class="img_logo"/> <!--Imagem da logo-->
      <h1>Holiday`s Festival</h1>
      <div class="login"> <!--Área de login-->
        <form name="frmlogin" method="POST" action="../../../security/authentication/ff_login_authentication.php" onsubmit="return validaLogin ()">
          <table>
            <tr>
              <td class="texto_login_senha">Login: <input type="text" name="txtlogin" maxlength="15" size="20" value="" class="inputs_login"></td>
            </tr>
            <tr>
              <td class="texto_login_senha">Senha:  <input type="password" name="pwdlogin" maxlenght="10" size="20" value="" class="inputs_login"></td>
            </tr>
            <tr>
              <td><a href="ff_fmins_client.html"><button type="button" class="areabotoes_autenticacao">Cadastre-se</button></a><button type="submit" class="areabotoes_autenticacao">Entrar</button></td>
            </tr>
          </table>
        </form>
      </div> <!--Fecha área de login-->
    </header>
    <nav id="menu"> <!-- Menu de navegação -->
      <ul>
        <li><a href="../../../index.html">Página Inicial</a></li>
        <li><a href="../pages/ff_about_pages.html">Sobre</a></li>
        <li><a href="../pages/ff_schedule_pages.html">Programação</a></li>
        <li><a href="../pages/ff_lineup_pages.html">Atrações</a></li>
      </ul>
    </nav>
    <h3 class="titulo_areaconteudo">Cadastro</h3>
    <div class="area_conteudo"> <!--Área de conteúdo -->
      <div class="area_cadvalidacao"><!-- Abre área de validação do cadastro -->
        <?php
          $p_nome       = $_POST['txtnome'];
          $p_nascimento = $_POST['txtnasc'];
          $p_email      = $_POST['txtemail'];
          $p_telefone   = $_POST['txttel'];
          $p_usuario    = $_POST['txtusuario'];
          $p_senha      = $_POST['pwdcadastro'];
          $img          = "../../../layout/images/guest/error.png";

          if($p_nome==""){
            $msg = "Preencha o campo nome completo.";
          }else if($p_nascimento==""){
              $msg = "Preencha o campo data de nascimento.";
            }else if($p_email==""){
                $msg = "Preencha o campo e-mail.";
              }else if($p_telefone==""){
                  $msg = "Preencha o campo telefone.";
                }else if($p_usuario==""){
                    $msg = "Preencha o campo usuario.";
                  }else if($p_senha==""){
                      $msg = "Preencha o campo senha.";
                    }else{
                        /*a sintaxe abaixo seleciona o campo e-mail para verificar se já não existe outro e-mail igual no bd*/
                        $sql_sel_clients               = "SELECT email FROM clients WHERE email='".$p_email."'";

                        $sql_sel_clients_preparado     = $conexaobd->prepare($sql_sel_clients); /*prepara para a conexão com o banco de dados*/

                        $sql_sel_clients_preparado->execute(); /*executa no bd*/
                        /*a sintaxe abaixo seleciona o campo username para verificar se já existe um mesmo usuário independente da sua condição*/
                        $sql_sel_users                 = "SELECT username FROM users WHERE username='".$p_usuario."'";

                        $sql_sel_users_preparado       = $conexaobd->prepare($sql_sel_users);  /*prepara para se conectar com o bd */

                        $sql_sel_users_preparado->execute(); /*executa no bd*/

                        if($sql_sel_users_preparado->rowCount()==0){ /*se ele não encontrar nenhum registro, executa as linhas abaixo*/
                          /*insere na tabela users seus respectivos valores*/
                          $sql_ins_users               = "INSERT INTO users (username, password, permission) VALUES ('".$p_usuario."', '".$p_senha."', '1')";

                          $sql_ins_users_preparado     = $conexaobd->prepare($sql_ins_users); /*prepara para conexão com o bd*/

                          $sql_ins_users_resultado     = $sql_ins_users_preparado->execute();

                          if($sql_ins_users_resultado==true){ /*se a variável resultado for verdadeira executa o if abaixo*/

                            if($sql_sel_clients_preparado->rowCount()==0){ /*se não encontrar nenhum registro com o rowCount*/
                             /*o último id inserido no banco de dados(no caso o do usuário) é armazenado na variável usuario_id*/
                            $usuario_id                = $conexaobd->lastInsertId(); //o lastInserid

                            $sql_ins_clients = "INSERT INTO clients (users_id, name, birthdate, email, phone) VALUES ('".$usuario_id."', '".$p_nome."', '".$p_nascimento."', '".$p_email."', '".$p_telefone."')";

                            $sql_ins_clients_preparado = $conexaobd->prepare($sql_ins_clients);

                            $sql_ins_clients_resultado = $sql_ins_clients_preparado->execute();

                            if($sql_ins_clients_resultado==true){
                              $msg  = "Seu cadastro foi efetuado com sucesso.";
                              $img = "../../../layout/images/guest/right.png";

                          }else{ /*se encontrar algum erro ele entra nesse else para excluír o usuário*/
                              $sql_del_users = "DELETE FROM users WHERE id='".$usuario_id."'";
                              /*deleta o usuário caso o cadastro seja preenchido de forma incorreta*/
                              $sql_del_users_preparado = $conexaobd->prepare($sql_del_users);/*prepara para a executação no bd*/

                              $sql_del_users_preparado->execute();

                              $msg = "Erro ao efetuar seu cadastro."; /*mensagem de erro*/
                            }
                          }else{
                            $msg = "Esse e-mail já está em uso."; /*se já houver um registro de e-mail no bd, é exibido essa msg*/
                          }
                        }
                      }else{
                        $msg = "Esse usuário já está em uso."; /*se já houver um usuário registrado no bd, é exibido essa msg*/
                      }
                    }

         ?>
        <img src="<?php echo $img; ?>" class="imgs_validacao"/>
        <h1><?php echo $msg; ?></h1>
      </div><!-- Fecha área de validação de cadastro-->
    </div> <!--Fecha área de conteúdo-->
    <footer>
      <p>Holiday`s Festival. ©</p>
      <div class="area_patrocinio">
        <img src="../../../layout/images/guest/logo_coca.png" class="imgs_patrocinadores"/>
        <img src="../../../layout/images/guest/logo_atlantida.png" class="imgs_patrocinadores"/>
        <img src="../../../layout/images/guest/logo_visa.png" class="imgs_patrocinadores"/>
        <img src="../../../layout/images/guest/logo_samsung.png" class="imgs_patrocinadores"/>
        <img src="../../../layout/images/guest/logo_paviloche.png" class="imgs_patrocinadores"/>
      </div>
    </footer>
  </body>
</html>
