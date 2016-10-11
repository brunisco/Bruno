<h1>Registro de Datas</h1>
<section>
  <fieldset>
		<legend>Cadastrar Datas</legend>
		<form name="frmcaddata" method="post" action="?folder=dates&file=ff_ins_dates" onsubmit="return validaData()">
			<table>
				<tr>
					<td>Data:</td>
					<td><input type="text" name="txtdata" placeholder="aaaa-mm-dd" maxlength="10"></td>
				</tr>
				<tr>
					<td>Descrição:</td>
					<td><textarea name="txadescricao"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button type="reset">Limpar</button><button type="submit">Salvar</button></td>
				</tr>
			</table>
		</form>
	</fieldset>
	<h2>Datas Registradas</h2>
	<table class="registrados">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="20%">Data</th>
				<th width="50%">Descrição</th>
				<th width="10%">Editar</th>
				<th width="10%">Excluir</th>
			</tr>
		</thead>
		<tbody>
      <?php
        $sql_sel_dates           = "SELECT * FROM dates"; //Seleciona tudo que tem armazenado no banco da tabela dates

        $sql_sel_dates_preparado = $conexaobd->prepare($sql_sel_dates); //prepara a variável para ser executado no SGBD

        $sql_sel_dates_preparado->execute(); //Executa a variável já preparada

        if($sql_sel_dates_preparado->rowCount()>0){ //Se a contagem de linhas for > 0 ele usará o fetch
          while($sql_sel_dates_dados=$sql_sel_dates_preparado->fetch()){
       ?>
  					<tr>
  						<td><?php echo $sql_sel_dates_dados['id']; ?></td> <!-- Mostra  todos os ids registrados-->
              <td><?php echo $sql_sel_dates_dados['date']; ?></td> <!-- Mostra todas as datas registradas -->
              <?php //abre php da condição
            if($sql_sel_dates_dados['description']==""){ //Estrutura condicional para verificar se o campo description está vazio
              ?> <!--fecha php da condição para poder exibir a mensagem-->
              <td>Não há descrição para este registro.</td> <!--Se entrar na estrutura, é exibido essa mensagem para o usuário saber que não tem registro disponível.-->
              <?php //abre php para continuar a estrutura condicional
            }else{ //se não, mostra o que tem no banco
              ?> <!--fecha php para mostrar o que tem no BD-->
              <td><?php echo $sql_sel_dates_dados['description']; ?></td> <!-- Mostra todas as descrições registradas no BD-->
                <?php
              } //fecha else da estrutura condicional para verificar se o campo descrição está vazio.
                ?>
  						<td align="center"><a href="?folder=dates&file=ff_fmupd_dates&id=<?php echo $sql_sel_dates_dados['id']; ?>" title="Editar registro"><img src="../../layout/images/admin/edit.png"></a></td> <!--Manda o id para a ff_fmupd-->
  						<td align="center"><a href="?folder=dates&file=ff_del_dates&id=<?php echo $sql_sel_dates_dados['id']; ?>" title="Excluir registro"><img src="../../layout/images/admin/delete.png"></a></td> <!--Manda o id para a ff_del-->
  					</tr>
      <?php
    }
    }else{
      ?>
      <tr>
        <td align="center" colspan="5">Não há registros.</td>
      </tr>
      <?php
    }
      ?>
		</tbody>
	</table>
</section>
