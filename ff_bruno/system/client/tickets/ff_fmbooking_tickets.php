<h2>Reservas de Ingressos</h2>
<fieldset>
  <?php
    /*faz a consulta no banco de todas as datas que tiverem algum registro de ingresso disponível associado à ele*/
    $sql_sel_dates           = "SELECT dates.id, dates.date FROM dates INNER JOIN availabletickets ON availabletickets.dates_id=dates.id";

    $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates);

    $sql_sel_dates_preparado->execute();

  ?>
	<form name="frmreserva" method="post" action="?folder=tickets&file=ff_booking_tickets" onsubmit="return validaReserva()">
		<table>
			<tr>
				<td width="40%">Data:</td>
				<td>
					<select name="seldata">
						<option value="">Escolha...</option>
            <?php
              while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){
                ?>
                <option value="<?php echo $sql_sel_dates_dados['id']; ?>"><?php echo $sql_sel_dates_dados['date']; ?></option>
              <?php
              }
            ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="40%">Quatidade de ingressos normais:</td>
				<td><input type="text" name="txtqtdeingnormais" placeholder="Máx. 4 ingressos" maxlength="10"></td>
			</tr>
			<tr>
				<td width="40%">Quantidade de ingressos VIPs:</td>
				<td><input type="text" name="txtqtdeingvips" placeholder="Máx. 4 ingressos" maxlength="10"></td>
			</tr>

			<tr>
				<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Reservar</button></td>
			</tr>
		</table>
	</form>
</fieldset>
<fieldset>
  <table>
    <tr>
      <th colspan='3'>Preço dos ingressos</th>
    </tr>
    <tr>
      <th>Dia</th>
      <th>R$ Normal</th>
      <th>R$ VIP</th>
    </tr>
    <?php
      $sql_sel_availabletickets           = "SELECT availabletickets.id, availabletickets.normal_value, availabletickets.vip_value, dates.date FROM availabletickets INNER JOIN dates ON availabletickets.dates_id=dates.id";

      $sql_sel_availabletickets_preparado = $conexaobd->prepare($sql_sel_availabletickets);

      $sql_sel_availabletickets_preparado->execute();


      if($sql_sel_availabletickets_preparado->rowCount()>0){
        while($sql_sel_availabletickets_dados = $sql_sel_availabletickets_preparado->fetch()){
          ?>
          <tr>
            <td><?php echo $sql_sel_availabletickets_dados['date']; ?></td>
            <!--com o number_format você pode definir a formatação de um número. O primeiro parâmetro define quantas casas após a vírgula, o segundo é o caractere separador decimal e o último é o separador de milhar-->
            <td>R$ <?php echo number_format($sql_sel_availabletickets_dados['normal_value'], 2, ',', '.') ?></td>
            <td>R$ <?php echo number_format($sql_sel_availabletickets_dados['vip_value'], 2, ',', '.') ?></td>
          </tr>
          <?php
        }
      }
     ?>
  </table>
</fieldset>
