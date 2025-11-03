<?php
    require_once './functions.php';
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
        <link rel="stylesheet" href="../css/styles.css">
        <!-- js -->
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
            <h3 style="text-align: center;">Esqueci a Senha</h3>
            <form method="post" action="pag_esqueci_senha.php?enviar=1" id="formEsqueci">
                <label class="form-label">Insira seu e-mail</label>
                <input class="form-control form-control-sm" id="txtEmail" name="txtEmail" type="email" required/>
                <button id="toastbtn" type="submit" name="enviaEmail" class="btn mt-3" style="background-color: #4C79D5; color: white; width:100%">Enviar Email</button>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_GET["enviar"])){
        $email = $_POST["txtEmail"];
        $sql = "SELECT * FROM usuario WHERE email='$email'";
        $query = mysqli_query(Database::getConnection(), $sql);
        if(mysqli_fetch_array($query) > 0){
            $codigo = md5(rand(999999999, 111111111));
            $sql = "UPDATE usuario SET codigo = ? WHERE email = ?";
            $statement = mysqli_prepare(Database::getConnection(), $sql);
            mysqli_stmt_bind_param($statement, 'ss', $codigo, $email);
            $run_query = mysqli_stmt_execute($statement);
            if($run_query){
                $subject  = "Codigo para resetar a senha";
                $message  = "Seu link para resetar a senha é http://localhost/TCC_Adot.org_2022/workspace/php/pag_nova_senha.php?codigo=$codigo";
                if(mail($email, $subject, $message)){
                    echo '<div class="container mt-3 w-50 text-center">';
                        echo '<div class="alert alert-success alert-dismissible fade show">Foi enviado no seu email o link para redefinicao de senha!!!';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                        echo '</div>';
                    echo '</div>';
                }else{
                    echo '<div class="container mt-3 w-50 text-center">';                
                        echo '<div class="alert alert-warning alert-dismissible fade show">Falha ao enviar o codigo!';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="container mt-3 w-50 text-center">';                
                    echo '<div class="alert alert-danger alert-dismissible fade show">Alguma coisa deu errado!!';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                echo '</div>';
            }
        }else{
            echo '<div class="container mt-3 w-50 text-center">';  
                echo '<div class="col align-self-center alert alert-info alert-dismissible fade show">Algo deu errado! Tente Novamente';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                echo '</div>';
            echo '</div>';
        }
    }
?>