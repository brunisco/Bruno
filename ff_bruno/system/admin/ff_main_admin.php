<!DOCTYPE html>
<?php
  $permissao_acesso = "0"; /*permissão do usuário 0 é permissão de adm*/
  include "../../security/ff_setup_security.php"; /*o arquivo setup centraliza os includes e verifica se o usuário tem ou não permissão para visualizar a página dependendo da permissão*/
  include "../../security/database/ff_connection_database.php";
?>
<html lang="pt-br">
  <head>
    <title>Administração do Holiday's Festival</title>
    <meta charset="utf-8">
    <meta name="author" content="Bruno Luis da Silva">
    <meta name="description" content="Páginas de administração do Holidays Festival">
    <meta name="keywords" content="Administração, Admin, Holiday, Festival ">
    <link rel="stylesheet" href="../../layout/css/ff_admin_css.css" />
    <script src="../../addons/js/ff_adminformsvalidate_js.js"></script>
  </head>
  <body>
    <header> <!-- início cabeçalho -->
      <img src="../../layout/images/admin/logo.png" class="logo" />
      <h1 class="titulo">Administração do Festival</h1>
      <nav class="menuprincipal"><!-- início menu -->
        <ul>
          <li> <span class="setamenu">▼</span> Gestão de Conteúdo
            <ul>
              <a href="?folder=dates&file=ff_fmins_dates"> <li>Registro de Data</li></a>
              <a href="?folder=features&file=ff_fmins_features"> <li>Registro de Atração</li></a>
              <a href="?folder=tickets&file=ff_fmins_tickets"> <li>Registro de Ingressos Disponíveis</li></a>
              <a href="?folder=schedules&file=ff_fmins_schedules"> <li>Registro de Programação</li></a>
            </ul>
          </li>
          <li> <span class="setamenu">▼</span> Gestão de Negócio
            <ul>
              <a href="?folder=users&file=ff_fmins_users"><li>Registro de Administrador</li></a>
              <a href="?folder=bookings&file=ff_view_bookings"><li>Controle de Reservas</li></a>
              <a href="?folder=reports&file=ff_viewbookings_reports"><li>Relatório de Reservas</li></a>
              <li>4</li>
              <li>5</li>
            </ul>
          </li>
        </ul>
      </nav><!-- fim menu -->
      <div class="areausuario"> <!-- início usuário -->
        <span>aaaaaaaaa aaaaaaaaaa</span>
        <a href='../../security/authentication/ff_logout_authentication.php'> <button>Sair</button> </a>
      </div><!-- fim usuário -->
    </header> <!-- fim cabeçalho -->
    <div class="conteudo"><!-- início conteúdo -->
      <?php
        if(isset($_GET['folder']) && isset($_GET['file'])){
          /*carrega a página com as refêrencias dos gets*/
          if(!include $_GET['folder']."/".$_GET['file'].".php"){
            echo "<h1>Página não encontrada!</h1>";
          }
        }else{
          /*carrega a página inicial*/
          include "ff_initial_admin.php";
        }
			 ?>
    </div><!-- fim conteúdo -->
    <footer>
      Holiday`s Festival. &copy; 2017
    </footer>
  </body>
</html>
