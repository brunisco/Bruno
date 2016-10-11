<h2>Alteração de Informações Pessoais</h2>
<fieldset>
  <?php
    /*faz a seleção de todos os campos no bd da tabela de clientes onde o id do usuário tem que ser igual ao id da sessão*/
    $sql_sel_clients           = "SELECT * FROM clients WHERE users_id='".$_SESSION['idUsuario']."'";

    $sql_sel_clients_preparado = $conexaobd->prepare($sql_sel_clients); /*prepara a conexão com o bd*/

    $sql_sel_clients_preparado->execute(); /*executa no bd*/
    /*o fetch vai pegar os dados recebidos do select, e vai armazenar na variável dados*/
    $sql_sel_clients_dados     = $sql_sel_clients_preparado->fetch();

   ?>

		<table>
  <!--envia o formulário para a ff_updpersonal para atualizar as informações pessoais do cliente-->
	<form name="frmupdpersonal_profile" method="post" action="?folder=profile&file=ff_updpersonal_profile">
      <tr>
        <td>Nome:</td>
        <td><input type="txt" name="txtnome" value="<?php echo $sql_sel_clients_dados['name']; /*exibe a posição do array "nome" que foi armazenado n oarray*/?>" maxlength="45"></td>
      </tr>
      <tr>
        <td>Data de Nascimento:</td>
        <td><input type="text" name="txtnasc" value="<?php echo $sql_sel_clients_dados['birthdate']; /*exibe a posição do array "birthdate" que foi armazenado no array*/?>" maxlength="11"></td>
      </tr>
      <tr>
        <td>E-mail:</td>
        <td><input type="text" name="txtemail" value="<?php echo $sql_sel_clients_dados['email']; /*exibe a posição no array "email" qie foi armazenado no array*/?>" maxlength="70"></td>
      </tr>
      <tr>
        <td>Telefone:</td>
        <td><input type="text" name="txttelefone" value="<?php echo $sql_sel_clients_dados['phone'];/*exibe a posição no array "phone" que foi armazenado no array*/ ?>" maxlength="15"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><a href="?folder=profile&file=ff_view_profile"><button name="btnretornar" type="button">Retornar</button></a><button type="submit">Salvar</button></td>
		</table>
	</form>
</fieldset>
