<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $g_id = $_GET['id']; //recebendo o id via get da página ff_fmins_dates

      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";

      if($g_id==""){
        $msg = "Data inexistente.";
      }else{
        $sql_sel_availabletickets           = "SELECT id FROM availabletickets WHERE dates_id='".$g_id."'";

        $sql_sel_availabletickets_preparado = $conexaobd->prepare($sql_sel_availabletickets);

        $sql_sel_availabletickets_preparado->execute();

        $sql_sel_schedules                  = "SELECT dates_id FROM schedules WHERE dates_id='".$g_id."'";

        $sql_sel_schedules_preparado        = $conexaobd->prepare($sql_sel_schedules);

        $sql_sel_schedules_preparado->execute();

        if($sql_sel_availabletickets_preparado->rowCount()>0){
          $msg = "Não é possível excluir essa data, pois existem registros de ingressos disponíveis associados a ela.";
        }else if($sql_sel_schedules_preparado->rowCount()>0){
            $msg = "Não é possível excluir essa data, pois existem registros de programação associados a ela.";
          }else{
            $sql_del_dates                  = "DELETE FROM dates WHERE id='".$g_id."'"; //deleta o registro de dada referente ao id recebido

            $sql_del_dates_preparado        = $conexaobd->prepare($sql_del_dates); //prepara para a execução

            $sql_del_dates_resultado        = $sql_del_dates_preparado->execute();

            if($sql_del_dates_resultado==true){
              $msg  = "Cadastro de data excluído com sucesso."; //se não encontrar nenhum erro, exibe essa mensagem
              $msg_titulo = "Confirmação";
              $class_titulo = "sucesso";
            }else{
                $msg = "Erro ao efetuar a exclusão da data.";
            }
        }
      }
    ?>
    <h3  class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p> <!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=dates&file=ff_fmins_dates"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
