<h1> Aviso </h1>
<section>
  <div class="mensagem">

    <?php
      $g_id = $_GET['id']; //recebe o id da ff_fmins_tickets

      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";

      if($g_id==""){
        $msg = "Ingresso inexistente."; //se o id estiver vazio, entra nessa condição
      }else{
        /*O select abaixo tem como intenção verificar  a integridade referencial da tabela de availabletickets*/
        $sql_sel_bookings                    = "SELECT id FROM bookings WHERE availabletickets_id='".$g_id."'";

        $sql_sel_bookings_preprado          = $conexaobd->prepare($sql_sel_bookings);

        $sql_sel_bookings_preprado->execute();

        if($sql_sel_bookings_preprado->rowCount()>0){ /*se houver algum registro de ingresso associado a tabela, é exzibido a mensagem abaixo*/
          $msg = "Não é possível excluir o registro de ingressos disponíveis, pois há registros de ingressos disponíveis associados a ele.";
        }else{
            $sql_del_availabletickets            = "DELETE FROM availabletickets WHERE id='".$g_id."'"; //deleta o registro  de acordo com o id recebido

            $sql_del_availabletickets_preparado  = $conexaobd->prepare($sql_del_availabletickets); //prepara a sintaxe para exclusão

            $sql_del_availabletickets_resultado  = $sql_del_availabletickets_preparado->execute(); //executa para deletar o registro

            if($sql_del_availabletickets_resultado==true){
              $msg                      = "Cadastro de ingresso excluído com sucesso."; //se não encontrar nenhum erro, exibe essa mensagem
              $msg_titulo               = "Confirmação";
              $class_titulo             = "sucesso";
            }else{
                $msg                      = "Erro ao efetuar a exclusão do ingresso.";
            }
        }
      }
     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <a href="?folder=tickets&file=ff_fmins_tickets"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
