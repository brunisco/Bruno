<h1>Registro de Ingressos</h1>
<section>
  <fieldset>
      <?php
        $sql_sel_dates           = "SELECT id, date FROM dates ORDER BY date ASC"; //seleciona o id e a data de dates para criar o select dinâmico

        $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates); //prepara para se conectar com o banco

        $sql_sel_dates_preparado->execute(); //executa
      ?>
			<legend>Alterar Ingresso</legend>
      <?php
        $g_id                       = $_GET['id']; //recebe o id da ff_fmins
        /*seleciona o dates_id onde  o id tem ue ser igual ao recebido*/
        $sql_sel_tickets            = "SELECT dates_id FROM availabletickets WHERE id='".$g_id."'";

        $sql_sel_tickets_preparado  = $conexaobd->prepare($sql_sel_tickets); /*prepara para se conectar ao banco*/

        $sql_sel_tickets_preparado->execute();

        $sql_sel_tickets_dados      = $sql_sel_tickets_preparado->fetch(); /*armazena na variável dados através do fetch se encontrar alguma coisa no banco*/
       ?>
		<form name="frmcadingressos" method="post" action="?folder=tickets&file=ff_upd_tickets">
    <input type="hidden" name="hidid" value="<?php echo $g_id; /*envia o id para a ff_upd quando enviar o formulário*/?>">
			<table>
				<tr>
					<td>Data do evento:</td>
          <td>
            <select name="seldata">
              <option value="">Escolha...</option>
              <?php
                while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){ //armazena na variável dados o que foi encontrado no banco
                    $selected = ""; //inicializa ou zera o valor da variável selected
                  if($sql_sel_tickets_dados['dates_id']==$sql_sel_dates_dados['id']){
                    //se o dates_id for igual ao id de da váriavel dates a variável selected recebe o valor selected
                    $selected = "selected";
                  }
                  ?>
                  <option value="<?php echo $sql_sel_dates_dados['id']; ?> " " <?php echo $selected; /*mostra o valor de selected*/?> "><?php echo $sql_sel_dates_dados['date']; ?></option>. <!--Exibe o que foi armazenado no array -->
              <?php
                }
              ?>
            </select>

          </td>
				</tr>
        <?php
          /*seleciona os campos de availabletickets onde o id tem que ser igual ao recebido */
          $sql_sel_tickets           = "SELECT normal_quantity, normal_value, vip_quantity, vip_value FROM availabletickets WHERE id='".$g_id."'";

          $sql_sel_tickets_preparado = $conexaobd->prepare($sql_sel_tickets); //prepara para conexão com o bd

          $sql_sel_tickets_preparado->execute(); //executa no bd

          $sql_sel_tickets_dados     = $sql_sel_tickets_preparado->fetch(); //armazena na variável dados se o fetch encontrar alguma coisa
         ?>

				<tr>
					<td>Qtde. de ingressos normais:</td>
					<td><input type="txt" name="txtingnormais" value="<?php echo $sql_sel_tickets_dados['normal_quantity']; ?>"></td> <!--Mostra todoss os ingressos normais registrados no bd-->
				</tr>
        <tr>
          <td>Preço dos ingressos normais:</td>
          <td><input type="txt" name="txtprecoingnormais" value="<?php echo $sql_sel_tickets_dados['normal_value']; ?>"></td> <!--Mostra todos os ingressos com valores normais registrados no bd-->
        </tr>
        <tr>
          <td>Qtde. de ingressos VIPs:</td>
          <td><input type="txt" name="txtqtdeingvip" value="<?php echo $sql_sel_tickets_dados['vip_quantity']; ?>"></td> <!--Mostra a quantidade de todos os ingressos vips registrados no bd -->
        </tr>
        <tr>
          <td>Preço dos ingressos VIPs:</td>
          <td><input type="txt" name="txtprecoingvip" value="<?php echo $sql_sel_tickets_dados['vip_value']; ?>"></td> <!--Mostra o valor do ingresso vip -->
        </tr>
				<tr>
					<td colspan="2" align="center"><button name="btnreiniciar"type="reset">Reiniciar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
</section>
