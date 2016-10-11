<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $p_data           = $_POST['seldata'];
      $p_ingnormais     = $_POST['txtingnormais'];
      $p_preconormais   = $_POST['txtprecoingnormais'];
      $p_qtdeingvip     = $_POST['txtqtdeingvip'];
      $p_precoingvip    = $_POST['txtprecoingvip'];
      $p_id             = $_POST['hidid'];
      $voltar           = "?folder=tickets&file=ff_fmupd_tickets&id=".$p_id."";

      $msg_titulo       = "Erro!";
      $class_titulo     = "erro";
      $img              = "../../layout/images/admin/alert.png";

      if($p_data==""){
          $msg = "Preencha o campo data do evento.";
      }else if($p_ingnormais==""){
            $msg = "Preencha o campo Qtde de ingressos normais.";
          }else if($p_preconormais==""){
              $msg = "Preencha o campo Preço dos ingressos normais.";
            }else if($p_qtdeingvip==""){
                $msg = "Preencha o campo qtde de ingressos VIPs.";
              }else if($p_precoingvip==""){
                  $msg = "Preencha o campo preço ingressos VIPs.";
                }else{
                    //seleciona o dates_id da tabela availabletickets onde o dates_id tem que ser igual ao recebido e o id tem que ser igual ao p_id;
                    $sql_sel_dates              = "SELECT dates_id FROM availabletickets WHERE dates_id='".$p_data."' AND id<>'".$p_id."'";

                    $sql_sel_dates_preparado    = $conexaobd->prepare($sql_sel_dates);

                    $sql_sel_dates_preparado->execute();

                    if($sql_sel_dates_preparado->rowCount()==0){ //se a contagem de linhas for == a 0, a tabela availabletickets atualizará os seus novos valores
                    /*o registro de dates, normal_quantity, normal_value, vip_quantity e vip_value vai atualizar no banco os valores das váriaveis*/
                    $sql_upd_tickets            = "UPDATE availabletickets SET dates_id='".$p_data."', normal_quantity='".$p_ingnormais."', normal_value='".$p_preconormais."', vip_quantity='".$p_qtdeingvip."', vip_value='".$p_precoingvip."' WHERE id='".$p_id."'";
                    
                    $sql_upd_tickets_preparado  = $conexaobd->prepare($sql_upd_tickets); //prepara a variável upd_tickets

                    $sql_upd_tickets_resultado  = $sql_upd_tickets_preparado->execute(); //executa no banco

                      if($sql_upd_tickets_resultado==true){ //se não houver nenhum erro ou se o ingresso já existe o ingresso é cadastrado
                        $msg                    = "Cadastro de ingresso alterado com sucesso."; //msg de confirmação
                        $msg_titulo             = "Confirmação";
                        $class_titulo           = "sucesso";
                        $voltar                 = "?folder=tickets&file=ff_fmins_tickets";
                      }else{
                        $msg = "Erro ao alterar cadastro de ingresso.";
                      }
                    }else{
                      $msg = "Esse ingresso já existe.";
                    }
                  }
     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <a href="<?php echo $voltar; ?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
