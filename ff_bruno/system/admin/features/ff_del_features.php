<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
     $g_id         = $_GET['id']; //recebe por get o id da ff_fmins_features

     $msg_titulo   = "Erro!";
     $class_titulo = "erro";
     $img          = "../../layout/images/admin/alert.png";

    if($g_id==""){
      $msg = "Usuário inexistente.";
    }else{
        $sql_sel_schedules              = "SELECT features_id FROM schedules WHERE features_id='".$g_id."'";

        $sql_sel_schedules_preparado              = $conexaobd->prepare($sql_sel_schedules);

        $sql_sel_schedules_preparado->execute();

        if($sql_sel_schedules_preparado->rowCount()>0){
          $msg = "Não é possível excluir o registro da atração, pois há um  registro de programação associado a ela.";
        }else{
            $sql_del_features               = "DELETE FROM features WHERE id='".$g_id."'"; //deleta apenas o que foi recebido do id

            $sql_del_features_preparado     = $conexaobd->prepare($sql_del_features);

            $sql_del_features_resultado     = $sql_del_features_preparado->execute();

          if($sql_del_features_resultado==true){
            $msg          = "Cadastro de atração excluído com sucesso."; //Se tudo estiver preenchido, aparece as mensagem de confirmação.
            $msg_titulo   = "Confirmação";
            $class_titulo = "sucesso";
          }else{
              $msg          = "Erro ao efetuar a exclusão do usuário.";
          }
        }
      }
     ?>

    <!--class erro e sucesso -->
    <h3 class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=features&file=ff_fmins_features"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
