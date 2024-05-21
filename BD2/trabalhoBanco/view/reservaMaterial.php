<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reservar Material</title>
    <meta charset="utf-8">
    <!--link dos botstrap para a barra de menu responsivel-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- link das pastas para a eslilizacao do site-->
    <link rel="stylesheet" href="../css/cadastro_css.css">
    <script type="text/javascript" src="java/javascript.js"></script>
    <script type="text/javascript" src="js/reservaMateriais.js"></script>
</head>

<body>
    <!--parte do menu com as opcoes -->
    <?php
    include_once("navebarTecnico.php");
    ?>
    <!--conteudo da pagina --> 
    <div class="navbarcolor" id="cabecalho" style="color: white;"><br>
        <center>MATERIAIS DISPONÍVEIS</center>
        <br>   
    </div>
    <br><br>
    <!--tabela com as informações --> 
    <div class="container" id="meuform">

        <table id="tabelalaboratorio" class="table">
            <thead>
                <tr>
                    <th>CODIGO</th>
                    <th>NOME</th>
                    <th>RESERVA</th>
                    <th>OPÇÃO</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div id="mensagemDiv"></div>
    </div>
</body>
</html>