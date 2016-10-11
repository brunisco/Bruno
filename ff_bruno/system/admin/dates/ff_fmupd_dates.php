      <h1>Registro de Datas</h1>
      <section>
        <fieldset>
  				<legend>Alterar Data</legend>
          <?php
            $g_id                    = $_GET['id'];

            $sql_sel_dates           = "SELECT date, description FROM dates WHERE id='".$g_id."'"; //Seleciona os campos data e descrição

            $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates); //prepara a variável para ser executada

            $sql_sel_dates_preparado->execute(); //executa

            $sql_sel_dates_dados     = $sql_sel_dates_preparado->fetch(); //busca a data e a descrição e salva na variável dados
           ?>
  				<form name="frmcaddata" method="post" action="?folder=dates&file=ff_upd_dates">
            <input type="hidden" name="hidid" value="<?php echo $g_id; ?>"> <!--Envia o id para a página ff_upd_dates -->
            <table>
  						<tr>
  							<td>Data:</td>
  							<td><input type="text" name="txtdata" value="<?php echo $sql_sel_dates_dados['date']; ?>" placeholder="aaaa-mm-dd" maxlength="10"></td> <!--Posição do array para pegar o valor de date na variável dados-->
  						</tr>
  						<tr>
  							<td>Descrição:</td>
  							<td><textarea name="txadescricao"><?php echo $sql_sel_dates_dados['description']; ?></textarea></td> <!-- Posição do array para pegar o valor de description na variável dados-->
  						</tr>
  						<tr>
  							<td colspan="2" align="center"><button name="btnreiniciar" type="reset">Reiniciar</button><button type="submit">Salvar</button></td>
  						</tr>
  					</table>
  				</form>
  			</fieldset>
      </section>
