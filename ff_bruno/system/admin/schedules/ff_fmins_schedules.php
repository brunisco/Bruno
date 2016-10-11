<h1>Registro de Programação</h1>
<section>
  <fieldset>
		<legend>Cadastrar Programação</legend>
		<form name="frmcadprogramacao" method="post" action="?folder=schedules&file=ff_ins_schedules" onsubmit="return validaProgramacao()">
			<table>
        <tr>
					<td>Data do evento:</td>
					<td>
						<select name="seldata">
							<option value="">Escolha...</option>
              <?php
                $sql_sel_dates            = "SELECT id, date FROM dates ORDER BY date ASC"; //seleciona o id e a data da tabela dates por ordem ascendente

                $sql_sel_dates_preparado  = $conexaobd->prepare($sql_sel_dates); //pprepara para conexão com o bd

                $sql_sel_dates_preparado->execute(); //execute

                while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){ //faz a pesquisa no banco e se encontrar retorna mostra as opções de datas
                  ?>
                  <option value="<?php echo $sql_sel_dates_dados['id']; ?>"><?php echo $sql_sel_dates_dados['id']; ?></option> <!--carrega dinamicamente todas as datas registradas no bd da tabela de dates para mostrar através do select -->
                  <?php
                }
                  ?>
						</select>
					</td>
				</tr>
        <tr>
					<td>Atração:</td>
					<td>
						<select name="selatracao">
              <option value="">Escolha...</option>
              <?php
                $sql_sel_features           = "SELECT id FROM features"; //seleciona o id da tabela de atrações

                $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features); //prepara p/ se conectar com o bd

                $sql_sel_features_preparado->execute();

                while($sql_sel_features_dados=$sql_sel_features_preparado->fetch()){ //faz a pesquisa no banco e se encontrar retorna mostra as opções de atrações
                  ?>
                  <option value="<?php echo $sql_sel_features_dados['id']; ?>"><?php echo $sql_sel_features_dados['id']; ?></option> <!--carrega dinamicamente todas as atrações e mostra através do select-->
                  <?php
                }
              ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Horário do evento:</td>
					<td><input type="text" name="txthorario"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>

	<h2>Programações Registradas</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="20%">ID Data</th>
				<th width="20%">Horário</th>
        <th width="20%">ID Atração</th>
				<th width="20%">Editar</th>
				<th width="20%">Excluir</th>
			</tr>
		</thead>
		<tbody>
      <?php
        /*filtra todas programações registradas no bd*/
        $sql_sel_schedules           = "SELECT schedules.features_id, schedules.start_time, dates.date FROM schedules INNER JOIN dates ON dates.id=schedules.dates_id";

        $sql_sel_schedules_preparado = $conexaobd->prepare($sql_sel_schedules); //prepara para a execução no bd

        $sql_sel_schedules_preparado->execute(); //executa no bd

        if($sql_sel_schedules_preparado->rowCount()>0){ //se a contagem de linhas for >0
          while($sql_sel_schedules_dados=$sql_sel_schedules_preparado->fetch()){ //o fetch armazenará tudo o que foi encontrado na variável dados
            ?>
        <tr>
					<td><?php echo $sql_sel_schedules_dados['date'];?></td> <!--Mostra todas as datas registradas -->
					<td><?php echo $sql_sel_schedules_dados['start_time'];?></td><!--Mostra todos os horarários de inicio registrados -->
          <td><?php echo $sql_sel_schedules_dados['features_id'];?></td><!--Mostra todas as atrações registradas-->
					<td align="center"><a href="?folder=schedules&file=ff_fmupd_schedules&dates_id=<?php echo $sql_sel_schedules_dados['dates_id']?>&features_id=<?php echo $sql_sel_schedules_dados['features_id'] /*manda o id das datas e o id das atrações para a página ff_fmupd*/?>" title="Editar registro"><img src="../../layout/images/admin/edit.png"></a></td>
					<td align="center"><a href="?folder=schedules&file=ff_del_schedules&dates_id=<?php echo $sql_sel_schedules_dados['dates_id']?>&features_id=<?php echo $sql_sel_schedules_dados['features_id'] /* manda o id das datas e o id das atrações para a página ff_del*/?>" title="Excluir registro"><img src="../../layout/images/admin/delete.png"></a></td>
				</tr>
        <?php
      }
    }else{
        ?>
        <tr>
          <td align="center" colspan="5">Não há registros.</td> <!--se não houver nenhum registro, exibe essa mensagem-->
        </td>
        <?php
      }
       ?>

		</tbody>
	</table>
</section>
