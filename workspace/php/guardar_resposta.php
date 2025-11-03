<?php
require_once './database.php';
    $resposta = $_POST["resposta"];
    $id = $_GET["id"];
    $id_animal = $_POST["id_animal"];
    $sql = "UPDATE comentario SET resposta=? WHERE id=?";
    $statement = mysqli_prepare(Database::getConnection(), $sql);
    mysqli_stmt_bind_param($statement, 'ss', $resposta, $id);
    mysqli_stmt_execute($statement);
    header("location: pag_animal.php?id=$id_animal");

