<?php
    require_once './functions.php';
?>

<?php
    function getInstituicoes() {
        $sql = "SELECT * FROM usuario WHERE tipo = 'INSTITUICAO'";
        $retorno = mysqli_query(Database::getConnection(), $sql);
        $rows = array();
        while($row = mysqli_fetch_array($retorno)) {
            $rows[] = $row;
        }
        return $rows;
    }
    $instituicoes = getInstituicoes()
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
    <!-- <link rel="stylesheet" href="../css/pag.css"> -->
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
        
        <div class="container_main"> 
            <div class="d-flex flex-wrap align-content-center">
                <?php foreach ($instituicoes as $instituicao){
                    $nome_inst = $instituicao['nome'];
                    $endereco_inst = $instituicao['endereco'];

                    echo '<div class="container_exibir p-5">';
                        echo '<div class="row">';
                            echo '<div class="card">';
                                if(empty($instituicao['pathImagem'])){
                                    echo '<img class="img_pag_inicial card-img-top" src="../img/default.png" alt="Card image">';
                                }
                                else{echo '<img class="img_pag_inicial card-img-top pt-3" src="'.$instituicao['pathImagem'].'" alt="Card image">';}
                                echo '<div class="card-body text-center">';
                                    echo '<p class="card-title">Nome: <span class="lead">' .$nome_inst. '</span></p>';
                                    echo '<p class="card-text">Endereço: <span class="lead">' .$endereco_inst. '</span></p>';
                                    echo '<p>';
                                    echo '<div class="text-center"><a class="btn btn-primary stretched-link" href="pag_exibir_instituicao.php?id='.$instituicao['id'].'">Veja Mais</a></div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                }?>

            </div>
        </div>

    </body>
</html>