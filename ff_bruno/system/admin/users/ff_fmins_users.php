<h1>Registro de Administrador</h1>
<section>
  <fieldset>
		<legend>Cadastrar Administrador</legend>
		<form name="frmcadusuario" method="post" action="?folder=users&file=ff_ins_users" onsubmit="return validadeAdmin()">
			<table>
				<tr>
					<td>Usuário:</td>
					<td><input type="text" name="txtusuario"></td>
				</tr>
        <tr>
					<td>Senha:</td>
					<td><input type="password" name="pwdadmin"</td>
				</tr>
        <tr>
          <td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
        </tr>
			</table>
		</form>
	</fieldset>
	<h2>Administradores Registrados</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="30%">Usuário</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
      <?php
        $sql_sel_users = "SELECT id, username FROM users WHERE permission='0'"; //Seleciona o campo da tabela "username" com permissão "0"

        $sql_sel_users_preparado = $conexaobd->prepare($sql_sel_users); //prepara o código para a execução no SGDB

        $sql_sel_users_preparado->execute(); //usa a variável preparado e utilizado o metódo execute.

        if($sql_sel_users_preparado->rowCount()>0){ //Se a contagem de linhas for maior que 0, ele usará o fetch
          while($sql_sel_users_dados /*esse array "dados" vai conter todos os dados da linha*/= $sql_sel_users_preparado->fetch()){ //o fetch manda pegar os dados do SGDB.
          //enquanto ele conseguir executar o fetch ele repete com a estrutura de repetição
       ?>
			<tr>
				<td><?php echo $sql_sel_users_dados['username']; ?></td> <!--Mostra todos os usuários cadastrados -->
				<td align="center"><a href="?folder=users&file=ff_fmupd_users&id=<?php echo $sql_sel_users_dados['id']; ?>" title="Editar registro"><img src="../../layout/images/admin/edit.png"></a></td> <!--Através de um array, o id é enviados por GET para a página ff_fmupd_users.php -->
				<td align="center"><a href="?folder=users&file=ff_del_users&id=<?php echo $sql_sel_users_dados['id']; ?>" title="Excluir registro"><img src="../../layout/images/admin/delete.png"></a></td> <!--Através de um array, o id é enviado para a página de deletar registro. Pelo id podemos identificar qual registro quero deletar -->
			</tr>
      <?php
          }
        }else{ //abre else
          ?>
          <tr>
            <td align="center" colspan="3">Não há registros.</td> <!--Se não tiver registros, exibe essa mensagem-->
          </tr>
            <?php
          } //fecha else
          ?>
		</tbody>
	</table>
</section>
