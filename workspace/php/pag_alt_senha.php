<?php
    require_once './functions.php';
    if(isset($_SESSION["id"])==false){
        header("location: pag_login.php");
        exit();
    }
    $user = getUserLogged();

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
    <link rel="stylesheet" href="../css/pag_alt_senha.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_alt_senha.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <?php
            require_once './partials/common.php';
        ?>

        <div class="container rounded mt-5 p-3" style="background-color: #66C4A9; width: 60%;">
            <h1 class="text-center">Alterar Senha</h1>
            <div id="formulario">
                <form method="post" action="pag_alt_senha.php?alterarSenha=1" id="formAlterarSenha">
                    <div class="form" style="width:70%;margin:auto;">
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Senha Antiga</label>
                                <input type="password" class="form-control form-control-sm" placeholder="Digite sua senha antiga" id="txtSenhaAntiga" name="txtSenhaAntiga"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" class="form-control form-control-sm" placeholder="Digite uma senha" id="txtSenhaNova" name="txtSenhaNova"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirme a nova senha</label>
                                <input type="password" class="form-control form-control-sm" placeholder="Confirme a senha" id="txtConfirmeSenha" name="txtConfirmeSenha"/>
                            </div>
                        <br/>
                            <div class="mt-3">
                                <div class="d-grid gap-2 col-6 mx-auto rounded" style="background-color: #4C79D5;">
                                    <button type="button" class="btn text-white" id="btnAlterar" name="btnAlterar" onclick="validar();">Alterar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </body>
</html>

<?php

    if(isset($_GET['alterarSenha'])){
        $senhaAntiga = $_POST['txtSenhaAntiga'];
        $id = $user['id'];
        $email = $user['email'];
        $senhaNova = password_hash($_POST["txtSenhaNova"], PASSWORD_BCRYPT);
        $confirmaSenhaNova = $_POST['txtConfirmeSenha'];
        $con = new mysqli("localhost", "root", "", "tcc");
        $sql1 = "select * from usuario where email='$email'";
        $query = mysqli_query($con, $sql1);
        if($reg = mysqli_fetch_array($query)){
            if(password_verify($senhaAntiga, $reg['senha'])){
                $sql = "UPDATE usuario SET senha='$senhaNova' WHERE id='$id'";
                $resultado = mysqli_query($con, $sql);
                echo "<script lang='javascript'>alert('Senha Alterada com sucesso');</script>";
                echo "<script lang='javascript'>window.location.href='sair.php';</script>";
            }
            else{
                echo "<script lang='javascript'>alert('Senha Antiga Invalida');</script>";
            }
        } else{

        }
        mysqli_close($con);
    }

?>


<script lang='javascript'>
    function voltar(){
        window.location.href='pag_usuario.php';
    }
</script>