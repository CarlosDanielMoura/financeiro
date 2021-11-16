<?php

@session_start();

if (@$_SESSION['nivel_usuario'] != 'Administrador' and @$_SESSION['nivel_usuario'] != 'Comum') {
    echo "<script>window.location='../index.php' </script>";
}
