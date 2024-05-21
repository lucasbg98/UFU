<?php 
    session_start();
        if(!isset($_SESSION['cpf']))
            header("location: login.php");
            
        else 
            $cpf = $_SESSION['cpf'];
    ?>