<h1>Registro de Atrações</h1>
<section>
  <fieldset>
		<legend>Alterar Atração</legend>
    <?php
      $g_id = $_GET['id']; //recebe o id da página ff_fmins_features através de um array

      $sql_sel_features = "SELECT name, description, image_url FROM features WHERE id='".$g_id."'"; //seleciona o nome, descrição e url do BD conforme o id recebido por GET

      $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features);

      $sql_sel_features_preparado->execute();

      $sql_sel_features_dados = $sql_sel_features_preparado->fetch();
     ?>
		<form name="frmcadatracao" method="post" action="?folder=features&file=ff_upd_features"> <!-- manda o formulário para a ff_upd_features-->
      <input type="hidden" name="hidid" value="<?php echo $g_id; ?>"> <!--manda por get o id para a página ff_upd_features-->
			<table>
				<tr>
					<td>Nome:</td>
					<td><input type="text" name="txtnome" value="<?php echo $sql_sel_features_dados['name'] ?>" maxlength="25"></td> <!--mostra o que tem armazenado na posição name do array-->
				</tr>
        <tr>
					<td>Descrição:</td>
					<td><textarea name="txadescricao"><?php echo $sql_sel_features_dados['description']; ?></textarea></td> <!--Mostra o que tem armazenado na posição description do array-->
				</tr>
        <tr>
					<td>URL da Imagem:</td>
					<td><input type="text" name="txturl" value="<?php echo $sql_sel_features_dados['image_url'] ?>"></td> <!-- Mostra o que tem armazenado na posição image_url do array-->
				</tr>
				<tr>
					<td colspan="2" align="center"><button name="btnreiniciar" type="reset">Reiniciar</button><button name="btnsalvar" type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
</section>
