<?php
  //arquivo de configuração padrão para acesso a área restrita de administrador e cliente
  $server_name = $_SERVER['SERVER_NAME']; //caso seja um servidor local o valor será localhost, porém em casos de hospedagem o valor será o domínio.
  $project_name = 'ff_bruno'; //apenas para aplicações locais, quando for hospedagem não valorar a variável

  define("BASE_URL", "http://".$server_name."/".$project_name."/"); //em caso de hospedagem retire .$project_name.DIRECTORY_SEPARATOR

  include "authentication/ff_session_authentication.php";
  include "authentication/ff_permission_authentication.php";
 ?>
