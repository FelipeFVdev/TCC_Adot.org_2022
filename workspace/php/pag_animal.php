<?php
    require_once './functions.php';
?>

<?php
    $animal = buscaAnimalPorId($_GET['id']);
    $instituicao = buscaInstituicaoId($animal['id_usuario']);
?>

<?php
    $comentarios = listaComentarioDoAnimal($_GET['id']);
?>

<?php
    $usuario = getUserLogged();
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
    <link rel="stylesheet" href="../css/pag_animal.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- js -->
    <script lang="javascript" src="../js/pag_animal.js"></script>

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
                <div class="card w-75 pt-4">

                    <div class="container_body">
                        <div class="row">
                            <!-- CONTAINER IMG + INFO -->
                            <div class="container_img-about">
                                <div class="row justify-content-center col-sm-12">
                                    <div class="container_img col-5 text-center">
                                        <img class="img_pag_animal" src="<?php echo $animal['pathImagem_animal']?>">

                                        <div class="text-center mt-2">
                                           <label for=""><b>Instituição: </b> <a href="pag_exibir_instituicao.php?id=<?= $instituicao['id']?>"><?php echo $instituicao['nome']?> </a> <!-- MOSTRA A INSTIUICAO DO ANIMAL --></label>
                                        </div>

                                        <?php if(UsuarioLogadoEhDonoDoAnimal($animal)){?>  

                                            <a href="pag_alt_dados_animal.php?id=<?php echo $animal["id"]?>">
                                                <button type="button" class="w-50 btn btn-primary mt-3 mb-1" id="btnAltAnimal" name="btnAltAnimal">Alterar animal</button>
                                            </a>
                                            <a href="pag_inicial.php">
                                                <button type="button" class="w-50 btn btn-danger ms-1 mt-2" id="btnVoltarAnimal" name="btnVoltarAnimal">Voltar</button>
                                            </a>
                                        <?php }?>

                                    </div>

                                    <div class="container_about col-6">               
                                        <div class="animal_info">

                                            <form method="post">
                                                <label>Tipo do Animal</label> 
                                                <input  type="text" class="form-control" id="txtTipoAnimal" name="tipoAnimal" disabled="true" value="<?php echo $animal["tipo_animal"];?>"/>

                                                <label>Nome</label>
                                                <input type="email" class="form-control" id="txtNomeAnimal" name="nomeAnimal" disabled="true" value="<?php echo $animal["nome_animal"];?>"/>

                                                <label>Idade em meses</label>
                                                <input type="text" class="form-control" id="txtIdade" name="idade" disabled="true" value="<?php echo $animal["idade"];?>"/>

                                                <label>Sexo</label>
                                                <input type="text" class="form-control" id="txtSexo" name="sexo" disabled="true" value="<?php echo $animal["sexo"];?>"/>

                                                <label>Raça</label>
                                                <input type="text" class="form-control" id="txtRaca" name="raca" disabled="true" value="<?php echo $animal["raca"];?>"/>

                                                <label>Descrição</label>
                                                <textarea type="text" class="form-control" id="txtDescricao" name="descricao" disabled="true"><?php echo $animal["descricao"];?></textarea>
                                            </form>
                                            
                                        </div>
                                    </div>                
                                </div>
                            </div>
                            <!-- CONTIANER REALIZAR COMENTARIO + COMENTARIO -->
                            <div class="container_footer" style="max-height: 60vh;">
                                <div class="row justify-content-center col-sm-12 pt-5" style="height: 70vh;"> 
                                    <div class="container_comentar col-4" style="margin-right: 72px; height: 50vh;">
                                        <form class="pb-3" method="post" action="guardar_comentario.php" style="display: flexbox" id="formComentario">
                                        
                                            <div class="inputNome pb-2">
                                                <input class="border border-2" type="text" id="nomeComentario" name="nomeComentario" <?php if($usuario != null){echo 'value="' . $usuario['nome'] . '" readonly';} ?> placeholder="nome" style="width: 60%">
                                            </div>
                                            
                                            <div class="inputEmail pb-2">
                                                <input class="border border-2" type="text" id="emailComentario" name="emailComentario" <?php if($usuario != null){echo 'value="'. $usuario['email'] . '" readonly';} ?> placeholder="email" style="width: 60%">
                                            </div>

                                            <div class="textComentario pb-2">
                                                <textarea class="rounded-3" id="comentario" name="comentario" rows="5" cols="33" placeholder="Digite seu comentario"></textarea>
                                            </div>

                                            <button type="button" class="btn btn-success mt-2" id="btnComentario" name="btnComentario" onclick="validarComentario();">Comentar</button>
                                                <input type="hidden" name="id_animal" value="<?php echo $animal['id']?>">
                                        </form>
                                    </div>
                                    <div class="container_coment card col-6" style="background-color: white; overflow: scroll; height: 50vh">
                                        <h5 class="card-title pt-1 pb-2 text-center border-2 border-primary border-bottom">Comentarios</h5>
                                        <div class="card-body">
                                            <?php
                                                foreach ($comentarios as $comentario){
                                                echo '<div class="row pb-4" style="">';     
                                                    echo '<div class="border">';
                                                        echo '<p class="pt-3">Nome: <b>'.$comentario['nome'].'</b>';
                                                        echo '<p>Comentario: <span class="lead">'.$comentario['conteudo'].'</span>';
                                                    echo '</div>';
                                                if ($comentario['resposta'] != null){
                                                    echo '<div class="border mt-1">';
                                                        echo '<p>Instituição: <b>'.$instituicao['nome'].'</b>';
                                                        echo '<p>Comentario: <span class="lead">'.$comentario['resposta'].'</span>';
                                                    echo '</div>';
                                                }
                                                if (UsuarioLogadoEhDonoDoAnimal($animal)){
                                                    ?>
                                                    <form method="post" action="guardar_resposta.php?id=<?= $comentario['id']?>" style="display: flexbox ">
                                                        <input class="border border-2 mt-3" type='text' name='resposta' placeholder='resposta' style='width: 80%'>
                                                        <input class="mt-2" id="" type='submit' value="Comentar">
                                                        <input type="hidden" name="id_animal" value="<?php echo $animal['id']?>">
                                                    </form>
                                                <?php
                                                }

                                                echo '</div>'; 
                                                
                                                }
                                            ?>             
                                        </div>
                                    </div>
                                </div>
                            </div><!-- FIM CONTIANER REALIZAR COMENTARIO + COMENTARIO -->   
                        </div>
                    </div><!-- FIM CONTAINER -->
                </div>
            </div>
        </div>            
    </body>
</html>

