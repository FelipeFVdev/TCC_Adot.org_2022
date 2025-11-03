<?php
    require_once './functions.php';
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


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <?php
            require_once './partials/common.php';
        ?>
        
        <div class="container rounded py-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center border-bottom border-2 pb-3">Cadastrar Animal</h2>

                    <div id="formulario">
                        <form method="post" action="pag_cadastro_animal.php?salvar=1" id="formCadastroAnimal" enctype="multipart/form-data">
                            <div class="form form-group mt-3" style="width:70%;margin:auto;">
                                <div class="form-row">
                                    <div class="row">

                                        <label>Selecione a foto do animal:</label>

                                        <div class="button">
                                            <input class="form-control w-50" type="file" name="foto_animal" id="foto_animal" style="padding: 0 !important; padding-left: 10px;"></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="tipo">Selecione o tipo de animal</label>
                                            <SELECT name="tipoAnimal" id="tipoAnimal" class="form-SELECT form-SELECT-sm">
                                                <option value="cachorro">Cachorro</option>
                                                <option value="gato">Gato</option>
                                                <option value="ave">Ave</option>
                                            </SELECT>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                                <label for="sexo">Selecione o sexo do animal</label>
                                                <SELECT name="sexoAnimal" id="sexoAnimal" class="form-SELECT form-SELECT-sm" required>
                                                    <option value="Femea">Fêmea</option>
                                                    <option value="Macho">Macho</option>
                                                </SELECT>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nome do animal</label>
                                        <input type="text" class="form-control form-control-sm" id="txtNomeAnimal" placeholder="Digite nome do animal" name="nomeAnimal" required/>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Idade do animal em meses</label>
                                            <input type="text" class="form-control form-control-sm" id="txtIdadeAnimal" placeholder="Digite a idade do animal em meses" name="idadeAnimal" required/>
                                        </div>
                
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Raça do animal</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Digite a raça do animal" id="txtRacaAnimal" name="racaAnimal" required/>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Descrição do animal</label>
                                        <textarea type="text" class="form-control form-control-sm" placeholder="Breve descrição do animal" id="txtDescAnimal" name="descAnimal" required></textarea>
                                    </div> 
                                </div>

                                <br/>

                                <div class="mb-3">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg" id="btnCadastrar" name="btnCadastrar">Cadastrar</button>

                                        <a href="pag_instituicao.php">
                                            <button type="button" class="btn btn-danger btn-lg" id="btnVoltarInst" name="btnVoltarInst">Voltar</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <?php
                        if(isset($_GET["salvar"])) cadastrarAnimal();
                        ?>
                    </div>                    
                </div>
            </div>
        </div>

    </body>
</html>
<?php
    function cadastrarAnimal(){
        $nomeAnimal = $_POST["nomeAnimal"];
        $idadeAnimal = $_POST["idadeAnimal"];
        $sexoAnimal = $_POST["sexoAnimal"];
        $racaAnimal = $_POST["racaAnimal"];
        $descAnimal = $_POST["descAnimal"];
        $tipoAnimal = $_POST["tipoAnimal"];
        $id = $_SESSION["id"];
        $arquivo = $_FILES['foto_animal'];
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
                echo "<span>Formato de arquivo não suportado. somente upload<b>" . implode(", ", $tipoDoArquivo) . "</b> arquivos .</span>";
                $arquivoValido = false;
            }
    
            // Validate file size
            if ($_FILES["foto_animal"]["size"] > 200000) {
                echo "<span>Arquivo muito grande Max:2MB.</span>";
                $arquivoValido = 0;
            }
            
            $path = $pasta . $novoNomeDoArquivo . "." . $extensaoDoArquivo;
    
            if ($arquivoValido) {
                move_uploaded_file($arquivo["tmp_name"], $path);
                $sql = "INSERT INTO animal(id_usuario, tipo_animal, nome_animal, idade, sexo, raca, descricao, pathImagem_animal) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
                $statement = mysqli_prepare(Database::getConnection(), $sql);
                mysqli_stmt_bind_param($statement, 'ississss', $id, $tipoAnimal, $nomeAnimal, $idadeAnimal, $sexoAnimal, $racaAnimal, $descAnimal, $path);
                mysqli_stmt_execute($statement);
                $idNovo = mysqli_insert_id(Database::getConnection());
                echo "<script lang='javascript'>window.location.href='pag_animal.php?id=".$idNovo."';</script>";
            }
            else{
                echo "falha ao enviar arquivo";
            }
        } else 
            echo "No files have been chosen.";
        }   
?>
