/*
Autor: Bruno Luis da Silva
Data de criação: 29/09/2016
Data de modificação: 29/09/2016
Desccrição: As funções abaixo visa validar todos os formulários de INSERÇÃO da área administrativa
*/

function validaData(){ /*função que visa validar os campos no formulário de inserção no registro de datas*/
  if(document.frmcaddata.txtdata.value==""){
    alert("Preencha o campo data.");
    document.frmcaddata.txtdata.focus();
  }else{
      return true;
  }
  return false;
}

function validaAtracao(){ /*função que visa validar os campos do formulário de inserção no registro de atrações*/
  if(document.frmcadatracao.txtnome.value==""){
    alert("Preencha o campo nome.");
    document.frmcadatracao.txtnome.focus();
  }else if(document.frmcadatracao.txadescricao.value==""){
      alert("Preencha o campo Descrição.");
      document.frmcadatracao.txadescricao.focus();
      }else if(document.frmcadatracao.txturl.value==""){
          alert("Preencha o campo URL.");
          document.frmcadatracao.txturl.focus();
      }else{
          return true;
      }
      return false;
  }

function validaIngressosDisponivel(){ /*função que visa validar os campos do formulário de inserção no registro de ingressos disponíveis*/
  if(document.frmcadingressos.seldata.value==""){
    alert("Selecione uma opção no campo Data do evento.");
    document.frmcadingressos.seldata.focus();
  }else if(document.frmcadingressos.txtingnormais.value==""){
      alert("Preencha o campo Qtde. de ingressos normais.");
      document.frmcadingressos.txtingnormais.focus();
    }else if(document.frmcadingressos.txtprecoingnormais.value==""){
        alert("Preencha o campo Preço dos ingressos normais.");
        document.frmcadingressos.txtprecoingnormais.focus();
      }else if(document.frmcadingressos.txtqtdeingvip.value==""){
          alert("Preencha o campo Qtde. de ingressos vips.");
          document.frmcadingressos.txtqtdeingvip.focus();
        }else if(document.frmcadingressos.txtprecoingvip.value==""){
            alert("Preencha o campo Preço dos ingressos vips");
            document.frmcadingressos.txtprecoingvip.focus();
        }else{
          return true;
        }
        return false;
}

function validaProgramacao(){ /*função que visa validar os campos do formulário de inserção no registro progrmação*/
  if(document.frmcadprogramacao.seldata.value==""){
    alert("Selecione uma das opções no campo Data do evento.");
    document.frmcadprogramacao.seldata.focus();
  }else if(document.frmcadprogramacao.selatracao.value==""){
      alert("Seleciona uma das opções no campo Atração.");
      document.frmcadprogramacao.selatracao.focus();
    }else if(document.frmcadprogramacao.txthorario.value==""){
        alert("Preencha o campo Horário do evnto.");
        document.frmcadprogramacao.txthorario.focus();
    }else{
      return true;
    }
    return false;
}

function validadeAdmin(){ /*função que visa validar os campos do formulário de inserção no registro de administrador*/
  if(document.frmcadusuario.txtusuario.value==""){
    alert("Preencha o campo Usuário.");
    document.frmcadusuario.txtusuario.focus();
  }else if(document.frmcadusuario.pwdadmin.value==""){
      alert("Preencha o campo Senha.");
      document.frmcadusuario.pwdadmin.focus();
  }else{
    return true;
  }
  return false;
}
