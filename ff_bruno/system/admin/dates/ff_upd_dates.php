      <h1> Aviso </h1>
      <section>
        <div class="mensagem">

          <!-- Armazena os dados dos formulários da página do registro das dadas.-->
          <?php
            $p_data       = $_POST['txtdata'];
            $p_descricao  = $_POST['txadescricao'];
            $p_id         = $_POST['hidid'];
            $voltar       = "?folder=dates&file=ff_fmupd_dates&id=".$p_id."";

            $msg_titulo   = "Erro!";
            $class_titulo = "erro";
            $img          = "../../layout/images/admin/alert.png";
            //Verificação para ver se os campos estão preenchidos.
            if($p_data==""){ //Se data estiver vazio
              $msg = "Preencha o campo data."; //exibe essa mensagem
            }else{ //se tudo estiver preenchido, executa as linhas abaixo
                $sql_sel_dates = "SELECT date FROM dates WHERE date='".$p_data."' AND id<>'".$p_id."'";//aqui estou selecionando o campo date da tabela dados

                $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates); //preparando a variável para ser executada

                $sql_sel_dates_preparado->execute(); //executando a variável

                if($sql_sel_dates_preparado->rowCount()==0){

                  $sql_upd_dates = "UPDATE dates SET date='".$p_data."', description='".$p_descricao."' WHERE id='".$p_id."'"; //selecionando os campos data e descrição para fazer alterações

                  $sql_upd_dates_preparado = $conexaobd->prepare($sql_upd_dates); //prpearando a variável para fazer alterações

                  $sql_upd_dates_resultado = $sql_upd_dates_preparado->execute();

                  if($sql_upd_dates_resultado == true){
                    $msg          = "Cadastro de data alterado com sucesso."; //Se tudo estiver preenchido, aparece as mensagem de confirmação.
                    $msg_titulo   = "Confirmação";
                    $class_titulo = "sucesso";
                    $voltar       = "?folder=dates&file=ff_fmins_dates";
                  }else { //abre condicional do resultado da execução
                    $msg = "Erro ao alterar cadastro de data.";
                  } //fecha condicional do resultado da execução
                }else{ //abre verificação da existência do usuário
                  $msg = "Essa data já existe.";
                }//fecha verificação da existência do usuário
              }//fecha validação dos campos
          ?>

          <h3  class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
          <p><?php echo $msg ?></p> <!--Exibe o que foi armazenado na váriavel msg.-->
          <a href="<?php echo $voltar; ?>"><img src="../../layout/images/admin/back.png"/>Voltar</a>
        </div>
      </section>
