<?php
  if($_SESSION['permissao'] != $permissao_acesso){
    if($_SESSION['permissao']==0){
      header("Location: ".BASE_URL."system/admin/ff_main_admin.php?msg=Você não tem permissão para ver esta página.");
      exit;
    }else if($_SESSION['permissao']==1){
      header("Location: ".BASE_URL."system/client/ff_main_client.php?msg=Você não tem permissão para ver essa página.");
      exit;
    }else{
      header("Location: ".BASE_URL."security/authentication/ff_logout_authentication.php");
      exit;
    }
  }
 ?>
