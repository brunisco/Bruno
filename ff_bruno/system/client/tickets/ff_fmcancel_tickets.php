			<h2>Reservas de Ingressos</h2>
			<fieldset>
        <?php
          $g_codigo = $_GET['id']; /*recebe o id por get da ff_view*/
        ?>
				<form name="frmcancelar" method="post" action="?folder=tickets&file=ff_cancel_tickets">
					<table>
						<tr>
							<td width="40%">*Código da Reserva:</td>
							<td><input type="text" name="txtcodigo" value="<?php echo $g_codigo; ?>" readonly></td>
						</tr>
						<tr>
							<td width="40%">*Motivo do cancelamento:</td>
							<td>
                <select name="selmotivo"> <!--Motivos para escolher caso queira cancelar a reserva-->
                  <option value"">Escolha...</option>
                  <option value="FI">Financeiro</option>
                  <option value="IN">Insatisfação</option>
                  <option value="EI">Evento mais importante</option>
                  <option value="AF">Adversidade familiar</option>
                  <option value="OT">Outros</option>
                </select>
              </td>
						</tr>
						<tr>
							<td width="40%">Descrição:</td>
							<td><textarea name="txadescricao" placeholder="Descreva o motivo. (opcional)"></textarea></td> <!--O campo descrição é opcional -->
						</tr>
						<tr>
							<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Reservar</button></td>
						</tr>
					</table>
				</form>
			</fieldset>
		</div>
		<footer>
			&copy; Copyright 2015 Escola Sistêmica. Todos os direitos reservados.
		</footer>
	</body>
</html>
