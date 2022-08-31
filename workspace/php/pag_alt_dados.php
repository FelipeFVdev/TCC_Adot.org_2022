<?php
    session_start();
    if(isset($_SESSION["nome_usuario"])==false) header("location: pag_login.php");

    $user = getUserLogged($_SESSION['id']);
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
    <link rel="stylesheet" href="../css/pag_usuario.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_alterar_dados.js"></script>
 

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adot.org</title>
</head>
    <body>

        <!-- ========== TUDO QUE TEM "#" PRECISA COLOCAR UM LINK E MUDAR O PHP ========== -->
        <?php
            require_once './partials/common.php';
        ?>
        
        <div class="usuario_container container">
            <div class="usuario_content">
                <div class="row">
                    <div class="col-4">
                        <div class="usuario_img">
                            <img src="../img/fotoPerfil.png" alt="" id="usuario_foto">
                            <a href="pag_alt_dados.php">
                                <button type="button" class="btn btn-primary mt-3" id="btnAltFoto" name="btnAltFoto">Alterar Foto</button>  
                            </a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div id="formulario">
                            <form method="post" action="pag_alt_dados.php?alterar=<?php echo $user["id"];?>" id="formAlterarInfo" style="padding: 0 15px 0 15px; width: 70% ">
                                <div class="form row">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" id="txtNome" name="nome_usuario" value="<?php echo $user["nome_usuario"];?>"/>
                                    </div>

                                    <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" id="txtEmail" name="email_usuario" value="<?php echo $user["email_usuario"];?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" id="txtEndereco" name="endereco_usuario"  value="<?php echo $user["endereco_usuario"];?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" id="nrTelefone" name="telefone_usuario"  value="<?php echo $user["telefone_usuario"];?>"/>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-success mt-3" id="btnSalvarCadastro" name="btnSalvarCadastro" onclick="alterarInfoCadastro();">Salvar cadastro </button>
                                        <a href="pag_usuario.php">
                                            <button type="button" class="btn btn-secondary mt-3" id="btnCancelarCadastro" name="btnCancelarCadastro" onclick="voltar()">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
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
        $nome   = $_POST["nome_usuario"];
        $email  = $_POST["email_usuario"];
        $endereco = $_POST["endereco_usuario"];
        $telefone = $_POST["telefone_usuario"];
        $con  = new mysqli("localhost", "root", "", "tcc");
        $sql  = "UPDATE usuario SET nome_usuario='$nome', email_usuario='$email', endereco_usuario='$endereco', telefone_usuario='$telefone' WHERE id='$id'";
        mysqli_query($con, $sql);
        mysqli_close($con);
    
        setNomeUsuarioSession();
        echo "<script lang='javascript'>window.location.href='pag_usuario.php';</script>";
    }

    function setNomeUsuarioSession()
    {
        $_SESSION["nome_usuario"] = $_POST['nome_usuario'];
    }

    function getUserLogged($id){
        $con = new mysqli("localhost", "root", "", "tcc");
        $retorno = mysqli_query($con, "select * from usuario where id='$id'");
        return mysqli_fetch_array($retorno);
    }
?>

<script lang='javascript'>
    function voltar(){
        window.location.href='pag_usuario.php';
    }
</script>
