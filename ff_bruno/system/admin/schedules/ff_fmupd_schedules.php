<h1>Registro de Programação</h1>
<section>
  <fieldset>
		<legend>Alterar Programação</legend>
    <?php

     $g_datesid                    = $_GET['dates_id']; //recebe o dates_id da ff_fmins
     $g_featuresid                 = $_GET['features_id']; //recebe o features_id da ff_fmins
     //seleciona o start_time da tabela schedules onde o dates_id tem que ser = ao id de dates recebido e o features_id também
     $sql_sel_schedules            = "SELECT start_time FROM schedules WHERE dates_id='".$g_datesid."' AND features_id='".$g_featuresid."'";

     $sql_sel_schedules_preparado  = $conexaobd->prepare($sql_sel_schedules); //prepara a variável para execução no bd

     $sql_sel_schedules_preparado->execute(); //executa no bd

     $sql_sel_schedules_dados      = $sql_sel_schedules_preparado->fetch(); //armaena na variável dados tudo que foi encontrado através do fetch
    ?>
		<form name="frmcadprogramacao" method="post" action="?folder=schedules&file=ff_upd_schedules">
      <input type="hidden" name="hiddates_id" value="<?php echo $g_datesid; ?>"> <!--quando enviar o formulário, o dates_id é enviado para a ff_upd como campo hidden-->
      <input type="hidden" name="hidfeatures_id" value="<?php echo $g_featuresid; ?>"><!--quando enviar o formulário o features_id é enviado para o ff_upd como campo hidden-->
			<table>
        <tr>
					<td>Data do evento:</td>
          <td><?php echo $g_datesid /*da um echo na variável dates que foi recebido para evitar alterações*/?></td>
				</tr>
        <tr>
					<td>Atração:</td>
					<td><?php echo $g_featuresid ?></td>
				</tr>
				<tr>
					<td>Horário do evento:</td>
					<td><input type="text" name="txthorario" value="<?php echo $sql_sel_schedules_dados['start_time']; /*mostra a hora de inicio para edição*/?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button name="btnreiniciar" type="reset">Reiniciar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
</section>
