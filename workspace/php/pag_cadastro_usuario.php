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
    <link rel="stylesheet" href="../css/pag_cadastro_usuario.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_cadastro_usuario.js"></script>
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

        <div id="formulario">
            <form method="post" action="pag_cadastro_usuario.php?salvar=1" id="formCadastro" style="width: 70%; margin: auto;">

              <div class="form row">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" id="txtNome" name="nome_usuario"/>
                </div>

                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" class="form-control" id="txtEmail" name="email_usuario"/>
                </div>

                <div class="form-group col-md-6">
                    <label>Senha</label>
                    <input type="password" class="form-control" id="txtSenha" name="senha"/>
                </div>

                <div class="form-group col-md-6">
                    <label>Confirme a senha</label>
                    <input type="password" class="form-control" id="txtConfirSenha" name="confirmaSenha"/>
                </div>

                <div class="form-group">
                    <label>Endereço</label>
                    <input type="text" class="form-control" id="txtEndereco" name="endereco_usuario"/>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" class="form-control" id="nrTelefone" name="telefone_usuario"/>
                </div>

                <br/>

                <div class="form-group">
                  <button type="button" class="btn" id="btnCadastrar" name="btnCadastrar" onclick="validar();">Cadastrar</button>
                </div>

              </div>
            </form>

            <?php
              if(isset($_GET["salvar"])) cadastrarUsuario();
            ?>
        </div>
        
    </body>
</html>

<?php
  function cadastrarUsuario(){
    $nome_usuario   = $_POST["nome_usuario"];
    $endereco_usuario = $_POST["endereco_usuario"];
    $telefone_usuario = $_POST["telefone_usuario"];
    $email_usuario  = $_POST["email_usuario"];
    $senha  = $_POST["senha"];
    
    $con    = new mysqli("localhost", "root", "", "tcc");
    $sql    = "insert into usuario(nome_usuario, endereco_usuario, telefone_usuario, email_usuario, senha) values ('$nome_usuario', '$endereco_usuario', '$telefone_usuario', '$email_usuario', '$senha')";
    mysqli_query($con, $sql);
    echo "<script lang='javascript'>window.location.href='pag_login.php';</script>";
    mysqli_close($con);
  }
?>

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pag_login.php';
    }
</script>