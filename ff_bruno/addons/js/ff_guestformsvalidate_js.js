/*
Autor: Bruno Luis da Silva
Data de criação: 10/06/2016
Data de modificação: 29/09/2016
Descrição: Validação da área de visitantes do site
*/

// A função abaixo valida o cadastro cliente.

function validaCadastro(){
    if(document.frmcadcliente.txtnome.value==""){
      alert("Preencha o campo nome.");
      document.frmcadcliente.txtnome.focus();
    }else if(document.frmcadcliente.txtnasc.value==""){
        alert("Preencha o campo data de nascimento.")
        document.frmcadcliente.txtnasc.focus();
      }else if(document.frmcadcliente.txtemail.value==""){
          alert("Preencha o campo e-mail.");
          document.frmcadcliente.txtemail.focus();
        }else if(document.frmcadcliente.txttel.value==""){
            alert("Preencha o campo telefone.");
            document.frmcadcliente.txttel.focus();
          }else if(document.frmcadcliente.txtusuario.value==""){
              alert("Preencha o campo usuário.");
              document.frmcadcliente.txtusuario.focus();
            }else if(document.frmcadcliente.pwdcadastro.value==""){
                alert("Preencha o campo senha.");
                document.frmcadcliente.pwdcadastro.focus();
            }else{
                return true;
            }
            return false;
}

//A função abaixo valida os campos do login.
function validaLogin(){
  if(document.frmlogin.txtlogin.value==""){
    alert("Informe seu login.");
    document.frmlogin.txtlogin.focus();
  }else if(document.frmlogin.pwdlogin.value==""){
      alert("Informe sua senha.");
      document.frmlogin.pwdlogin.focus();
    }else{
        return true;
    }
    return false;
}
