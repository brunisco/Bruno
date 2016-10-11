<h2>Perfil</h2>
<fieldset>
    <?php
      /*select para armazenar todos os dados da tabela clients onde o id do usuário tem que ser igual ao id da sessão */
      $sql_sel_clients           = "SELECT * FROM clients WHERE users_id='".$_SESSION['idUsuario']."'";

      $sql_sel_clients_preparado = $conexaobd->prepare($sql_sel_clients); /*prepara para a executação no bd*/

      $sql_sel_clients_preparado->execute(); /*executa no bd*/

      $sql_sel_clients_dados     = $sql_sel_clients_preparado->fetch(); /*armazena na variável dados*/

      $sql_sel_users             = "SELECT username FROM users WHERE username='".$_SESSION['usuario']."'";

      $sql_sel_users_preparado   = $conexaobd->prepare($sql_sel_users);

      $sql_sel_users_preparado->execute();

      $sql_sel_users_dados       = $sql_sel_users_preparado->fetch(); /*armazena na variável dados o nome do usuário logado na sessão*/
    ?>
		<table>
		  <tr>
        <th colpsan="2">Pessoal <a href="?folder=profile&file=ff_fmupdpersonal_profile"><img src="../../layout/images/client/edit.png" title="Editar Informações Pessoais" height="15px" width="15px" style="float:right"></a></th>
      </tr>
      <tr>
        <td>Nome:</td>
        <td><?php echo $sql_sel_clients_dados['name']; /*exibe o nome do usuário logado*/?></td>
      </tr>
      <tr>
        <td>Data de Nascimento:</td>
        <td><?php echo $sql_sel_clients_dados['birthdate']; /*exibe a data de nascimento*/?></td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><?php echo $sql_sel_clients_dados['email']; /*exibe o e-mail do usuário logado*/?></td>
      </tr>
      <tr>
        <td>Telefone:</td>
        <td><?php echo $sql_sel_clients_dados['phone']; /*exibe o telefone*/?></td>
      </tr>
      <tr>
        <th colspan="2">Acesse <a href="?folder=profile&file=ff_fmupdaccess_profile"><img src="../../layout/images/client/edit.png" title="Editar Acesso" height="15px" width="15px" style="float:right"/></a></th>
      </tr>
      <tr>
        <td>Usuário:</td>
        <td><?php echo $sql_sel_users_dados['username'];/*exibe o username do usuário logado*/?> </td>
      </tr>
		</table>
  <hr />
  <a href="?folder=profile&file=ff_del_profile&id=<?php echo $sql_sel_clients_dados['id']?> " >Excluir Usuário<img src="../../layout/images/client/delete.png" title="Excluir Usuário" height="20px" width="20px" /></a>
</fieldset>
