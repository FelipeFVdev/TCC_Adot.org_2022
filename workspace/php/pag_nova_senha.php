<?php
    require_once './functions.php';
?>

<?php
    if(isset($_GET["codigo"])){
        $sql = 'SELECT * FROM usuario WHERE codigo=? ';
        $statement = mysqli_prepare(Database::getConnection(), $sql);
        mysqli_stmt_bind_param($statement, 's', $_GET["codigo"]);
        mysqli_stmt_execute($statement);
        $resultado = mysqli_stmt_get_result($statement);
        if(empty(mysqli_fetch_array($resultado))) {
            header('location: pag_login.php');
            die();
        }
    }
?>

<?php
    function alterarSenha(){
        $codigo = $_GET["codigo"];
        $senhaNova = password_hash($_POST["txtSenhaNova"], PASSWORD_BCRYPT);
        $sql = "UPDATE usuario SET senha=? WHERE codigo=? ";
        $statement = mysqli_prepare(Database::getConnection(), $sql);
        mysqli_stmt_bind_param($statement, 'ss', $senhaNova, $codigo);
        mysqli_stmt_execute($statement);
        header('location: pag_login.php');
    }
?>

<?php
    if(isset($_GET['enviar'])) alterarSenha();{}
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
        <link rel="stylesheet" href="../css/pag_esqueci_senha.css">
        <link rel="stylesheet" href="../css/styles.css">
        <!-- js -->
        <script lang="javascript" src="../js/pag_alt_senha.js"></script>
        <!-- <script lang="javascript" src="../js/pag_esqueci_senha.js"></script>   -->
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adot.org</title>
    </head>
    <body>
        <?php
            require_once './partials/common.php';
        ?>
        <div class="container rounded p-3" style="background-color: #66C4A9; width: 30%; margin-top:10%;">
            <h3 style="text-align: center;">Nova Senha</h3>
            <form method="post" action="pag_nova_senha.php?enviar=1&codigo=<?php echo $_GET['codigo']?>" id="formAlterarSenha">
                <label class="form-label">Insira uma nova senha </label>
                <input class="form-control form-control-sm mt-1 mb-1" type="password" placeholder="Nova senha" id="txtSenhaNova" name= "txtSenhaNova" required />
                <input class="form-control form-control-sm" type="password" placeholder="Confirme a nova senha" id="txtConfirmeSenha" name="txtConfirmeSenha" required />
                <button type="button" name="confirmaSenha" class="btn mt-3" onclick="validar();"style="background-color: #4C79D5; color: white; width:100%">Enviar</button>
                <input type="hidden" name="codigo" value="<?php $_GET['codigo']?>">
            </form>
        </div>
    </body>
</html>
