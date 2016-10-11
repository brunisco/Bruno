<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <?php
      $p_data           = $_POST['seldata'];
      $p_ingnormais     = $_POST['txtingnormais'];
      $p_preconormais   = $_POST['txtingnormais'];
      $p_qtdeingvip     = $_POST['txtqtdeingvip'];
      $p_precoingvip    = $_POST['txtprecoingvip'];

      $msg_titulo       = "Erro!";
      $class_titulo     = "erro";
      $img              = "../../layout/images/admin/alert.png";

      if($p_data==""){
          $msg = "Preencha o campo Data doeEvento.";
      }else if($p_ingnormais==""){
            $msg = "Preencha o campo Qtde. de ingressos normais.";
          }else if($p_preconormais==""){
              $msg = "Preencha o campo Preço dos ingressos normais.";
            }else if($p_qtdeingvip==""){
                $msg = "Preencha o campo Qtde. de ingressos VIPs.";
              }else if($p_precoingvip==""){
                  $msg = "Preencha o campo Preço ingressos VIPs.";
                }else{
                    $sql_sel_dates           = "SELECT dates_id FROM availabletickets WHERE dates_id='".$p_data."'"; //seleciona o dates_id da tabela availabletickets

                    $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates);

                    $sql_sel_dates_preparado->execute();

                    if($sql_sel_dates_preparado->rowCount()==0){ //se a contagem de linhas for igual a 0
                      //ele vai inserir na tabela os seus respectivos valores
                      $sql_ins_tickets           = "INSERT INTO availabletickets (dates_id, normal_quantity, normal_value, vip_quantity, vip_value) VALUES ('".$p_data."', '".$p_ingnormais."', '".$p_preconormais."', '".$p_qtdeingvip."', '".$p_precoingvip."')";

                      $sql_ins_tickets_preparado = $conexaobd->prepare($sql_ins_tickets); //prepara para se conectar com o banco

                      $sql_ins_tickets_resultado = $sql_ins_tickets_preparado->execute();

                      if($sql_ins_tickets_resultado==true){
                        $msg = "Todos os campos foram preenchidos.";
                        $msg_titulo = "Confirmação";
                        $class_titulo = "sucesso";
                      }else{
                        $msg = "Erro ao efetuar cadastro de ingresso.";
                      }
                    }else{
                      $msg = "Esse ingresso já existe.";
                    }
                  }
     ?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
    <p><?php echo $msg ?></p><!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <a href="?folder=tickets&file=ff_fmins_tickets"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
