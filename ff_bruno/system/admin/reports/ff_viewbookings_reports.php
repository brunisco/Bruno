<h1>Relatório de Reservas</h1>
<section>
  <?php
    /*o SUM permite realizar a soma dos registros*/
    /*o AS apelida a tabela*/
    /*o GROUBY BY é possível agrupar diversos registros com base em uma ou mais colunas de uma tabela*/
    /*O LEFT JOIN da mais relevância para a tabela da esquerda*/
    /*O RIGHT JOIN da mais relevância para a tabela da direita*/
    $sql_sel_bookings = "SELECT SUM(bookings.normal_quantity) AS totalnormalquantity, SUM(bookings.vip_quantity) AS totalvipquantity, availabletickets.normal_quantity, availabletickets.vip_quantity, dates.date FROM bookings RIGHT JOIN availabletickets ON bookings.availabletickets_id=availabletickets.id AND bookings.status=1 INNER JOIN dates ON availabletickets.dates_id=dates.id GROUP BY dates.id";

    $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

    $sql_sel_bookings_preparado->execute();

    ?>
	<table class="registrados">
		<thead>
			<tr>
				<th width="15%">Data</th>
				<th width="10%">Tipo</th>
				<th width="25%">Quantidade Disponibilizada</th>
        <th width="25%">Quantidade Reservada</th>
        <th width="25%">Quantidade Disponível</th>
			</tr>
		</thead>
		<tbody>

        <?php
          $totalQuantidadeDisponibilizada = 0;
          $totalQuantidadeReservada = 0;
          $totalQuantidadeDisponivel = 0;

          if($sql_sel_bookings_preparado->rowCount()>0){
            while($sql_sel_bookings_dados=$sql_sel_bookings_preparado->fetch()){
              /*subtração para mostrar os ingressos normais e vips disponíveis*/
              $qtdenormaldisponivel = $sql_sel_bookings_dados['normal_quantity'] - $sql_sel_bookings_dados['totalnormalquantity'];
              $qtdevipdisponivel    = $sql_sel_bookings_dados['vip_quantity'] - $sql_sel_bookings_dados['totalvipquantity'];

              /*a variável totalQuantidadeDisponibilizada recebe a soma dos valores de normal_quantity e vip_quantity
              toda vez que entrar na condição while*/
              $totalQuantidadeDisponibilizada = $totalQuantidadeDisponibilizada +
              $sql_sel_bookings_dados['normal_quantity'] +
              $sql_sel_bookings_dados['vip_quantity'];
              /*a variável totalQuantidadeReservada recbe a soma dos valores de totalnormalquantity e totalvipquantity que é
              as reservas que os clientes já realizaram*/
              $totalQuantidadeReservada = $totalQuantidadeReservada +
              $sql_sel_bookings_dados['totalnormalquantity'] +
              $sql_sel_bookings_dados['totalvipquantity'];

              /*soma que tem como resultado o total de ingressos ainda disponíveis para serem reservados*/
              $totalQuantidadeDisponivel = $totalQuantidadeDisponivel +
              $qtdenormaldisponivel +
              $qtdevipdisponivel;
          ?>
            <tr>
              <td rowspan="2"><?php echo $sql_sel_bookings_dados['date']; ?></td> <!--Mostra todas as datas registradas no bd-->
              <td>Normal</td>
              <td><?php echo $sql_sel_bookings_dados['normal_quantity'] ?></td>
              <td><?php echo $sql_sel_bookings_dados['totalnormalquantity']?></td>
              <td><?php echo $qtdenormaldisponivel ?></td>
            </tr>
            <tr>
              <td>Vip</td>
              <td><?php echo $sql_sel_bookings_dados['vip_quantity'] ?></td>
              <td><?php echo $sql_sel_bookings_dados['totalvipquantity']; ?></td>
              <td><?php echo $qtdevipdisponivel; ?></td>
            </tr>
            <?php
          }
        }
             ?>
          <tfoot>
            <th colspan="2" align="right">Total:</th>
            <td><?php echo $totalQuantidadeDisponibilizada; ?></td> <!--Mostra o total de ingressos disponíveis-->
            <td><?php echo $totalQuantidadeReservada; ?></td> <!--Mostra o total de ingressos reservados-->
            <td><?php echo $totalQuantidadeDisponivel; ?></td> <!--Mostra o total de ingressos que aina podem ser reservados-->
          </tfoot>
	</table>
</section>
