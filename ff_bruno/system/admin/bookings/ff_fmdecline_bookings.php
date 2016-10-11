<h1>Registro de Datas</h1>
<section>
  <fieldset>
		<legend>Declinar Reserva</legend>
    <?php
      $g_id = $_GET['id']; /*recebe o id da reserva da página ff_view_bookings*/
      /*O Inner Join faz a junção de duas ou mais tabelas;*/
      $sql_sel_bookings = "SELECT bookings.id, suspendedbookings.bookings_id, suspendedbookings.reason, suspendedbookings.comment FROM bookings INNER JOIN suspendedbookings ON bookings.id=suspendedbookings.bookings_id";

      $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

      $sql_sel_bookings_preparado->execute();
    ?>
		<form name="frmreserva" method="post" action="?folder=bookings&file=ff_decline_bookings">
			<table>
				<tr>
					<td>Código da Reserva:</td>
					<td><input type="text" name="txtcodreserva" value="<?php echo $g_id; ?>" readonly="readonly" maxlength="10"></td> <!--O id recebido por get é enviado essa página para somente leitura-->
				</tr>
				<tr>
					<td>Motivo da declinação:</td>
					<td>
            <select name="selmotivo">
              <option value="">Escolha...</option>
              <option value="NC">Não foi possível entrar em contato</option>
              <option value="DS">Dados suspeitos</option>
              <option value="OU">Outros</option>
            </select>
        </td>
        <tr>
          <td>Comentário:</td>
          <td><textarea name="txacomentario" placeholder="Digite seu comentário."></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
</section>
