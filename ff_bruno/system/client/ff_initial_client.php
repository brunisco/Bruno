<?php
  if(isset($_GET['msg'])){ /*isset verifica se retornou um valor*/
    $msg = $_GET['msg']; /*caso retorne é exibida a mensagem de que o usuário não tem permissão para ver aquela página*/
  }else{ /*se for false é exibida a mensagem de boas vindas*/
      $msg = "Olá, Seja Bem Vindo";
  }
?>
<h2><?php echo $msg; ?></h2>
