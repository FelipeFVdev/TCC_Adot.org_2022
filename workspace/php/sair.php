<?php
    session_start();
    session_destroy();
    header("location: pag_inicial.php?inicial=1");
?>