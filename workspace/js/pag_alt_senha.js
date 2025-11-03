function validar(){
    
    if(txtSenhaNova.value == '' || txtSenhaNova.value.length<8){
        alert("Preencha uma senha alfanumérica com ao menos 8 caracteres!");
        txtSenhaNova.focus();
        txtSenhaNova.value = "";
        return false;
    }
    if(txtSenhaNova.value != txtConfirmeSenha.value){
        alert("Senha e confirmação são diferentes!");
        txtConfirmeSenha.focus();
        txtConfirmeSenha.value = "";
        return false;
    }
    formAlterarSenha.submit();
}