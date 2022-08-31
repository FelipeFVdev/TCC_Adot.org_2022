<?php
    session_start();
    if(isset($_SESSION["nome_usuario"])==false){
        header("location: pag_login.php");
    // }else{
      // $id = $_SESSION["id"];
      //  $con    = new mysqli("localhost", "root", "", "tcc");
      // $sql    = "select * from usuario where id='$id'";
      // $retorno = mysqli_query($con, $sql);
    //   $reg = mysqli_fetch_array($retorno);
       //print_r ($reg);
      // $nome_usuario = $_SESSION["nome_usuario"];
      // $endereco_usuario = $_SESSION["endereco_usuario"];      
     //  $telefone_usuario = $_SESSION["telefone_usuario"];
     //  $email_usuario  = $_SESSION["email_usuario"];
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
    <link rel="stylesheet" href="../css/pag_usuario.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->

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
                                <button type="button" class="btn btn-primary mt-3 mb-1" id="btnAltCadastrar" name="btnAltCadastrar">Alterar Cadastro</button>  
                            </a>
                            <br>
                            <a href="pag_alt_senha">
                                <button type="button" class="btn btn-primary mb-1" id="btnAltSenha" name="btnAltSenha">Alterar Senha</button>                        
                            </a>                 
                            <br>
                            <form method="post" onsubmit="return confirm('Você tem certeza que deseja apagar este perfil?');" action="pag_usuario.php?deletar=<?php echo $_SESSION['id'];?>">
                                <button type="submit" class="btn btn-danger" id="btnExcluir" name="btnExcluir">Excluir Perfil</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">                            
                        <div class="usuario_info" style="padding: 0 15px 0 15px;width: 70%">
                            <label>Nome</label> 
                            <input  type="text" class="form-control" id="txtNome" name="nome_usuario" disabled="true" value="<?php echo $_SESSION["nome_usuario"];?>"/>

                            <label>E-mail</label>
                            <input type="email" class="form-control" id="txtEmail" name="email_usuario" disabled="true" value="<?php echo $_SESSION["email_usuario"];?>"/>

                            <label>Endereço</label>
                            <input type="text" class="form-control" id="txtEndereco" name="endereco_usuario" disabled="true" value="<?php echo $_SESSION["endereco_usuario"];?>"/>

                            <label>Telefone</label>
                            <input type="text" class="form-control" id="nrTelefone" name="telefone_usuario" disabled="true" value="<?php echo $_SESSION["telefone_usuario"];?>"/>
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

<?php 
    function excluir(){
        $id = $_GET['deletar'];
        $con  = new mysqli("localhost", "root", "", "tcc");
        $sql = "delete from usuario where id = $id";
        mysqli_query($con, $sql);
        echo "<script lang='javascript'>window.location.href='sair.php';</script>";
        mysqli_close($con);
    }
?>