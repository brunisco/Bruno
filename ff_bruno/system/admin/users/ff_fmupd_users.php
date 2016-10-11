<h1>Registro de Administrador</h1>
<section>
  <fieldset>
		<legend>Alterar Administrador</legend>
    <?php
      $g_id = $_GET['id']; //Variável recebe o id por GET

      $sql_sel_users = "SELECT username FROM users WHERE id='".$g_id."'"; //Selecionando o id do campo username da tabela users

      $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); //preparando a sintaxe sql para ela ser executada no SGBD

      $sql_sel_users_preparado->execute(); //executa a sintaxe

      $sql_sel_users_dados = $sql_sel_users_preparado->fetch(); //busca o que ele encontrou na linha 54
     ?>
		<form name="frmcadusuario" method="post" action="?folder=users&file=ff_upd_users">
      <input type="hidden" name="hidid" value="<?php echo $g_id; ?>"> <!--Envia o id para a página ff_upd_users.php -->
			<table>
				<tr>
					<td>Usuário:</td>
					<td><input type="text" name="txtusuario" value="<?php echo $sql_sel_users_dados['username']; ?>" ></td> <!-- posição que faz aparecer o usuário na hora de editar-->
				</tr>
        <tr>
					<td>Senha:</td>
					<td><input type="password" name="pwdadmin"</td>
				</tr>
        <tr>
          <td colspan="2" align="center"><button name="btnreiniciar" type="reset">Reiniciar</button><button type="submit">Salvar</button></td>
        </tr>
			</table>
		</form>
	</fieldset>
</section>
