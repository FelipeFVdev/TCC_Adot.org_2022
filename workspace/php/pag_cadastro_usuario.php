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
        <div class="container">
            <h1 class="text-center">Cadastrar usuário</h1>
            <div id="formulario">
                <form method="post" action="pag_cadastro_usuario.php?salvar=1" id="formCadastro">

                <div class="form" style="width:70%;margin:auto;">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" id="txtNome" placeholder="Digite um nome" name="nome_usuario"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="txtEmail" placeholder="Digite um e-mail" name="email_usuario"/>
                        </div>
                    

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" placeholder="Digite uma senha" id="txtSenha" name="senha"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirme a senha</label>
                            <input type="password" class="form-control" placeholder="Confirme a senha" id="txtConfirSenha" name="confirmaSenha"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-control" placeholder="Digite um endereço com numero" id="txtEndereco" name="endereco_usuario"/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" placeholder="Digite um telefone" id="nrTelefone" name="telefone_usuario"/>
                        </div>
                    </div>

                    <br/>

                    <div class="mb-3">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="button" class="btn btn-success" id="btnCadastrar" name="btnCadastrar" onclick="validar();">Cadastrar</button>
                        </div>
                    </div>

                </div>
                </form>

                <?php
                if(isset($_GET["salvar"])) cadastrarUsuario();
                ?>
            </div>
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