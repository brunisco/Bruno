<h2>Alterar Perfil de Acesso</h2>
<fieldset>
  <?php
    /*faz a seleção no bd na tabela users, onde o username tem que ser igual ao usuário da sessão*/
    $sql_sel_users           = "SELECT username FROM users WHERE username='".$_SESSION['usuario']."'";

    $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); /*prepara para a conexão com o bd*/

    $sql_sel_users_preparado->execute(); /*executa a sintaxe no banco*/

    $sql_sel_users_dados     = $sql_sel_users_preparado->fetch(); /*todos os dados encontrados serão armazenados com o fetch na variável dados*/
   ?>
	<form name="frm_fmupdaccess_profile" method="post" action="?folder=profile&file=ff_updaccess_profile"> <!--Envia o formulário para a ff_upd-->
		<table>
			<tr>
				<td width="40%">Usuário:</td>
				<td><input type="text" name="txtusuario" value="<?php echo $sql_sel_users_dados['username']; ?>" maxlenght="20" readonly></td>
			</tr>
			<tr>
				<td width="40%">Senha:</td>
				<td><input type="password" name="pwdcliente" placeholder="Digite sua nova senha." maxlength="32"></td>
			</tr>

			<tr>
				<a href="?folder=profile&file=ff_view_profile"><td colspan="2" align="center"><button name="btnretornar" type="button">Retornar</button></a><button type="submit">Salvar</button></td>
			</tr>
		</table>
	</form>
</fieldset>
