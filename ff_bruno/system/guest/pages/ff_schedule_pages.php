<?php
    /*Com o GROUP BY podemos filtrar os registros pelo id da data, mostrando apenas as datas que possuem atrações relacoionadas*/
    $sql_sel_dates = "SELECT id, date FROM dates INNER JOIN schedules ON dates.id=schedules.dates_id GROUP BY dates.id";

    $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates);

    $sql_sel_dates_preparado->execute();

    while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){ /*Cada data que ele encontrar no banco de dados, e houver uma ou mais atrações relacionadas uma tabela nova é criada*/
    $sql_sel_features = "SELECT schedules.dates_id, features.id, features.name, schedules.features_id, schedules.start_time FROM features INNER JOIN schedules ON features.id=schedules.features_id INNER JOIN dates ON schedules.dates_id=dates.id WHERE schedules.dates_id='".$sql_sel_dates_dados['id']."'";
    /*Filtra todos os dias, atrações, e horário onde o dates_id do schedules for igual ao id da data que está na tabela.*/
    $sql_sel_features_preparado = $conexaobd->prepare($sql_sel_features);

    $sql_sel_features_preparado->execute();
      ?>
    <table class="tabela_programacao">
          <td colspan="2" class="linha_data"><?php echo $sql_sel_dates_dados['date']; ?></td>
        </tr>
        <?php
          while($sql_sel_features_dados=$sql_sel_features_preparado->fetch()){ /*toda vez que ele realizar a pesquisa no bd e encontrar alguma atração, uma nova linha é criada com sua respectiva data e tabela*/
        ?>
        <tr>
          <td class="linha_atracao"><?php echo $sql_sel_features_dados['name']; ?></td>
          <td class="celula_horario"><?php echo $sql_sel_features_dados['start_time']; ?></td>
        </tr>
        <?php
      }
        ?>
    </table>
<?php
}
      ?>
<br style="clear:both;"/>
