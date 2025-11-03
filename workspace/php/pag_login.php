<?php
    require_once './functions.php';
?>

<?php
  function logarUsuario(){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $sql = "SELECT * FROM usuario WHERE email='$email'";

    $retorno = mysqli_query(Database::getConnection(), $sql);
    if($reg = mysqli_fetch_array($retorno)){
      if(password_verify($senha, $reg['senha'])){
        $_SESSION["id"] = $reg["id"];
        $id = session_id();
        header("location: pag_inicial.php");
      }
      else{
        echo "<br> <center> <h3 style='margin-top:20px;'>E-mail ou senha inválidos!</h3></center>";
      }
      
    } else {
      echo "<br> <center> <h3 style='margin-top:20px;'>E-mail ou senha inválidos!</h3></center>";
    }    
  }
?>

<?php
  if(isset($_GET["logar"])) logarUsuario();
?>
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

        <?php
            require_once './partials/common.php';
        ?>
        
        <div class="container_main">
          <div class="row justify-content-around">

            <!-- CONTAINER LOGIN -->
            <div class="card container_login col-4 rounded" id="jaCadastroDiv">
              <p class="display-6 lead" id="jaCadastro">Login</p>
                <form method="post" action="pag_login.php?logar=1" class="needs-validation" id="formLogin">
                  
                    <div class="mb-3" id="divEmail">
                      <label class="form-label" for='txtEmailLogin' >E-mail</label>
                      <input type="email" class="form-control form-control-sm" id="txtEmailLogin" name="email" required />
                    </div>

                    <div class="mb-3" id="divSenha">
                      <label class="form-label" for="txtSenhaLogin">Senha</label>
                      <input type="password" class="form-control form-control-sm" id="txtSenhaLogin" name="senha" required />
                    </div>

                    <div class="d-grid gap-2 col-4 mx-auto" id="divBotaoLogar">
                      <button type="button" class="btn  mt-3 btn-primary" id="btnLogar" onclick="validaLogin();">Logar</button>
                    </div>

                </form>

                <div class="d-grid gap-2 col-4 mt-4 mx-auto">
                    <a href="pag_esqueci_senha.php" id="esqueciSenha" class="btn btn-link btn-danger" style="color: white;" >Esqueci a senha</a>
                </div>
            </div>

            <!-- CONTAINER CADASTRO -->
            <div class="card container_cadastro col-4" id="cadastro">
              <p class="display-6 lead" id="jaCadastro">Cadastro</p>
                <div class="d-grid gap-2">
                    <a href="pag_cadastro_instituicao.php" class="btn btn-primary" id="btnCadInst">Cadastrar Instituição</a>
                    <a href="pag_cadastro_usuario.php" class="btn btn-primary" id="btnCadUsu">Cadastrar Usuário</a>
                </div>
            </div>            
          </div>
        </div>
    </body>
</html>