function alterarInfoAnimal(){
    if(txtNomeAnimal.value == '' || txtNomeAnimal.value.length < 2){
        alert("Preencha com seu nome!");
        txtNomeAnimal.value = '';
        txtNomeAnimal.focus();
        return false;
    }
    if(txtTipoAnimal == '' || txtTipoAnimal.value.length<3){
        alert("Escreva o tipo do animal!");
        txtEndereco.focus();
        txtEndereco.value = "";
        return false;
    }
    if(txtIdade == ''){
        alert("Preencha com idade valido");
        txtIdade.focus();
        txtIdade.value = "";
        return false;
    }
    if(txtSexo.value == ''){
        alert("Preencha com o sexo do animal");
        txtSexo.focus();
        txtSexo.value = "";
        return false;
    }
    if(txtRaca == ''){
        alert("Preencha com uma raca");
        txtRaca.focus();
        txtRaca.value = "";
        return false;
    }
    if(txtDescricao == ''){
        alert("Preencha com uma descricao");
        txtRaca.focus();
        txtRaca.value = "";
        return false;
    }
    formAlterarInfoAnimal.submit();
}