      <h1> Aviso </h1>
      <section>
        <div class="mensagem">
          <?php
           $p_id         = $_POST['hidid']; //atribui o id recebido da ff_fmupd_features á uma variável
           $p_nome       = $_POST['txtnome'];
           $p_descricao  = $_POST['txadescricao'];
           $p_url        = $_POST['txturl'];
           $voltar       = "?folder=features&file=ff_fmupd_features&id=".$p_id."";

           $msg_titulo   = "Erro!";
           $class_titulo = "erro";
           $img          = "../../layout/images/admin/alert.png";

          if($p_nome==""){
            $msg = "Preencha o campo nome.";
          }else if($p_descricao==""){
              $msg = "Preencha o campo descrição.";
            }else if($p_url==""){
                $msg = "Preencha o campo URL.";
              }else{
                  $sql_sel_features = "SELECT name FROM features  WHERE name='".$p_nome."' AND id<>'".$p_id."' "; //Seleciona o campo nome da tabela de atrações

                  $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features); //prepara a variável para ser executada.

                  $sql_sel_features_preparado->execute();

                  if($sql_sel_features_preparado->rowCount()==0){

                    $sql_upd_features = "UPDATE features SET name='".$p_nome."', description='".$p_descricao."', image_url='".$p_url."' WHERE id='".$p_id."'";

                    $sql_upd_features_preparado = $conexaobd->prepare($sql_upd_features);

                    $sql_upd_features_resultado = $sql_upd_features_preparado->execute();

                    if($sql_upd_features_resultado==true){
                      $msg          = "Cadastro de atração alterado com sucesso."; //Se tudo estiver preenchido, aparece as mensagem de confirmação.
                      $msg_titulo   = "Confirmação";
                      $class_titulo = "sucesso";
                      $voltar       = "?folder=features&file=ff_fmins_features"; //ao clicar no botão, retorna para o registro de atrações
                    }else{ //abre condicional do resultado da execução
                      $msg = "Erro ao alterar cadastro da atração.";
                    }//fecha condicional do resultado da execução
                  }else{ //abre verificação da existência da atração
                    $msg = "Essa atração já existe."; //Se a atração já existir, exibe essa mensagem
                  } //fecha verificação da existência da atração
                } //fecha validação dos campos
           ?>
          <!--class erro e sucesso -->
          <h3 class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
          <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
          <a href="<?php echo $voltar; ?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
        </div>
      </section>
