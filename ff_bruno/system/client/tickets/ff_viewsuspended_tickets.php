<table>
	<thead>
		<tr>
			<th>Código</th>
      <th>Data</th>
      <th>Status</th>
      <th>Motivo</th>
      <th>Comentário</th>
		</tr>
	</thead>
	<tbody>
    <?php
      /*A sintaxe abaixo filtra todas as reservas declinadas e canceladas para mostrar para o cliente*/
      $sql_sel_bookings = "SELECT bookings.id, bookings.status, suspendedbookings.reason, suspendedbookings.comment, dates.date FROM clients INNER JOIN bookings ON bookings.clients_id=clients.id INNER JOIN suspendedbookings ON suspendedbookings.bookings_id=bookings.id INNER JOIN availabletickets ON bookings.availabletickets_id=availabletickets.id INNER JOIN dates ON dates.id=availabletickets.dates_id WHERE ((users_id='".$_SESSION['idUsuario']."') AND (status='2' OR status='3')) ORDER BY date ASC";

      $sql_sel_bookings_preparado = $conexaobd->prepare($sql_sel_bookings);

      $sql_sel_bookings_preparado->execute();
			/*condição que transforma o valor numérico do registro do status no banco de dados para a palavra associada ao status, para visualização pelo cliente*/
        if($sql_sel_bookings_preparado->rowCount()>0){
          while($sql_sel_bookings_dados = $sql_sel_bookings_preparado->fetch()){
            if($sql_sel_bookings_dados['status']==2){
              $sql_sel_bookings_dados['status'] = "Cancelada";
            }else if($sql_sel_bookings_dados['status']==3){
                $sql_sel_bookings_dados['status'] = "Declinada";
            }
				/*condição que transforma a sigla abreviada no banco para exibição do motivo para o cliente*/
        if($sql_sel_bookings_dados['reason']=="FI"){
            $sql_sel_bookings_dados['reason'] = "Financeiro";
          }else if($sql_sel_bookings_dados['reason']=="IN"){
              $sql_sel_bookings_dados['reason'] = "Insatisfação";
            }else if($sql_sel_bookings_dados['reason']=="EI"){
                $sql_sel_bookings_dados['reason'] = "Evento mais importante";
              }else if($sql_sel_bookings_dados['reason']=="AF"){
                  $sql_sel_bookings_dados['reason'] = "Adversidade familiar";
              	}else if($sql_sel_bookings_dados['reason']=="OT"){
										$sql_sel_bookings_dados['reason']=="Outros";
								}
      ?>
            <tr>
              <td><?php echo $sql_sel_bookings_dados['id']; ?></td>
              <td><?php echo $sql_sel_bookings_dados['date']; ?></td>
              <td><?php echo $sql_sel_bookings_dados['status']; ?></td>
              <td><?php echo $sql_sel_bookings_dados['reason']; ?></td>
              <td><?php echo $sql_sel_bookings_dados['comment']; ?></td>
            </tr>
          <?php
          }
        }
        ?>

	</tbody>
</table>
<a href="?folder=tickets&file=ff_view_tickets"><button type="button">Retornar</button></a>
