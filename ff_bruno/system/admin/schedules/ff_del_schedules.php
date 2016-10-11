<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
    $p_datesid    = $_GET['dates_id']; //recebe o id da data recebido por get pela página ff_fmins_schedules
    $p_featuresid = $_GET['features_id']; //recebe o id das atrações recebido por get pela pãgina ff_fmins_schedules

    $msg_titulo   = "Erro!";
    $class_titulo = "erro";
    $img          = "../../layout/images/admin/alert.png";

    if(($p_datesid)&&($p_featuresid)==""){ //se o id data e o id da atração for vazio, entra na condição abaixo
      $msg                          = "Programação inexistente";
    }else{
      $sql_del_schedules = "DELETE FROM schedules WHERE dates_id='".$p_datesid."' AND features_id='".$p_featuresid."'"; //seleciona os campos para exclusão

      $sql_del_schedules_preparado  = $conexaobd->prepare($sql_del_schedules); //prepara a sintaxe para exclusão

      $sql_del_schedules_resultado  = $sql_del_schedules_preparado->execute(); //executa para deletar o registro

      if($sql_del_schedules==true){
        $msg                        = "Cadastro de programação excluído com sucesso."; //se não encontrar nenhum erro, exibe essa mensagem
        $msg_titulo                 = "Confirmação";
        $class_titulo               = "sucesso";
      }else{
        $msg                        = "Erro ao excluir programação.";
      }
    }

    ?>

    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=schedules&file=ff_fmins_schedules"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
