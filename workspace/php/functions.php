<?php
require_once './database.php';
session_start();

function getUserLogged(){
    if(isset($_SESSION["id"])==false){
        return null;
    }
    $id = $_SESSION['id'];
    $retorno = mysqli_query(Database::getConnection(), "SELECT * FROM usuario WHERE id='$id'");
    return mysqli_fetch_array($retorno);
}

function buscaAnimalPorId($id){
    $sql = "SELECT * FROM animal WHERE id=$id ";
    $retorno = mysqli_query(Database::getConnection(), $sql);
    $animal = mysqli_fetch_array($retorno);
    return $animal;
}

function buscaInstituicaoId($id){
    $sql = "SELECT * FROM usuario WHERE id=$id ";
    $retorno = mysqli_query(Database::getConnection(), $sql);
    $instituicao = mysqli_fetch_array($retorno);
    return $instituicao;
}

function buscaUsuarioPorId($id){
    $sql = "SELECT * FROM usuario WHERE id=$id ";
    $retorno = mysqli_query(Database::getConnection(), $sql);
    $usuario = mysqli_fetch_array($retorno);
    return $usuario;
}

function buscaInstituicaoNome($nome){
    $sql = "SELECT * FROM usuario WHERE nome=$nome ";
    $retorno = mysqli_query(Database::getConnection(), $sql);
    $instituicao = mysqli_fetch_array($retorno);
    return $instituicao;
}

function imprimirAnimais($animais){
    foreach ($animais as $animal){
        $nome_animal = $animal['nome_animal'];
        $raca = $animal['raca'];
        // TESTE CARD 
        echo '<div class="container_exibir p-5">';
            echo '<div class="row">';
                echo '<div class="card">';
                    echo '<img class="img_imprimir_animais card-img-top pt-3" src="'.$animal['pathImagem_animal'].'" alt="Card image">';
                    echo '<div class="card-body text-center">';
                        echo '<p class="card-title">Nome: <span class="lead">' .$nome_animal. '</span></p>';
                        echo '<p class="card-text">Raça: <span class="lead">' .$raca; '</span></p>';
                        echo '<p>';
                        echo '<div class="text-center"><a class="btn btn-primary stretched-link" href="pag_animal.php?id='.$animal['id'].'">Veja Mais</a></div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}

function excluir(){
    $id = $_GET['deletar'];
    $sql = "DELETE FROM usuario WHERE id = $id";
    mysqli_query(Database::getConnection(), $sql);
    echo "<script lang='javascript'>window.location.href='sair.php';</script>";
}

function excluirAnimal($id){
    $sql = "DELETE FROM animal WHERE id=$id";
    mysqli_query(Database::getConnection(), $sql);
}

function UsuarioLogadoEhDonoDoAnimal($animal){
    $usuarioLogado = getUserLogged();
    if(!$usuarioLogado){
        return false;
    }
    if($usuarioLogado['id'] == $animal['id_usuario']){
        return true;
    }
    return false;
}

function usuarioEstahLogado(){
    $usuario = getUserLogged();
    if(!$usuario){
        return false;
    }
}

function listaComentarioDoAnimal($id_animal){
    $sql = "SELECT * FROM comentario WHERE id_animal = $id_animal ";
    $rows = array();
    $retorno = mysqli_query(Database::getConnection(), $sql);
    while($row = mysqli_fetch_array($retorno)) {
        $rows[] = $row;
    }
    return $rows;
}

function emailExiste($email){
    $sql = "SELECT count(*) as count FROM usuario WHERE email=?";
    $statement = mysqli_prepare(Database::getConnection(), $sql);
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $resultado = mysqli_stmt_get_result($statement);
    $retorno = mysqli_fetch_array($resultado);
    if($retorno['count'] > 0){
        return True;
    }
    return False;
    }


