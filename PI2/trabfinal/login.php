<?php
  //require_once('logout.php');
  require_once('jaLogado.php');
?>

<html>
    <head>
      <title>Chassis Shop Login</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">  
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js" type="text/javascript"></script>
      <script src="js/jquery.mask.min.js" type="text/javascript"></script>
      <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="shortcut icon" href="images/favicon.ico" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script type="text/javascript">
    $(document).ready(function(){
      $('#cpf').mask('000.000.000-00');
    });
    </script>
   
  </head>

  <body>

  <?php
 
	if(!isset($_SESSION['cadproduto'])){}

	else if($_SESSION['cadproduto']== 30){?>
		<div class="alert alert-danger" role="alert"><center>
 		  Está função está disponível somente para Administradores!</center>
	</div><?php $_SESSION['cadproduto']=0;
	}
  
  
  ?>
  <!-- Navigation -->
  
  <?php
    include 'navbarMenu.php';
    include 'loginCarrinho.php';
  ?>

  <!-- End Navitation -->

    <div class="container h-80">
    <div class="row align-items-center h-100">
        <div class="col-3 mx-auto">
            <div class="text-center">
              
                <img id="profile-img" class="rounded-circle profile-img-card" src="images\login.jpg" />
                <p id="profile-name" class="profile-name-card"></p>
                <h2>Chassis login</h2>
                
                <form id="meuform" >
                
                  <!--<input type="login" name="cpf" id="cpf" class="form-control form-group" placeholder="cpf" required autofocus>-->
                  <input type="text" class="form-control form-group cpf-mask" name="cpf" id="cpf" placeholder="056.424.945-98" required autofocus>
                  <input type="password" name="senha" id="inputPassword" class="form-control form-group" placeholder="password" required autofocus>

                
          <script type="text/javascript">

              
            $(function(){
              $("#meuform").submit(function(event){
                event.preventDefault();

                var dados_form = $(this).serialize();
                $.ajax({
                  type: "post",
                  url: "realizarLogin.php",
                  data: dados_form,
                  success: function(responseData){
                    //$("#mensagemDiv").html("SUCESSO! Resposta do servidor: <br/>" + responseData);
                   
                    window.location="logado.php";
                    
                  },
                  error: function(request, status, error){
                    $("#mensagemDiv").addClass("alert alert-danger").html("Erro! Resposta do servidor: <br/>" + request.responseText);
                  }
                });                
              });
            });
            

          </script>
              <a class = "float-right text-primary"href="cadUser.php">Criar conta</a>
                <button class="btn btn-lg btn-primary btn-block btn-signin " type="submit" id="btnEnviar" >Entrar</button>
                </form><!-- /form -->
                <div  class="text-danger" id="mensagemDiv"></div>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>