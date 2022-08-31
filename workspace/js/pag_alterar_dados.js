function validaEmail(field) {
    usuario = field.value.substring(0, field.value.indexOf("@"));
    dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

    if ((usuario.length >=1) &&
        (dominio.length >=3) &&
        (usuario.search("@")==-1) &&
        (dominio.search("@")==-1) &&
        (usuario.search(" ")==-1) &&
        (dominio.search(" ")==-1) &&
        (dominio.search(".")!=-1) &&
        (dominio.indexOf(".") >=1)&&
        (dominio.lastIndexOf(".") < dominio.length - 1)) {
        return true;
    }
    else{
        return false;
    }
}

function alterarInfoCadastro(){
    if(txtNome.value == '' || txtNome.value.length < 3){
        alert("Preencha com seu nome!");
        txtNome.value = '';
        txtNome.focus();
        return false;
    }
    if(txtEmail.value ==  '' 
    || txtEmail.value.length<6 
    || txtEmail.value.indexOf("@")<=0
    || txtEmail.value.lastIndexOf(".") <= txtEmail.value.indexOf("@")){
        alert("Informe um e-mail válido!");
        txtEmail.focus();
        txtEmail.value = "";
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
    formAlterarInfo.submit();
}