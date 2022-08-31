<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- icons font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/pag_login.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_login.js"></script>  
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <!-- ========== TUDO QUE TEM "#" PRECISA COLOCAR UM LINK E MUDAR O PHP ========== -->
        <?php
            require_once './partials/common.php';
        ?>

        <div class="container row" id="jaCadastroDiv">
          <p class="display-6" id="jaCadastro">Já tenho cadastro</p>
            <form method="post" action="pag_login.php?logar=1" class="needs-validation" id="formLogin">
                <div class="mb-3" id="divEmail">
                    <label class="form-label" for=txtEmailLogin>E-mail</label>
                    <input type="email" class="form-control" id="txtEmailLogin" name="email_usuario" required />
                </div>

                <div class="mb-3" id="divSenha">
                    <label class="form-label" for="txtSenhaLogin">Senha</label>
                    <input type="password" class="form-control" id="txtSenhaLogin" name="senha" required />
                </div>
                <div class="d-grid gap-2 col-4 mx-auto" id="divBotaoLogar">
                    <button type="button" class="btn btn-success mt-3" id="btnLogar" onclick="validaLogin();">Logar</button>
                    <button type="button" class="btn btn-success mt-1 mb-2" id="btnLogar" onclick="validaLogin();">Logar Instituição</button>
                </div>
            </form>

            <?php
              if(isset($_GET["logar"])) logarUsuario();
            ?>
            <div class="d-grid gap-2 col-4 mx-auto">
                <a href="Pag_Esq_Senha.html" id="esqueciSenha" class="btn btn-link">Esqueci a senha</a>
            </div>
        </div>

        <div class="container row" id="cadastro">
            <div class="d-grid gap-2">
                <a href="pag_cadastro_instituicao.php" class="btn btn-primary btn-lg" id="btnCadInst">Cadastrar Instituição</a>
                <a href="pag_cadastro_usuario.php" class="btn btn-primary btn-lg" id="btnCadUsu">Cadastrar Usuário</a>
            </div>
        </div>
        

    </body>
</html>

<?php
  function logarUsuario(){
    $email_usuario = $_POST["email_usuario"];
    $senha = $_POST["senha"];
    $con = new mysqli("localhost", "root", "", "tcc");
    $sql = "select * from usuario where email_usuario='$email_usuario' and senha='$senha'";
    $retorno = mysqli_query($con, $sql);
    if($reg = mysqli_fetch_array($retorno)){
      $_SESSION["id"] = $reg["id"];
      $_SESSION["nome_usuario"] = $reg["nome_usuario"];
      $_SESSION["endereco_usuario"] = $reg["endereco_usuario"];
      $_SESSION["telefone_usuario"] = $reg["telefone_usuario"];
      $_SESSION["email_usuario"] = $reg["email_usuario"];
      $id = session_id();
      echo "<script lang='javascript'>window.location.href='pag_inicial.php?';</script>";
    } else {
      echo "<h3>E-mail ou senha inválidos!</h3>";
    }
    mysqli_close($con);    
  }
?>