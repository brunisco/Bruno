<!DOCTYPE html>
<?php
  include "security/database/ff_connection_database.php";
 ?>
<html>
  <head>
    <title>Holiday`s Festival - Página Inicial</title>
    <meta charset="utf-8">
    <meta name="author" content="Bruno Luis da Silva">
    <meta name="description" content="Página inicial do holiday`s festival">
    <meta name="keywords" content="Inicio, Holiday, Holiday`s, Festival">
    <link rel="stylesheet" href="layout/css/ff_guest_css.css">
    <script src="addons/js/ff_guestformsvalidate_js.js"></script>
  </head>
  <body>
    <header>
      <img src="layout/images/guest/logo.png" class="img_logo"/> <!--Imagem da logo-->
      <h1>Holiday`s Festival</h1>
      <div class="login"> <!--Área de login-->
        <form name="frmlogin" method="POST" action="index.php?folder=security/authentication&file=ff_login_authentication" onsubmit="return validaLogin()">
          <table>
            <tr>
              <td class="texto_login_senha">Login: <input type="text" name="txtlogin" maxlength="15" size="20" value="" class="inputs_login"></td>
            </tr>
            <tr>
              <td class="texto_login_senha">Senha:  <input type="password" name="pwdlogin" maxlenght="10" size="20" value="" class="inputs_login"></td>
            </tr>
            <tr>
              <td><a href="index.php?folder=system/guest/client&file=ff_fmins_client"><button type="button" class="areabotoes_autenticacao">Cadastre-se</button></a><button type="submit" class="areabotoes_autenticacao">Entrar</button></td>
            </tr>
          </table>
        </form>
      </div> <!--Fecha área de login-->
    </header>
    <nav id="menu"> <!-- Menu de navegação -->
      <ul>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="index.php?folder=system/guest/pages&file=ff_about_pages">Sobre</a></li>
        <li><a href="index.php?folder=system/guest/pages&file=ff_schedule_pages">Programação</a></li>
        <li><a href="index.php?folder=system/guest/pages&file=ff_lineup_pages">Atrações</a></li>
      </ul>
    </nav>
    <?php
      /*carregamento dos títulos de acordo com o arquivo*/
      if(!isset($_GET['file'])){
        $titulo = "O Festival";
      }else if($_GET['file']=="ff_schedule_pages"){
          $titulo = "Programação";
        }else if($_GET['file']=="ff_about_pages"){
            $titulo = "Sobre";
          }else if($_GET['file']=="ff_lineup_pages"){
              $titulo = "Atrações";
            }else if($_GET['file']=="ff_fmins_client.php"){
                $titulo = "Cadastro";
            }else{
                  $titulo = "";
            }
    ?>
    <h3 class="titulo_areaconteudo"><?php echo $titulo; ?></h3>
    <div class="area_conteudo"> <!--Área de conteúdo -->
      <?php
        if(isset($_GET['folder']) && isset($_GET['file'])){
          if(!include $_GET['folder']."/".$_GET['file'].".php"){
            echo "<h1>Página não encontrada!</h1>";
          }
        }else{
          include "ff_initial_guest.php";
        }
        ?>
        </div>
    <footer>
      <p>Holiday`s Festival. ©</p>
      <div class="area_patrocinio">
        <img src="layout/images/guest/logo_coca.png" class="imgs_patrocinadores"/>
        <img src="layout/images/guest/logo_atlantida.png" class="imgs_patrocinadores"/>
        <img src="layout/images/guest/logo_visa.png" class="imgs_patrocinadores"/>
        <img src="layout/images/guest/logo_samsung.png" class="imgs_patrocinadores"/>
        <img src="layout/images/guest/logo_paviloche.png" class="imgs_patrocinadores"/>
      </div>
    </footer>
  </body>
</html>
