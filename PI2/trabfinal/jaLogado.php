<?php
    session_start();
     if(isset($_SESSION['cpf'])){
        header("location: logado.php");

     }
?>
