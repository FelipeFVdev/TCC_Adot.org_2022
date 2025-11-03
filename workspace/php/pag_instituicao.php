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
        
        <div class="instituicao_container container">
            <div class="card">
                <div class="card">
                    <div class="row rounded py-2">
                        <div class="col-4">
                            <div class="instituicao_img">
                                <div class="container_img text-center mt-2">
                                    <?php
                                        if(empty($user['pathImagem'])){
                                        echo '<img class="img_pag_instituicao" src="../img/default.png" id="instituicao_foto">';
                                        }
                                        else{echo '<img class="img_pag_instituicao" src="'.$user['pathImagem'].'" id="instituicao_foto">';}
                                    ?> 
                                </div>

                                <div class="container_buttons text-center mt-4">
                                    

                                    <a href="pag_alt_dados_inst.php">
                                        <button type="button" class="btn btn-primary mb-2" id="btnAltCadastrar" name="btnAltCadastrar">Alterar Cadastro</button>  
                                    </a>

                                    <br>

                                    <a href="pag_alt_senha.php">
                                        <button type="button" class="btn btn-primary mb-2" id="btnAltSenha" name="btnAltSenha">Alterar Senha</button>                        
                                    </a>
                                    <form class="mb-2" method="post" onsubmit="return confirm('Você tem certeza que deseja apagar este perfil?');" action="pag_instituicao.php?deletar=<?php echo $user['id'];?>">
                                        <button type="submit" class="btn btn-danger" id="btnExcluir" name="btnExcluir">Excluir Perfil</button>
                                    </form>    
                                </div>
                            </div>
                        </div>

                        <div class="col-8">                            
                            <div class="instituicao_info" style="padding: 0 15px 0 15px;">
                                <label>Nome</label> 
                                <input  type="text" class="form-control form-control-sm" id="txtNome" name="nome" disabled="true" value="<?php echo $user["nome"];?>"/>

                                <label>E-mail</label>
                                <input type="email" class="form-control form-control-sm" id="txtEmail" name="email" disabled="true" value="<?php echo $user["email"];?>"/>

                                <label>CNPJ</label>
                                <input type="text" class="form-control form-control-sm" id="txtCNPJ" name="cnpj" disabled="true" value="<?php echo $user["cnpj"];?>"/>

                                <label>Endereço</label>
                                <input type="text" class="form-control form-control-sm" id="txtEndereco" name="endereco" disabled="true" value="<?php echo $user["endereco"];?>"/>

                                <label>Telefone</label>
                                <input type="text" class="form-control form-control-sm" id="nrTelefone" name="telefone" disabled="true" value="<?php echo $user["telefone"];?>"/>
                                
                                <div class="d-flex justify-content-between">

                                    <a href="pag_inicial.php">
                                        <button type="button" class="btn btn-danger mt-3" id="btnVoltarInst" name="btnVoltarInst">Voltar</button>
                                    </a>

                                    <a href="pag_cadastro_animal.php">
                                        <button type="submit" class="btn btn-primary mt-3">Cadastrar Animal</button>
                                    </a>

                                    <a href="pag_animais_instituicao.php">
                                        <button type="submit" class="btn btn-primary mt-3">Visualizar Animais</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
              if(isset($_GET["deletar"])) excluir();{
            }
            ?>
            
        </div>
    </body>
</html>