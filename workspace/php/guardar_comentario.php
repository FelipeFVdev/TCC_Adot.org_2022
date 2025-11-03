<?php
require_once './database.php';

$comentario = $_POST["comentario"];
$nome = $_POST["nomeComentario"];
$email = $_POST["emailComentario"];
$id_animal = $_POST["id_animal"];
$sql = "INSERT INTO comentario (nome, email, conteudo, id_animal)  VALUES (?, ?, ?, ?)";
$statement = mysqli_prepare(Database::getConnection(), $sql);
mysqli_stmt_bind_param($statement, 'sssi', $nome, $email, $comentario, $id_animal);
mysqli_stmt_execute($statement);
header("location: pag_animal.php?id=$id_animal");
