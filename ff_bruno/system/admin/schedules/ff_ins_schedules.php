      <h1> Aviso </h1>
      <section>
        <div class="mensagem">
          <?php
            $p_dataevento = $_POST['seldata'];
            $p_atracao    = $_POST['selatracao'];
            $p_horario    = $_POST['txthorario'];

            $msg_titulo   = "Erro!";
            $class_titulo = "erro";
            $img          = "../../layout/images/admin/alert.png";

            if($p_dataevento==""){ //se o campo da data estiver vazio
              $msg = "Preencha o campo data do evento."; //exibe essa msg
            }else if($p_atracao==""){ //se o campo atração estiver vazio
                $msg = "Preencha o campo atração."; //exibe essa msg
              }else if($p_horario==""){ //se o campo horarário estivr vazio
                  $msg = "Preencha o campo horário."; //exibe essa msg
                }else{ //se tudo for preenchido corretamente entra no else
                    //seleciona a data, atrações e hora de inicio da tabela de programações onde o id da data tem que ser igual ao que foi digitado e o id de atrações ou o id da data tem que ser igual ao que foi digitaado ou a hora de inicio tem que ser igual também
                    $sql_sel_schedules           = "SELECT dates_id, features_id, start_time FROM schedules WHERE ((dates_id='".$p_dataevento."' AND features_id='".$p_atracao."') OR (dates_id='".$p_dataevento."' AND start_time='".$p_horario."'))";

                    $sql_sel_schedules_preparado = $conexaobd->prepare($sql_sel_schedules); //prepara a sintaxe paraa conexão com o bd

                    $sql_sel_schedules_preparado->execute(); //executa

                    if($sql_sel_schedules_preparado->rowCount()==0){ //através do rowCount podemos ver se ele irá encontrar alguma linha, e se não encontrar o registro é inserido
                      $sql_ins_schedules           = "INSERT INTO schedules (dates_id, features_id, start_time) VALUES ('".$p_dataevento."', '".$p_atracao."', '".$p_horario."')"; //aqui é onde ocorrerá a inserção do registro no bd

                      $sql_ins_schedules_preparado = $conexaobd->prepare($sql_ins_schedules); //prepara a variável para a inserção no bd

                      $sql_ins_schedules_resultado = $sql_ins_schedules_preparado->execute(); //exibe no bd

                      if($sql_ins_schedules_resultado==true){ //se o registro for inserido, é dado as msg de confirmação
                        $msg = "Cadastro de programação efetuado com sucesso.";
                        $msg_titulo = "Confirmação";
                        $class_titulo = "sucesso";
                      }else{
                        $msg = "Erro ao efetuar cadastro de programação."; //se houver algum erro é dado essa msg
                      }
                    }else{
                      $msg   = "Essa programação já existe."; //se já existir uma programação, é dado essa msg
                    }
                  }
           ?>

          <!--class erro e sucesso -->
          <h3 class="<?php echo $class_titulo ?>" ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3>
          <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
          <a href="?folder=schedules&file=ff_fmins_schedules"><img src="../../layout/images/admin/back.png"/>Voltar</a>
        </div>
      </section>
