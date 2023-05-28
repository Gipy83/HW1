<?php
    require_once 'dbconfig.php';
    require_once 'function.php';

    session_start();
    header('Content-Type: application/json');

    modal();
?>