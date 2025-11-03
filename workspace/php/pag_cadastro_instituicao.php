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
        <link rel="stylesheet" href="../css/styles.css">
        <!-- js -->
        <script lang="javascript" src="../js/pag_cadastro_instituicao.js"></script>

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
            <div class="row justify-content-center me-0">
                <div class="card w-75">
                    <h2 class="text-center border-bottom border-1 pb-3 pt-3">Cadastrar Instituição</h2>

                    <div class="" id="formulario">
                        <form method="post" action="pag_cadastro_instituicao.php?salvar=1" id="formCadastroInst">

                        <div class="form" style="width:70%;margin:auto;">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" class="form-control form-control-sm" id="txtNome" placeholder="Digite o nome da instituição" name="nome"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="txtEmail" placeholder="Digite o email da instituição" name="email"/>
                                </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CNPJ</label>
                                        <input type="text" class="form-control form-control-sm" id="txtCNPJ" placeholder="Digite o CNPJ da instituição" name="cnpj"/>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Telefone</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Digite o telefone da instituição" id="nrTelefone" name="telefone"/>
                                    </div>                                  
                                
                                <div class="mb-3">
                                    <label class="form-label">Endereço</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Digite o endereço da instituição" id="txtEndereco" name="endereco"/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Senha</label>
                                    <input type="password" class="form-control form-control-sm" placeholder="Digite uma senha" id="txtSenha" name="senha"/>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirme a senha</label>
                                    <input type="password" class="form-control form-control-sm" placeholder="Confirme a senha" id="txtConfirSenha" name="confirmaSenha"/>
                                </div>
                            </div>

                            <br/>

                            <div class="mb-3">
                                <div class="d-grid gap-2 col-6 mx-auto rounded" style="background-color: #4C79D5;">
                                    <button type="button" class="btn btn-primary text-white" id="btnCadastrar" name="btnCadastrar" onclick="validar();">Cadastrar</button>
                                </div>
                            </div>

                        </div>
                        </form>

                        <?php
                            if(isset($_GET["salvar"])) cadastrarInstituicao();
                        ?>
                    </div>                
                </div>                
            </div>
        </div>
        
    </body>
</html>


<?php
  function cadastrarInstituicao(){
    $nome   = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $email  = $_POST["email"];
    $senha  = password_hash($_POST["senha"], PASSWORD_BCRYPT);
    $cnpj = $_POST["cnpj"];
    $tipo = 'INSTITUICAO';
    if(emailExiste($email)){
        echo "<script lang='javascript'>alert('email já cadastrado no sistema');</script>";
        return;
    }  
    $sql = "INSERT INTO usuario(nome, endereco, telefone, cnpj, email, senha, tipo) VALUES (?, ?, ?, ?, ? ,? ,? )";
    $statement = mysqli_prepare(Database::getConnection(), $sql);
    mysqli_stmt_bind_param($statement, 'sssssss', $nome, $endereco, $telefone, $cnpj, $email, $senha, $tipo);
    mysqli_stmt_execute($statement);
    echo "<script lang='javascript'>window.location.href='pag_login.php';</script>";
  }
?>