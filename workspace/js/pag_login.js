function validaLogin(){
    if(!validarEmail(txtEmailLogin.value)){
    alert("Informe um e-mail válido!");
    txtEmailLogin.focus();
    txtEmailLogin.value = "";
    return false;
  }
  if(txtSenhaLogin.value == '' || txtSenhaLogin.value.length<8){
    alert("Preencha uma senha alfanumérica com ao menos 8 caracteres!");
    txtSenhaLogin.focus();
    txtSenhaLogin.value = "";
    return false;
  }
  formLogin.submit();
}