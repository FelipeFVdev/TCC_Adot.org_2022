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
    <script lang="javascript" src="../js/redirecionaLogin.js"></script>    
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <!-- ========== TUDO QUE TEM "#" PRECISA COLOCAR UM LINK E MUDAR O PHP ========== -->
        <div class="header">            
            <nav class="navbar navbar-light m-3" style="background-color: #1a6f3a;">                
                <div class="container-fluid" id="header_conteainer">
                    <a href="#"><img src="img/" id="logo" /></a>
                    <div class="headerTitle"><h2>Adot.org</h2></div>

                        <!-- Barra de Consultas -->
                        <div class="menu">
                            <nav class="navbar navbar-expand-lg navbar-dark m-3" style="background-color: #98112e;">
                                <div class="container-fluid text-xs-center">
                                    <!-- <a class="navbar-brand" href="#">Menu</a> -->
                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
                                        aria-expanded="false" aria-label="Toggle navigation">

                                        <span class="navbar-toggler-icon"></span>
                                        </button>

                                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                        <div class="navbar-nav" id="itensMenu">
                                            <a class="nav-link active" aria-current="page" href="pag_inicial">Página Inicial</a>

                                            <a class="nav-link active" aria-current="page" href="pag_instituicao" name="#">Página Instituições</a>

                                            <a class="nav-link active" aria-current="page" href="#">Página Animais</a>

                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <?php
                            if(isset($_SESSION["nome_usuario"])==false){
                                echo "<button type='button' class='btn' id='btnFazerLogin' style='background-color: #fecc68; color: white;' onclick='redirecionaLogin();'>Logar</button>";
                            }else{                        
                                $nome_usuario = $_SESSION["nome_usuario"];
                                echo "<div class='dropdown'>";
                                echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false' style='background-color: #fecc68;'>Olá, $nome_usuario</button>";
                                echo  "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                                echo "<li><a class='dropdown-item' href='pag_usuario.php'>Meus dados</a></li>";
                                echo "<li><a class='dropdown-item' href='sair.php'>Sair</a></li>";
                                echo "</ul></div>";
                            }
                        ?>
                </div>                
            </nav>          
        </div>

        <div class="container row" id="jaCadastroDiv">
          <p class="display-6" id="jaCadastro">Já tenho cadastro</p>
            <form method="post" action="pag_login.php?logar=1" class="needs-validation" id="formLogin">
                <div class="form-group" id="divEmail">
                    <label for=txtEmailLogin>E-mail</label>
                    <input type="email" class="form-control" id="txtEmailLogin" name="email_usuario" required />
                </div>

                <div class="form-group" id="divSenha">
                    <label for="txtSenhaLogin">Senha</label>
                    <input type="password" class="form-control" id="txtSenhaLogin" name="senha" required />
                </div>

                <div class="form-group" id="divBotaoLogar">
                    <button type="button" class="btn" id="btnLogar" onclick="validaLogin();">Logar</button>
                </div>

                <div class="form-group" id="divBotaoLogar">
                    <button type="button" class="btn" id="btnLogar" onclick="validaLogin();">Logar Instituição</button>
                </div>
            </form>

            <?php
              if(isset($_GET["logar"])) logarUsuario();
            ?>

            <a href="Pag_Esq_Senha.html" id="esqueciSenha">Esqueci a senha</a>
        </div>

        <div class="container row" id="cadastro">
            <a href="pag_cadastro_instituicao.php">
                <button type="button" class="btn" id="btnCadInst" onclick="">Cadastrar Instituição</button>
            </a>

            <a href="pag_cadastro_usuario.php">
                <button type="button" class="btn" id="btnCadUsu" onclick="">Cadastrar Usuário</button>
            </a>
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

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pag_login.php';
    }
</script>