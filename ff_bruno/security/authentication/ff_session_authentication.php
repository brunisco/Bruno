<?php
  session_start();
  if(!isset($_SESSION['idSessao'])){ /*isset verifica se as variáveis existem; o ! verifica se é falso*/
    header('Location: http://localhost/ff_bruno/security/authentication/ff_logout_authentication.php'); /*se for falso o usuário é redirecionado para página de logout para destruir a sessão*/
    exit; /*termina a execução do script*/
  }else if($_SESSION['idSessao'] != session_id()){
    header('Location: http://localhost/ff_bruno/security/authentication/ff_logout_authentication.php');
    exit;
  }
 ?>
