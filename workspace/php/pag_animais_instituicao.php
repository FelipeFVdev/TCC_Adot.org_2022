<?php
    require_once './functions.php';
    if(isset($_SESSION["id"])==false){
        header("location: pag_login.php");
        exit();
    }
    $user = getUserLogged();
    if($user["tipo"] == 'USUARIO'){
        header("location: pag_inicial.php");
        exit();
    }
?>

<?php
    function getAnimal($user){
        $id = $user['id'];
        $sql = "SELECT * FROM animal WHERE id_usuario = '$id'";
        $retorno = mysqli_query(Database::getConnection(), $sql);
        $rows = array();
        while($row = mysqli_fetch_array($retorno)) {
            $rows[] = $row;
        }
        return $rows;
        

    }
    $animais = getAnimal($user);
    
    
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
    <link rel="stylesheet" href="../css/pag_animal.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <?php
            require_once './partials/common.php';
        ?>

        <div class="container"> 
            <div class="d-flex flex-wrap align-content-center">
                
            <?php imprimirAnimais($animais)?>

            </div>
        </div>

        <div class="text-center mt-2">
            <a href="pag_instituicao.php">
                <button type="button" class="btn btn-danger btn-lg mt-2" id="btnVoltarInst" name="btnVoltarInst">Voltar</button>
            </a>
        </div>



    </body>
</html>