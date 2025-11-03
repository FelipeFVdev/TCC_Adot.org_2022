function validarComentario(){
    if(nomeComentario.value == '' || nomeComentario.value.length < 2){
      alert("Preencha com seu nome!");
      nomeComentario.value = '';
      nomeComentario.focus();
      return false;
    }
    if(!validarEmail(emailComentario.value)){
      alert("Informe um e-mail válido!");
      emailComentario.focus();
      emailComentario.value = "";
      return false;
    }
    if(comentario.value == ''){
      alert("Isto não pode estar vazio, preencha com uma frase!");
      comentario.focus();
      comentario.value = "";
      return false;
    }
    formComentario.submit();
  }