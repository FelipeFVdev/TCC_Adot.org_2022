function validar(){
if(txtNome.value == '' || txtNome.value.length < 3){
    alert("Preencha com seu nome!");
    txtNome.value = '';
    txtNome.focus();
    return false;
}

formCadastro.submit();
}