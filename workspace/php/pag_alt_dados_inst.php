<?php
    require_once './functions.php';
    if(isset($_SESSION["id"])==false){
        header("location: pag_login.php");
        exit();
    }

    $user = getUserLogged();
?>

<?php 
    $id = $_SESSION['id'];
    if (isset($_FILES["arquivo"])) {
        $arquivo = $_FILES['arquivo'];
        // Validar se o arquivo não esta vazio
        if (!empty($arquivo["name"])) {
            $nomeDoArquivo = $arquivo["name"];
    
            $arquivoValido = true;
    
            // Validar se o arquivo já existe
            if (file_exists($nomeDoArquivo)) {
                echo "<script lang='javascript'>alert('Arquivo ja existe.')</script>";
                $arquivoValido = false;
            }
    
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
                echo "<script lang='javascript'>alert('Arquivo não suportado. formatos aceitos: " . implode(", ", $tipoDoArquivo) . "');</script>";
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
                $sql = "UPDATE usuario SET pathImagem = ? WHERE id = $id";
                $statement = mysqli_prepare(Database::getConnection(), $sql);
                mysqli_stmt_bind_param($statement, 's', $path);
                mysqli_stmt_execute($statement);
                //echo "<p> arquivo enviado com sucesso <a href='img/$novoNomeDoArquivo.$extensaoDoArquivo'> clique aqui </a></p>";
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
    <script lang="javascript" src="../js/pag_alterar_dados_inst.js"></script>
 

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <?php
            require_once './partials/common.php';
        ?>
        
        <div class="inst_container container">
            <div class="inst_content">
                <div class="card">
                    <div class="card-body">
                        <div class="row rounded py-2">

                            <div class="col-6">
                                <div class="inst_img text-center">
                                    <?php
                                        if(empty($user['pathImagem'])){
                                        echo '<img class="img_pag_alt_inst" src="../img/default.png" alt="Card img" id="instituicao_foto"/>';
                                        }
                                        else{
                                            echo '<img class="img_pag_alt_inst" src="'.$user['pathImagem'].'" alt="Card img" id="instituicao_foto"/>';
                                        }
                                    ?>
                                </div>

                                <div class="img">
                                    <form  class="ms-4 mt-4" action="" method="POST" enctype="multipart/form-data">
                                        <label>Selecione o arquivo:</label>
                                        <input name="arquivo" class="form-control" type="file">

                                        <button class="btn btn-block btn-success mt-2" name="upload" type="submit"> Enviar arquivo</button>

                                    </form>
                                </div>
                            </div>

                            <div class="col-6">
                                <div id="formulario">
                                    <form method="post" action="pag_alt_dados_inst.php?alterar=<?php echo $user["id"];?>" id="formAlterarInfo" style="padding: 0 15px 0 15px; width: 70% ">
                                        <div class="form row">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" class="form-control form-control-sm" id="txtNome" name="nome" value="<?php echo $user["nome"];?>"/>
                                            </div>

                                            <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control form-control-sm" id="txtEmail" name="email" value="<?php echo $user["email"];?>"/>
                                            </div>

                                            <div class="form-group">
                                            <label>CNPJ</label>
                                            <input type="email" class="form-control form-control-sm" id="txtCNPJ" name="cnpj" value="<?php echo $user["cnpj"];?>"/>
                                            </div>

                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <input type="text" class="form-control form-control-sm" id="txtEndereco" name="endereco"  value="<?php echo $user["endereco"];?>"/>
                                            </div>

                                            <div class="form-group">
                                                <label>Telefone</label>
                                                <input type="text" class="form-control form-control-sm" id="nrTelefone" name="telefone"  value="<?php echo $user["telefone"];?>"/>
                                            </div>

                                            <div class="form-group mt-2">
                                                <button type="button" class="btn btn-success mt-3" id="btnSalvarCadastro" name="btnSalvarCadastro" onclick="alterarInfoCadastro();">Salvar cadastro </button>
                                                <a href="pag_instituicao.php">
                                                    <button type="button" class="btn btn-danger mt-3" id="btnCancelarCadastro" name="btnCancelarCadastro" onclick="voltar()">Cancelar</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_GET["alterar"])){
        $id = $_GET['alterar'];
        $nome   = $_POST["nome"];
        $email  = $_POST["email"];
        $endereco = $_POST["endereco"];
        $cnpj = $_POST["cnpj"];
        $telefone = $_POST["telefone"];
        $sql  = "UPDATE usuario SET nome=? , email=? , cnpj=? ,endereco=? , telefone=? WHERE id=? ";
        $statement = mysqli_prepare(Database::getConnection(), $sql);
        mysqli_stmt_bind_param($statement, 'ssssss', $nome, $email, $cnpj, $endereco, $telefone, $id);
        mysqli_stmt_execute($statement);

        echo "<script lang='javascript'>window.location.href='pag_instituicao.php';</script>";
    }
?>

<script lang='javascript'>
    function voltar(){
        window.location.href='pag_instituicao.php';
    }
</script>
