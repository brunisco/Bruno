<h2>Reservas Efetuadas</h2>
  <?php
    /*Selecionando os campos necessários das tabelas bookings, clients, availabletickets e dates. Onde o id do usuária tem que ser igual ao id da sessão.*/
    $sql_sel_dates = "SELECT bookings.id, dates.date, bookings.normal_quantity, bookings.vip_quantity, bookings.status, availabletickets.normal_value, availabletickets.vip_value FROM clients INNER JOIN bookings ON clients.id=bookings.clients_id INNER JOIN availabletickets ON availabletickets.id=bookings.availabletickets_id INNER JOIN dates ON availabletickets.dates_id=dates.id WHERE ((users_id='".$_SESSION['idUsuario']."') AND (status='0' OR status='1'))";

    $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates);

    $sql_sel_dates_preparado->execute();
    ?>
<table>
	<thead>
		<tr>
			<th>Código</th>
      <th>Data</th>
      <th>Quant. Normais</th>
      <th>Quant. Vips</th>
      <th>Valor total da reserva</th>
      <th>Status</th>
      <th>Cancelar</th>
		</tr>
	</thead>
	<tbody>
    <?php
      $totalValor = 0;
      $totalnormal = 0;
      $totalvip = 0;
      $totalNormalVip = 0;

      if($sql_sel_dates_preparado->rowCount()>0){
        while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){
          $totalnormal = $sql_sel_dates_dados['normal_quantity'] * $sql_sel_dates_dados['normal_value'];
          $totalvip    = $sql_sel_dates_dados['vip_quantity'] * $sql_sel_dates_dados['vip_value'];
          $totalNormalVip = $totalnormal + $totalvip; /*armazena na variável o total do valor de ingresos normais e vips*/

          if($sql_sel_dates_dados['status']==0){ /*ESSE IF TROCA O 0 OU O 1 DO STATUS PARA PENDENTE E CONFIRMADA*/
            $sql_sel_dates_dados['status'] = "Pendente";
          }else if($sql_sel_dates_dados['status']==1){
                $sql_sel_dates_dados['status'] = "Confirmada";
          }

      ?>
      		<tr>
      			<td><?php echo $sql_sel_dates_dados['id']; ?></td>
            <td><?php echo $sql_sel_dates_dados['date']; ?></td>
            <td><?php echo $sql_sel_dates_dados['normal_quantity']; ?></td>
            <td><?php echo $sql_sel_dates_dados['vip_quantity']; ?></td>
            <!--com o number_format você pode definir a formatação de um número. O primeiro parâmetro define quantas casas após a vírgula, o segundo é o caractere separador decimal e o último é o separador de milhar-->
            <td>R$ <?php echo number_format($totalNormalVip, 2, ',', '.') ?></td>
            <td><?php echo $sql_sel_dates_dados['status']; ?></td> <!--Se o status for 0 aparecerá pendente, se for 1 aparecerá confirmado-->
            <td><a href="?folder=tickets&file=ff_fmcancel_tickets&id=<?php echo $sql_sel_dates_dados['id']; ?>"><img src="../../layout/images/client/decline.png"></td></a>
      		</tr>
    <?php
        }
      }else{
        ?>
          <tr>
            <td align="center" colspan="6">Não há ingressos reservados</td>
          </tr>
      <?php
      }
        ?>
	</tbody>
</table>
<?php
  /*a sintaxe abaixo filtra todas as reservas canceladas ou declinadas para posteriormente, se caso haja algum registro, exibir um link notifica o usuário que ele possui tais status da reserva*/
  $sql_sel_bookings = "SELECT bookings.id, bookings.normal_quantity, bookings.vip_quantity, bookings.status FROM clients INNER JOIN bookings ON clients.id=bookings.clients_id WHERE ((users_id='".$_SESSION['idUsuario']."') AND (status='2' OR status='3'))";

  $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

  $sql_sel_bookings_preparado->execute();

  if($sql_sel_bookings_preparado->rowCount()>0){
  ?>
    <h3><a href="?folder=tickets&file=ff_viewsuspended_tickets">Você possui <?php echo $sql_sel_bookings_preparado->rowCount() /*mostra a quantidade de ingressos cancelados ou declinados*/?> reservas suspensas. <a/></h3>
    <?php
  }
    ?>
