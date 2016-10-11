<!--Arquivo que faz o redirecionamento para a página inicial e destrói a sessão-->
<?php
  session_start(); //inicia a sessão
  session_unset(); // destrói as variáveis da sessão
  session_destroy(); //a sessão não existirá mais quando o usuário chegar na página inicial
  header('Location: ../../index.php') //redireciona para a página inicial do festival
 ?>
