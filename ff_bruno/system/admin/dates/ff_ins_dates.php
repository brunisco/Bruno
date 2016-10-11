<h1> Aviso </h1>
<section>
  <div class="mensagem">

    <!-- Armazena os dados dos formulários da página do registro das dadas.-->
    <?php
      $p_data       = $_POST['txtdata'];
      $p_descricao  = $_POST['txadescricao'];

      $msg_titulo   = "Erro!";
      $class_titulo = "erro";
      $img          = "../../layout/images/admin/alert.png";
      //Verificação para ver se os campos estão preenchidos.
      if($p_data==""){ //se a data estiver vazia
        $msg = "Preencha o campo data."; //exibe essa msg
      }else{
          $sql_sel_dates = "SELECT date FROM dates WHERE date='".$p_data."'"; //seleciona o campo date da tabela dates

          $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates);

          $sql_sel_dates_preparado->execute();

          if($sql_sel_dates_preparado->rowCount()==0){
            $sql_ins_dates = "INSERT INTO dates (date, description) VALUES ('".$p_data."', '".$p_descricao."')"; //Insere na tabela dates os valores das variáveis

            $sql_ins_dates_preparado = $conexaobd->prepare($sql_ins_dates); //prepara para executação no SGBD

            $sql_ins_dates_resultado = $sql_ins_dates_preparado->execute();

            if($sql_ins_dates_resultado == true){
              $msg          = "Cadastro de data efetuado com sucesso."; //Se tudo estiver preenchido, aparece as mensagem de confirmação.
              $msg_titulo   = "Confirmação";
              $class_titulo = "sucesso";
            }else{
              $msg = "Erro ao efetuar cadastro de data.";
            }
          }else{
            $msg = "Essa data já existe.";
          }
        }
    ?>

    <h3  class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p> <!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=dates&file=ff_fmins_dates"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
