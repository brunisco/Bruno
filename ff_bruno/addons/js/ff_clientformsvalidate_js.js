/*
Autor: Bruno Luis da Silva
Data de criação: 29/09/2016
Data de modificação: 29/09/2016
Descrição: Validação JavaScript da área restrita de clientes
*/

function validaReserva(){ /*função que visa validar os campos do formulário de visualização de reservas de ingressos*/
  if(document.frmreserva.seldata.value==""){
    alert("Selecione uma opção no campo Data.");
    document.frmreserva.seldata.focus();
  }else if(document.frmreserva.txtqtdeingnormais.value==""){
      alert("Preencha o campo Quantide de ingressos normais.");
      document.frmreserva.txtqtdeingnormais.focus();
    }else if(document.frmreserva.txtqtdeingvips.value==""){
        alert("Preencha o campo Quantidade de ingressos VIPs.");
        document.frmreserva.txtqtdeingvips.focus();
    }else{
          return true;
    }
    return false;
}
