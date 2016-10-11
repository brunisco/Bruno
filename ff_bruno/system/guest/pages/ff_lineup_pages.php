<?php
  $sql_sel_features                = "SELECT * FROM features";

  $sql_sel_features_preparado      = $conexaobd->prepare($sql_sel_features);

  $sql_sel_features_preparado->execute();

  while($sql_sel_features_dados=$sql_sel_features_preparado->fetch()){
    ?>
    <h3 class="titulo_atracao"><?php echo $sql_sel_features_dados['name']; ?></h3>
    <p class="paragrafo_atracao"><?php echo $sql_sel_features_dados['description']; ?></p>
    <img src="<?php echo $sql_sel_features_dados['image_url']; ?>" class="imgs_atracao"/>
    <h3 class="titulo_atracao"></h3>
    <?php
}
?>
