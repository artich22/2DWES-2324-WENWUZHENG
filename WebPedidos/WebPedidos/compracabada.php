<?php
session_start();
    session_unset();
    header('Location: pe_inicio.php');
    exit();
?>