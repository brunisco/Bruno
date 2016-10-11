<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $p_datesid    = $_POST['hiddates_id']; //recebe o dates_id da página ff_fmupd
      $p_featuresid = $_POST['hidfeatures_id']; //recebe oo features_id da página ff_fmupd
      $p_horario    = $_POST['txthorario'];
      $voltar       = "?folder=schedules&file=ff_fmupd_schedules&dates_id=".$p_datesid."&features_id=".$p_featuresid.""; //se der msg de erro na alteração do registro, nessa linha o dates_id e o features_id são mandados de volta para a ff_fmupd


      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";

      if($p_horario==""){
        $msg = "Preencha o campo data do evento.";
      }else{
          //seleciona o dates_id e o features_idd da tabela de programações onde o horário tem que ser igual ao digitado
          $sql_sel_schedules           = "SELECT dates_id, features_id FROM schedules WHERE start_time='".$p_horario."'";

          $sql_sel_schedules_preparado = $conexaobd->prepare($sql_sel_schedules); //prepara para se conectar com o bd

          $sql_sel_schedules_preparado->execute(); //executa a sintaxe no banco

          if($sql_sel_schedules_preparado->rowCount()==0){ //se ele não encontar nenhuma linha, a condição permitirá que ele altere o horário
            //altera o start_time onde dates_id tem que ser igual ao recebido por post e o features também
            $sql_upd_schedules           = "UPDATE schedules SET start_time='".$p_horario."' WHERE dates_id='".$p_datesid."' AND features_id='".$p_featuresid."'";

            $sql_upd_schedules_preparado = $conexaobd->prepare($sql_upd_schedules); //prepara para conexão no bd

            $sql_upd_schedules_resultado = $sql_upd_schedules_preparado->execute(); //executa a sintaxe

            if($sql_upd_schedules_resultado==true){ //se tudo for preenchido corretamente exibirá essa msg
              $msg          = "Cadastro de programação efetuado com sucesso.";
              $msg_titulo   = "Confirmação";
              $class_titulo = "sucesso";
              $voltar       = "?folder=schedules&file=ff_fmins_schedules";
            }else{
              $msg = "Erro ao alterar cadastro de programação.";
            }
          }else{
            $msg   = "Essa programação já existe."; //se o horário já estiver cadastro no dia, ele não deixará atualizar e exibirá essa msg
          }
        }
 ?>

    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="<?php echo $voltar /*caso tudo dê certo, o usuário é redirecionado para a ff_fmins*/?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
