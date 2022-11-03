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

        <div class="container rounded py-2" style="background-color: #66C4A9;">
            <h1 class="text-center">Alterar Animal</h1>
            
            <div id="formulario">
                <form method="post" action="pag_alt_dados_animal.php?alterar=1" id="formAlterarAnimal">

                    <div class="form form-group mt-3" style="width:70%;margin:auto;">
                        <div class="form-row">
                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <label for="tipo">Selecione o tipo de animal</label>
                                    <select name="tipoAnimal" id="tipoAnimal" class="form-select form-select-sm">
                                        <option value="cachorro">Cachorro</option>
                                        <option value="gato">Gato</option>
                                        <option value="ave">Ave</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                        <label for="sexo">Selecione o sexo do animal</label>
                                        <select name="sexoAnimal" id="sexoAnimal" class="form-select form-select-sm">
                                            <option value="Femea">Fêmea</option>
                                            <option value="Macho">Macho</option>
                                        </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control form-control-sm" id="txtNomeAnimal" placeholder="Digite nome do animal" name="nomeAnimal"/>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Idade estimada do animal em anos</label>
                                    <input type="text" class="form-control form-control-sm" id="txtIdadeAnimal" placeholder="Digite a idade estimada do animal em anos" name="idadeAnimal"/>
                                </div>
        
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Raça do animal</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Digite a raça do animal" id="txtRacaAnimal" name="racaAnimal"/>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descrição do animal</label>
                                <textarea type="text" class="form-control form-control-sm" placeholder="Breve descrição do animal" id="txtDescAnimal" name="descAnimal"></textarea>
                            </div> 
                            
                        </div>

                        <br/>

                        <div class="mb-3"> 
                            <div class="d-grid gap-2 col-6 mx-auto rounded" style="background-color: #66C4A9;">
                                <button type="submit" class="btn text-white" id="btnCadastrar" name="btnCadastrar" style="background-color: #4C79D5;">Cadastrar</button>
                            </div>
                        </div>

                    </div>

                </form>

                <?php
                if(isset($_GET["salvar"])) cadastrarAnimal();
                ?>
                
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
        $con  = new mysqli("localhost", "root", "", "tcc");
        $sql  = "UPDATE usuario SET nome='$nome', email='$email', cnpj='$cnpj',endereco='$endereco', telefone='$telefone' WHERE id='$id'";
        mysqli_query($con, $sql);
        mysqli_close($con);

        echo "<script lang='javascript'>window.location.href='pag_instituicao.php';</script>";
    }
?>

<script lang='javascript'>
    function voltar(){
        window.location.href='pag_instituicao.php';
    }
</script>
