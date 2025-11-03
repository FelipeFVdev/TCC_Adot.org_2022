<?php
    require_once './functions.php';

    if(isset($_SESSION["id"])==false){
        header("location: pag_login.php");
        exit();

    }
    $user = getUserLogged();
    if($user["tipo"] =='INSTITUICAO'){
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
        
        <div class="container_usuario">
            <div class="row justify-content-center me-0">
                <div class="card w-50 p-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="container_img" style="text-align: center; padding-left: 3rem;">
                                <?php
                                    if(empty($user['pathImagem'])){
                                    echo '<img class="img_pag_usuario card-img-left" src="../img/default.png" alt="Card img" id="usuario_foto" style="padding-top: 1rem;';
                                    }
                                    else{echo '<img class="img_pag_usuario card-img-left" src="'.$user['pathImagem'].'" alt="Card img" id="usuario_foto" style="padding-top: 1rem;';}
                                ?> 
                                <img class="img_pag_usuario card-img-left" src="<?php echo $user['pathImagem']?>" alt="Card img" id="usuario_foto" style="padding-top: 1rem;">
                            </div>
                            
                            <div class="container_buttoms text-center ps-5 pt-3">

                                <a href="pag_alt_dados.php">
                                    <button type="button" class="btn btn-primary mt-3 mb-1" id="btnAltCadastrar" name="btnAltCadastrar">Alterar Cadastro</button>  
                                </a>

                                <p>
                                <p>

                                <a href="pag_alt_senha.php">
                                    <button type="button" class="btn btn-primary mb-1" id="btnAltSenha" name="btnAltSenha">Alterar Senha</button>                        
                                </a>         
                                    
                                <form class="mb-3" method="post" onsubmit="return confirm('Você tem certeza que deseja apagar este perfil?');" action="pag_usuario.php?deletar=<?php echo $user['id'];?>">
                                    <button type="submit" class="btn btn-danger" id="btnExcluir" name="btnExcluir">Excluir Perfil</button>
                                </form>
                                
                            </div>                        
                        </div>

                        <div class="col-4">                            
                            <div class="container_info pt-5">
                                <label>Nome</label> 
                                <input  type="text" class="form-control" id="txtNome" name="nome" disabled="true" value="<?php echo $user["nome"];?>"/>

                                <label>E-mail</label>
                                <input type="email" class="form-control" id="txtEmail" name="email" disabled="true" value="<?php echo $user["email"];?>"/>

                                <label>Endereço</label>
                                <input type="text" class="form-control" id="txtEndereco" name="endereco" disabled="true" value="<?php echo $user["endereco"];?>"/>

                                <label>Telefone</label>
                                <input type="text" class="form-control" id="nrTelefone" name="telefone" disabled="true" value="<?php echo $user["telefone"];?>"/>
                                
                            </div>
                            
                            <div class="text-center mt-5">
                                <a href="pag_inicial.php">
                                    <button type="button" class="btn btn-danger mt-2" id="btnVoltarUsuario" name="btnVoltarUsuario">Voltar</button>
                                </a>
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