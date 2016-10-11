<h1>Registro de Atrações</h1>
<section>
  <fieldset>
		<legend>Cadastrar Atração</legend>
		<form name="frmcadatracao" method="post" action="?folder=features&file=ff_ins_features" onsubmit="return validaAtracao ()">
			<table>
				<tr>
					<td>Nome:</td>
					<td><input type="text" name="txtnome" value="" maxlength="25"></td>
				</tr>
        <tr>
					<td>Descrição:</td>
					<td><textarea name="txadescricao"></textarea></td>
				</tr>
        <tr>
					<td>URL da Imagem:</td>
					<td><input type="text" name="txturl"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
	<h2>Atrações Registradas</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="50%">Nome</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
			<?php
        $sql_sel_features           = "SELECT * FROM features"; //Seleciona tudo da tabela features

        $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features); //preparando a variável para ser executada no SGBD

        $sql_sel_features_preparado->execute();

        if($sql_sel_features_preparado->rowCount()>0){
          while($sql_sel_features_dados=$sql_sel_features_preparado->fetch()){
      ?>
            <tr>
              <td><?php echo $sql_sel_features_dados['id']; ?></td><!--Mostra todos os registros de id existentes no banco-->
              <td><?php echo $sql_sel_features_dados['name']; ?></td><!--Mostra todos os registros de nome existentes no banco-->
              <td align="center"><a href="?folder=features&file=ff_fmupd_features&id=<?php echo $sql_sel_features_dados['id'] /*manda por get para a pagina fmupd_features o id*/?>" title="Editar registro"><img src="../../layout/images/admin/edit.png"></a></td>
  						<td align="center"><a href="?folder=features&file=ff_del_features&id=<?php echo $sql_sel_features_dados['id'] /*Manda o id por get para a página ff_del_features*/?>" title="Excluir registro"><img src="../../layout/images/admin/delete.png"></a></td>
            </tr>
            <?php
          }
        }else{
          ?>
        <tr>
          <td align="center" colspan="5">Não há registros.</td>
        </tr>
        <?php
      }
        ?>
		</tbody>
	</table>
</section>
