<h1>Registro de Ingressos</h1>
<section>
  <fieldset>
      <?php
        $sql_sel_dates           = "SELECT id, date FROM dates ORDER BY date ASC"; //seleciona o id e a data de dates para criar o select dinâmico

        $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates); //prepara para se conectar com o banco

        $sql_sel_dates_preparado->execute(); //executa
      ?>
		<legend>Cadastrar Ingressos</legend>
		<form name="frmcadingressos" method="post" action="?folder=tickets&file=ff_ins_tickets" onsubmit="return validaIngressosDisponivel()">
			<table>
				<tr>
					<td>Data do evento:</td>
          <td>
            <select name="seldata">
              <option value="">Escolha...</option>
              <?php
                while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){ //armazena na variável dados o que foi encontrado no banco
                  ?>
                  <option value="<?php echo $sql_sel_dates_dados['id']; ?>"><?php echo $sql_sel_dates_dados['date']; ?></option> <!--Exibe o que foi armazenado no array -->
              <?php
                }
              ?>
            </select>
          </td>
				</tr>
				<tr>
					<td>Qtde. de ingressos normais:</td>
					<td><input type="txt" name="txtingnormais"></td>
				</tr>
        <tr>
          <td>Preço dos ingressos normais:</td>
          <td><input type="txt" name="txtprecoingnormais"></td>
        </tr>
        <tr>
          <td>Qtde. de ingressos vips:</td>
          <td><input type="txt" name="txtqtdeingvip"></td>
        </tr>
        <tr>
          <td>Preço dos ingressos vips:</td>
          <td><input type="txt" name="txtprecoingvip"></td>
        </tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
	<h2>Ingressos Disponíveis Registrados</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="10%">ID Data</th>
				<th width="10%">Qtde. <br/>Normais</th>
			  <th width="10%">Preço </br>Normais</th>
        <th width="10%">Qtde. VIPs</th>
        <th width="10%">Preço <br/>VIPs</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
      <?php
        $sql_sel_tickets           = "SELECT availabletickets.id, availabletickets.normal_quantity, availabletickets.normal_value, availabletickets.vip_quantity, availabletickets.vip_value, dates.date FROM availabletickets INNER JOIN dates ON availabletickets.dates_id=dates.id"; //seleciona tudo da tabela availabletickets

        $sql_sel_tickets_preparado = $conexaobd->prepare($sql_sel_tickets);

        $sql_sel_tickets_preparado->execute();

        if($sql_sel_tickets_preparado->rowCount()>0){ //se a quantidade de linhas encontrada for > que 0 executa o fetch
          while($sql_sel_tickets_dados=$sql_sel_tickets_preparado->fetch()){ //armazena o que foi encontrado na variável dados
            ?>
			<tr>
				<td><?php echo $sql_sel_tickets_dados['date']; ?></td> <!--Mostra o vaor de dates_id -->
				<td><?php echo $sql_sel_tickets_dados['normal_quantity']; ?></td> <!--Mostra o valor de normal_quantity-->
				<td>R$<?php echo number_format($sql_sel_tickets_dados['normal_value'], 2, ',', '.') ?></td> <!--Mostra o valor de normal_value-->
        <td><?php echo $sql_sel_tickets_dados['vip_quantity']; ?></td> <!--Mostra o valor de vip_quantity -->
        <td>R$<?php echo number_format($sql_sel_tickets_dados['vip_value'], 2, ',', '.') ?></td> <!--Mostra o valor de vip_value-->
				<td align="center"><a href="?folder=tickets&file=ff_fmupd_tickets&id=<?php echo $sql_sel_tickets_dados['id']; /*envia o id para a fmupd_tickets*/?>" title="Editar registro"><img src="../../layout/images/admin/edit.png"></a></td>
				<td align="center"><a href="?folder=tickets&file=ff_del_tickets&id=<?php echo $sql_sel_tickets_dados['id']; /* envia o id para a ff_del_tickets*/?>" title="Excluir registro"><img src="../../layout/images/admin/delete.png"></a></td>
			</tr>
      <?php
    }
  }else{
    ?>
    <tr>
      <td align="center" colspan="7">Não há registros.</td> <!--Se não tiver nenhum registro cadastrado, exibe essa mensagem -->
    </tr>
    <?php
      }
    ?>
		</tbody>
	</table>
</section>
