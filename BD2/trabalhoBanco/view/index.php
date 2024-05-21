<!--eu inicio inicio a sessao e vejo se o usuaio esta logado vindo do formulario ou se ele apenas mudou na url-->
<?php
session_start();
if (isset(  $_SESSION['logado'])) {
?>
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

</head>
<body>

  <!--parte do menu com as opcoes -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><i>DESCARTAQUI</i></a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active" ><a href="administrador.php" >HOME</a></li>
        <li><a href="listarCooperativas.php">LISTAR COOPERATIVAS</a></li>
         <li><a href="listarLixo.php">LISTAR LIXO ELETRONICO</a></li>
         <li><a href="listarRecicladores.php">LISTAR RECICLADORES</a></li>
         <li><a href="listarComentarios.php">LISTAR COMENTARIOS</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>SAIR</a></li>
      </ul>
    </div>
  </nav>
 
 <!--conteudo da pagina --> 
  <div class="container" id="alinhamentoCentro">
    <img src="img/ufu.png">
  </div>
</html>
</body>

<?php
//se o usuario nao estiver logado eu direciono ele pra pagina de login
}else {
    header('Location: login.php');
    session_destroy();
  } 
?>
