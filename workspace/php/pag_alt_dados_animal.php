<?php
    require_once './functions.php';

    $animal = buscaAnimalPorId($_GET['id']);

    if(!UsuarioLogadoEhDonoDoAnimal($animal)){
        header("location: pag_animal.php?id=".$animal['id']);
        exit();
    }
    $user = getUserLogged();
    if($user["tipo"] == 'USUARIO'){
        header("location: pag_inicial.php");
        exit();
    }
?>

<?php
    if(isset($_GET["alterar"])){
        $id = $_GET['alterar'];
        $nome = $_POST["nomeAnimal"];
        $tipo   = $_POST["tipoAnimal"];
        $idade  = $_POST["idade"];
        $sexo = $_POST["sexo"];
        $raca = $_POST["raca"];
        $descricao = $_POST["descricao"];
        $sql  = "UPDATE animal SET tipo_animal=? , nome_animal=?, idade= ?, sexo=? ,raca=? ,descricao=? WHERE id=?";
        $statement = mysqli_prepare(Database::getConnection(), $sql);
        mysqli_stmt_bind_param($statement, 'sssssss', $tipo, $nome, $idade, $sexo, $raca, $descricao, $id);
        mysqli_stmt_execute($statement);
        header("location: pag_animal.php?id=$id");

    }
?>

<?php
    if(isset($_GET["deletar"])) {
        if(UsuarioLogadoEhDonoDoAnimal($animal)){
            excluirAnimal($animal['id']);
            echo "<script lang='javascript'>window.location.href='pag_animais_instituicao.php';</script>";
        }
    }
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
    <link rel="stylesheet" href="../css/pag_cadastro_animal.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_alterar_dados_animal.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
    
</head>
    <body>
        <?php
             require_once './partials/common.php';
        ?>

        <div class="container animal_container">
            <div class="card">
                <div class="card-body">
                    <div class="row rounded py-2">

                        <div class="col-6">
                            <div class="img_animal_alt text-center">
                                <img class="img_pag_alt_animal" src="<?php echo $animal['pathImagem_animal']?>">
                            </div>

                            <div class="animal_alt_buttons">
                                <form class="ms-4 mt-4" action="" method="POST" enctype="multipart/form-data">
                                    <p><label>Selecione o arquivo:</label></p>
                                    <input name="arquivo" class="form-control" type="file">

                                    <button class="btn btn-block btn-success mt-3" name="upload" type="submit"> Enviar arquivo</button>

                                </form>
                            </div>
                        </div>

                        <div class="col-6"> 
                            <div class="animal_info">
                                <form method="post" action="pag_alt_dados_animal.php?id=<?php echo $animal["id"]?>&alterar=<?php echo $animal["id"];?>" id="formAlterarInfoAnimal" >
                                    <div class="form row">

                                        <div class="form-group">
                                            <label>Tipo do Animal</label> 
                                            <input  type="text" class="form-control" id="txtTipoAnimal" name="tipoAnimal"  value="<?php echo $animal["tipo_animal"];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="email" class="form-control" id="txtNomeAnimal" name="nomeAnimal"  value="<?php echo $animal["nome_animal"];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Idade</label>
                                            <input type="text" class="form-control" id="txtIdade" name="idade"  value="<?php echo $animal["idade"];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <input type="text" class="form-control" id="txtSexo" name="sexo"  value="<?php echo $animal["sexo"];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Raça</label>
                                            <input type="text" class="form-control" id="txtRaca" name="raca"  value="<?php echo $animal["raca"];?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <textarea type="text" class="form-control" id="txtDescricao" name="descricao"><?php echo $animal["descricao"];?></textarea>
                                        </div>

                                        <div class="form-group mt-2">
                                            <button type="button" class="btn btn-success mt-3" id="btnAltAnimal" name="btnAltAnimal" onclick="alterarInfoAnimal();">Salvar alteracoes</button>
                                            <button type="button" class="btn btn-danger mt-3" id="btnCancelarCadastro" name="btnCancelarCadastro" onclick="voltar()">Cancelar</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>            
        </div>

    </body>
</html>


<script lang='javascript'>
    function voltar(){
        window.location.href='pag_animal.php?id=<?php echo $animal['id']?>';
    }
</script>

<?php 

    if (isset($_FILES["arquivo"])) {
        $arquivo = $_FILES['arquivo'];
        // Validar se o arquivo não esta vazio
        if (!empty($arquivo["name"])) {
            $nomeDoArquivo = $arquivo["name"];
    
            $arquivoValido = true;
    
            // validar extensao do arquivo
            $tipoDoArquivo = array(
                'jpg',
                'jpeg',
                'png'
            );
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();
            $pasta = '../img/';
            $extensaoDoArquivo = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
            if (! in_array($extensaoDoArquivo, $tipoDoArquivo)) {

                echo '<div class="container mt-3 w-50 text-center">';                
                    echo '<div class="alert alert-danger alert-dismissible fade show"><span>Formato de arquivo não suportado. somente upload <b>' . implode( ', ', $tipoDoArquivo) . '</b> arquivos .</span>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                echo '</div>';
                
                $arquivoValido = false;
            }
    
            // Validate file size
            if ($_FILES["arquivo"]["size"] > 200000) {
                echo '<div class="container mt-3 w-50 text-center">';                
                    echo '<div class="alert alert-danger alert-dismissible fade show">Arquivo muito grande Max:2MB !!!';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                echo '</div>';
                $arquivoValido = 0;
            }
            
            $path = $pasta . $novoNomeDoArquivo . "." . $extensaoDoArquivo;
    
            if ($arquivoValido) {
                move_uploaded_file($arquivo["tmp_name"], $path);
                $sql = "UPDATE animal SET pathImagem_animal = ? WHERE id = {$animal['id']}";
                $statement = mysqli_prepare(Database::getConnection(), $sql);
                mysqli_stmt_bind_param($statement, 's', $path);
                mysqli_stmt_execute($statement);
                echo "<script lang='javascript'>window.location.href='pag_alt_dados_animal.php?id=".$animal['id']."';</script>";
            }
            else{
                echo '<div class="container mt-3 w-50 text-center">';                
                    echo '<div class="alert alert-danger alert-dismissible fade show">Falha ao enviar o arquivo!';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                    echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="container mt-3 w-50 text-center">';  
                echo '<div class="col align-self-center alert alert-info alert-dismissible fade show">Nenhum Arquivo Escolhido!';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                echo '</div>';
            echo '</div>';
        }
        
    }
    
?>