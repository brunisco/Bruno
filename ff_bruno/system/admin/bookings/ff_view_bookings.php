<h1>Controle de Reservas</h1>
<section>
	<h2>Reservas Registradas</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="5%">ID</th>
				<th width="30%">Cliente</th>
				<th width="30%">E-mail</th>
        <th width="10%">Telefone</th>
        <th width="10%">Data do Evento</th>
        <th width="5%">Normais</th>
        <th width="5%">Vips</th>
				<th width="5%">Ações</th>
			</tr>
		</thead>
		<tbody>
      <?php
        /*A cláusula INNER JOIN é usado para recuperar dados de duas ou mais tabelas através da igualdade das chaves estrangeiras*/
        /*O ON faz a comparação entre as tabelas*/
        $sql_sel_bookings = "SELECT bookings.id, bookings.normal_quantity, bookings.vip_quantity, clients.name, clients.email, clients.phone, dates.date FROM bookings INNER JOIN clients ON bookings.clients_id=clients.id INNER JOIN availabletickets ON availabletickets.id=bookings.availabletickets_id INNER JOIN dates ON dates.id=dates_id WHERE status='0'";

        $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

        $sql_sel_bookings_preparado->execute();

        if($sql_sel_bookings_preparado->rowCount()>0){ /*rowCount retorna o número de linhas que foram encontradas com o select*/
          while($sql_sel_bookings_dados=$sql_sel_bookings_preparado->fetch()){ /*o fetch armazena tudo que foi encontrado na consulta em uma variável*/
            ?>
          <tr>
            <td><?php echo $sql_sel_bookings_dados['id']; ?></td>
            <td><?php echo $sql_sel_bookings_dados['name']; ?></td>
            <td><?php echo $sql_sel_bookings_dados['email']; ?></td>
            <td><?php echo $sql_sel_bookings_dados['phone']; ?></td>
            <td><?php echo $sql_sel_bookings_dados['date']; ?></td>
            <td><?php echo $sql_sel_bookings_dados['normal_quantity']?></td>
            <td><?php echo $sql_sel_bookings_dados['vip_quantity']?></td>
            <td align="center"><a href="?folder=bookings&file=ff_confirm_bookings&id=<?php echo $sql_sel_bookings_dados['id']; ?>" title="Confirmar Reserva"><img src="../../layout/images/admin/confirm.png"><a href="?folder=bookings&file=ff_fmdecline_bookings&id=<?php echo $sql_sel_bookings_dados['id']; ?>" title="Declinar Reserva"><img src="../../layout/images/admin/decline.png"></a></a></td>
          </tr>
          <?php
        }
      }else{
        ?>
        <td align="center" colspan="8">Não há nenhuma reserva pendente para aprovação.</td>
        <?php
      }
        ?>
		</tbody>
	</table>
</section>
