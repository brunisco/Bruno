<h1> Aviso </h1>
<section>
  <div class="mensagem">
    <!-- Armazena o que foi digitado pelo usuário no formulário do registro de data numa variável -->
    <?php
     $p_nome       = $_POST['txtnome'];
     $p_descricao  = $_POST['txadescricao'];
     $p_url        = $_POST['txturl'];

     $msg_titulo   = "Erro!";
     $class_titulo = "erro";
     $img          = "../../layout/images/admin/alert.png";
    //Verificação para conferir se os campos estão preenchidos corretamente.
    if($p_nome==""){
      $msg = "Preencha o campo nome.";
    }else if($p_descricao==""){
        $msg = "Preencha o campo descrição.";
      }else if($p_url==""){
          $msg = "Preencha o campo URL.";
        }else{
            $sql_sel_features = "SELECT name FROM features  WHERE name='".$p_nome."'"; //Seleciona o campo nome da tabela de atrações

            $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features); //prepara a variável para ser executada.

            $sql_sel_features_preparado->execute();

            if($sql_sel_features_preparado->rowCount()==0){

              $sql_ins_features = "INSERT INTO features (name, description, image_url) VALUES ('".$p_nome."', '".$p_descricao."', '".$p_url."')"; //insere em features os valores das variáveis

              $sql_ins_features_preparado = $conexaobd->prepare($sql_ins_features); //prepara para conectar ao banco

              $sql_ins_features_resultado = $sql_ins_features_preparado->execute(); //executa

              if($sql_ins_features_resultado==true){
                $msg          = "Cadastro de atração efetuado com sucesso."; //Se tudo estiver preenchido, aparece as mensagem de confirmação.
                $msg_titulo   = "Confirmação";
                $class_titulo = "sucesso";
              }else{
                $msg = "Erro ao efetuar cadastro da atração.";
              }
            }else{
              $msg = "Essa atração já existe."; //Se a atração já existir, exibe essa mensagem
            }
          }
     ?>

    <!--class erro e sucesso -->
    <h3 class=<?php echo $class_titulo ?> ><img src="<?php echo $img ?>" /><?php echo $msg_titulo ?></h3> <!--Exibe as informações de acordo com o que foi armazenado na variavel.-->
    <p><?php echo $msg ?></p><!--Exibe o que foi armazenado na váriavel msg.-->
    <a href="?folder=features&file=ff_fmins_features"><img src="../../layout/images/admin/back.png"/>Voltar</a>
  </div>
</section>
