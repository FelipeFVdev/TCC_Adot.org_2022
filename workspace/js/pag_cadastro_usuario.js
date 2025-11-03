function validar(){
  if(txtNome.value == '' || txtNome.value.length < 3){
    alert("Preencha com seu nome!");
    txtNome.value = '';
    txtNome.focus();
    return false;
  }
  if(!validarEmail(txtEmail.value)){
    alert("Informe um e-mail válido!");
    txtEmail.focus();
    txtEmail.value = "";
    return false;
  }
  if(txtSenha.value == '' || txtSenha.value.length<8 ){
    alert("Preencha uma senha com ao menos 8 caracteres!");
    txtSenha.focus();
    txtSenha.value = "";
    return false;
  }
  if(txtSenha.value != txtConfirSenha.value){
    alert("Senha e confirmação são diferentes!");
    txtConfirSenha.focus();
    txtConfirSenha.value = "";
    return false;
  }
  if(txtEndereco == '' || txtEndereco.value.length<5){
    alert("Preencha com seu endereço!");
    txtEndereco.focus();
    txtEndereco.value = "";
    return false;
  }
  if(nrTelefone.value == ''
  || nrTelefone.value.length < 11){
    alert("Preencha com um número de celular válido!");
    nrTelefone.focus();
    nrTelefone.value = "";
    return false;
  }
  formCadastroUsuario.submit();
}