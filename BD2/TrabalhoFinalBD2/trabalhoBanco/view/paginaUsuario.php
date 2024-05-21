<!--eu inicio inicio a sessao e vejo se o usuaio esta logado vindo do formulario ou se ele apenas mudou na url-->
<?php session_start();?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    
        <title>DESCARTAQUI</title>
        <meta charset="utf-8">

        <!-- link dos botstrap para a barra de menu responsivel-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/cadastro_css.css">
    </head>
    <body>
        <!--parte do menu com as opcoes -->
        <?php
        include_once("navebarUsuario.php");
        ?>
        <!--conteudo da pagina --> 
        <div class="container" id="alinhamentoCentro">
            <img src="img/ufu.png">
        </div>
    </body>
 </html>
<?php
//se o usuario nao estiver logado eu direciono ele pra pagina de login

?>
