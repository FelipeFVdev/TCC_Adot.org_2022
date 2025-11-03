<?php
    require_once './functions.php';
    session_destroy();
    header("location: pag_inicial.php?inicial=1");
?>