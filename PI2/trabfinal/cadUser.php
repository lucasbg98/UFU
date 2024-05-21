<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Novo Cadastro</title>
  
  <link href="css/bootstrap.min.css" rel="stylesheet">  
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/jquery.mask.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>

  <script type="text/javascript">
  	$(document).ready(function(){
    	$('#cpf').mask('000.000.000-00');
	  //$('#nome').mask('000.000.000-00'); //varchar 255
    });
  </script>

  <?php
    session_start(); 
    //session_destroy();  
  ?>

</head>

<body>
	<?php 
		include 'navbarMenu.php';
		include 'loginCarrinho.php';
	?>
	<br><br><br>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

	<div class="row justify-content-center">
	<div class="col-md-4">
	<div class="card">
	<header class="card-header">
		<a href="login.php" class="float-right btn btn-outline-primary mt-1">Conecte-se</a>
		<h4 class="card-title mt-2">Cadastro Usuário</h4>
	</header>
	<article class="card-body">
	<form action="cadUserPHP.php" method="post">

		<div class="form-row">
			<div class="col form-group">
				<label>CPF</label>   
	        	<input type="text" class="form-control cpf-mask" required name="cpf" id="cpf" onClick="TestaCPF(strCPF)" placeholder="056.424.945-98" >
	        	<small class="form-text text-muted">Favor inserir apenas números</small>
			</div> 
		</div> 

		<div class="form-group">
			<label>Nome</label>
	    	<input type="text" class="form-control" required name="nome" id="nome"  placeholder="Digite o nome">
			<small class="form-text text-muted"></small>
		</div>

		<div class="form-row">
		</div> 

		<div class="form-group">
			<label>Senha</label>
      		<input type="password" class="form-control" id="exampleInputPassword1" required name ="senha" id="senha" placeholder="Digite a senha">
		</div>

	    <div class="form-group">
	        <input type="submit" class="btn btn-primary float-right" value="Cadastrar">
	    </div>

	    <small class="text-muted">Ao clicar no botão "Cadastrar", você confirma que aceita nossos <br>Termos de uso e politica de privacidade.</small>

		<div class="container">
			<?php 
				if(!isset($_SESSION['cadsucesso'])){

				}
				
				else if($_SESSION['cadsucesso']== 10){
			?>
					<div class="alert alert-success" role="alert">
						<center>Cadastro realizado com sucesso!</center>
					</div>
					<?php $_SESSION['cadsucesso']=0;
				}
				 else if($_SESSION['cadsucesso']== 20){
				 	?>
					<div class="alert alert-danger" role="alert">
			 		 Este CPF já esta sendo utilizado para outra conta!
					</div>
					<?php $_SESSION['cadsucesso']=0;
				}   
			?>
		</div>

	</form>
	</article> 
	<div class="border-top card-body text-center">Ter uma conta? <a href="login.php"> Conecte-se</a></div>

	</div>
	</div> 
	</div> 
	<br><br>

	<?php
		include 'footer.php';
	?>

</body>
</html>