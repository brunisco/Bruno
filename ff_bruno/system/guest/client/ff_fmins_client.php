<form name="frmcadcliente" method="POST" action="ff_ins_client.php" onsubmit="return validaCadastro()">
  <table class="tabela_cadastro">
    <tr>
      <td>Nome Completo</td>
    </tr>
    <tr>
      <td><input type="text" name="txtnome" maxlength="45" size="50" value=""> </td>
    </tr>
    <tr>
      <td>Data de Nascimento</td>
    </tr>
    <tr>
      <td><input type="text" name="txtnasc" maxlength="11" size="50" placeholder="Ex: 00/00/0000"> </td>
    </tr>
    <tr>
      <td>E-mail</td>
    </tr>
    <tr>
      <td><input type="text" name="txtemail" maxlength="70" size="50" value=""></td>
    </tr>
    <tr>
      <td>Telefone</td>
    </tr>
    <tr>
      <td><input type="text" name="txttel" maxlength="15" size="50" placeholder="Digite apenas números."> </td>
    </tr>
    <tr>
      <td>Usuário</td>
    </tr>
    <tr>
      <td><input type="text" name="txtusuario" maxlength="20" size="50" value=""> </td>
    </tr>
    <tr>
      <td>Senha</td>
    </tr>
    <tr>
      <td><input type="password" name="pwdcadastro" maxlength="32" size="50" value=""> </td>
    </tr>
      <td><button class="botoes_form" type="submit">Enviar Dados</button><button type="reset" class="botoes_form">Limpar Campos</button></td>
    </tr>
  </table>
</form>
