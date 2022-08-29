function validaLogin(){
    if(txtEmailLogin.value ==  '' 
    || txtEmailLogin.value.length<6 
    || txtEmailLogin.value.indexOf("@")<=0
    || txtEmailLogin.value.lastIndexOf(".") <= txtEmailLogin.value.indexOf("@")){
    alert("Informe um e-mail válido!");
    txtEmailLogin.focus();
    txtEmailLogin.value = "";
    return false;
  }
  if(txtSenhaLogin.value == '' || txtSenhaLogin.value.length<8 || isNaN(txtSenhaLogin.value)){
    alert("Preencha uma senha alfanumérica com ao menos 8 caracteres!");
    txtSenhaLogin.focus();
    txtSenhaLogin.value = "";
    return false;
  }
  formLogin.submit();
}