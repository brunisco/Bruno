<h2> Aviso </h2>
<?php
  $p_data           = $_POST['seldata'];
  $p_qtdeing_normal = $_POST['txtqtdeingnormais'];
  $p_qtdeing_vip    = $_POST['txtqtdeingvips'];

  $img              = "../../layout/images/client/alert_icon.png";
  $voltar           = "?folder=tickets&file=ff_fmbooking_tickets";

  if($p_data==""){
    $msg = "Preencha o campo data.";
  }else if($p_qtdeing_normal==""){
      $msg = "Preencha o campo quantidade de ingressos normais.";
    }else if($p_qtdeing_vip==""){
        $msg = "Preencha o campo quantidade de ingressos VIPs.";
      }else if ($p_qtdeing_normal==0 && $p_qtdeing_vip==0){
          $msg = "O valor inserido não pode ser zero.";
        }else if($p_qtdeing_normal<0 || $p_qtdeing_normal>4){
            $msg = "Quantidade máx. de ingressos  normais excedido ou número inválido.";
          }else if($p_qtdeing_vip<0 || $p_qtdeing_vip>4){
              $msg = "Quantidade máx de ingressos VIPs excedido ou número invalido.";
            }else{
              /*aqui estou filtrando todos os ids dos usuários que forem igual ao id da sessão*/
              $sql_sel_clients                    = "SELECT id FROM clients WHERE users_id='".$_SESSION['idUsuario']."'";

              $sql_sel_clients_preparado          = $conexaobd->prepare($sql_sel_clients);

              $sql_sel_clients_preparado->execute();

              $sql_sel_clients_dados              = $sql_sel_clients_preparado->fetch();

              $id_cliente                         = $sql_sel_clients_dados['id']; /*armazena o id encontrado na variável id do cliente*/
              /*seleciona o id da tabela de ingressos disponíveis onde o id da data tem que ser igual a variável da data*/
              $sql_sel_availabletickets           = "SELECT id, normal_quantity AS qtde_normal_disponiveis, vip_quantity AS qtde_vip_disponiveis FROM availabletickets WHERE dates_id='".$p_data."'";

              $sql_sel_availabletickets_preparado = $conexaobd->prepare($sql_sel_availabletickets);

              $sql_sel_availabletickets_preparado->execute();

              $sql_sel_availabletickets_dados     = $sql_sel_availabletickets_preparado->fetch();

              $id_ing_disponivel = $sql_sel_availabletickets_dados['id'];

              $sql_sel_bookings                   = "SELECT availabletickets_id, clients_id, normal_quantity, vip_quantity, status FROM bookings WHERE ((clients_id='".$id_cliente."' AND availabletickets_id='".$id_ing_disponivel."') AND (status='0' OR status='1'))";

              $sql_sel_bookings_preparado         = $conexaobd->prepare($sql_sel_bookings);

              $sql_sel_bookings_preparado->execute();

              if($sql_sel_bookings_preparado->rowCount()>0){
                $msg    = "Você já cadastrou uma reserva com essa data.";
              }else{
                /*SUM realiza a soma dos valores contidos em um determinado campo numérico para os registros que atendem a consulta*/
                /*O AS altera em uma consulta o nome do campo ou tabela para um "apelido" temporário*/
                $sql_sel_bookings                 = "SELECT SUM(normal_quantity) AS qtde_normal_reservados, SUM(vip_quantity) AS qtde_vip_reservados FROM bookings WHERE ((availabletickets_id='".$id_ing_disponivel."') AND (status='0' OR status='1'))";

                $sql_sel_bookings_preparado       = $conexaobd->prepare($sql_sel_bookings);

                $sql_sel_bookings_preparado->execute();

                $sql_sel_bookings_dados           = $sql_sel_bookings_preparado->fetch();

                $qtde_normal_disponiveis = $sql_sel_availabletickets_dados['qtde_normal_disponiveis'];
                $qtde_vip_disponiveis    = $sql_sel_availabletickets_dados['qtde_vip_disponiveis'];
                $qtde_normal_reservados  = $sql_sel_bookings_dados['qtde_normal_reservados'];
                $qtde_vip_reservados     = $sql_sel_bookings_dados['qtde_vip_reservados'];


                if($qtde_normal_disponiveis -($qtde_normal_reservados + $p_qtdeing_normal)<0){
                  $msg = "Não há ingressos normais disponíveis.";
                }else if($qtde_vip_disponiveis -($qtde_vip_reservados + $p_qtdeing_vip)<0){
                  $msg = "Não há ingressos vips disponíveis.";
                }else{
                  $sql_ins_bookings               = "INSERT INTO bookings (availabletickets_id, clients_id, normal_quantity, vip_quantity, status) VALUES ('".$id_ing_disponivel."', '".$id_cliente."', '".$p_qtdeing_normal."', '".$p_qtdeing_vip."', '0')";

                  $sql_ins_bookings_preparado     = $conexaobd->prepare($sql_ins_bookings);

                  $sql_ins_bookings_resultado     = $sql_ins_bookings_preparado->execute();

                  if($sql_ins_bookings_resultado){ /*se a variável for igual a verdadeiro, da as msg abaixo*/
                    $msg    = "Reserva efetuada com sucesso.";
                    $img    = "../../layout/images/client/done_icon.png";
                    $voltar = "ff_main_client.php";
                  }else{
                      $msg  = "Erro ao efetuar reserva.";
                  }
                }
              }
            }
?>
<div id='mensagem'>
	<h1><img src="<?php echo $img ?>" height='60px' width='60px'> <?php echo $msg; ?></h1>
	<a href="<?php echo $voltar; ?>"><button type="button">Retornar</button></a>
  <a href="?folder=tickets&file=ff_view_tickets"><button type="button">Minhas Reservas</button></a> <!-- botão para redirecionar o usuário para as reservas feitas-->
</div>
