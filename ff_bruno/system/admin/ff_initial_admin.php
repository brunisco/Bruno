<?php
/*CONDIÇÃO QUE VERIFICA SE O USUÁRIO TEM PERMISSÃO PARA ACESSAR AS PÁGINAS DAS ÁREAS ADMINISTRATIVAS*/
if(isset($_GET['msg'])){ /*isset verificará se a variável recebida por GET é verdadeira, ou seja se retornou um valor*/
  $msg = $_GET['msg']; /*caso retorne é exibida a mensagem de que o usuário não tem permissão para ver aquela página*/
}else{
    $msg = "Olá, Seja Bem Vindo"; /*se for false é exibida a mensagem de boas vindas*/
}
?>

  <h2><?php echo $msg; ?></h2>
