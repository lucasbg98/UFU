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

<!-- TESTE
	<script type="text/javascript">

		function calculaDigitoMod11(dado, numDig, limMult, x10){
		
		var mult, soma, i, n, dig;
			
		if(!x10) numDig = 1;
		for(n=1; n<=numDig; n++){
			soma = 0;
			mult = 2;
			for(i=dado.length-1; i>=0; i--){
			soma += (mult * parseInt(dado.charAt(i)));
			if(++mult > limMult) mult = 2;
			}
			if(x10){
			dig = ((soma * 10) % 11) % 10;
			} else {
			dig = soma % 11;
			if(dig == 10) dig = "X";
			}
			dado += (dig);
		}
		return dado.substr(dado.length-numDig, numDig);
		}
	</script>
-->
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
		  	<!--<input type="text" class="form-control" placeholder="">-->
        <input type="text" class="form-control cpf-mask" required name="cpf" id="cpf" onClick="TestaCPF(strCPF)" placeholder="056.424.945-98" >
        <small class="form-text text-muted">Favor inserir apenas números</small>
		</div> <!-- form-group end.// -->
		
	</div> <!-- form-row end.// -->
	<div class="form-group">
		<label>Nome</label>
    <input type="text" class="form-control" required name="nome" id="nome"  placeholder="Digite o nome">
		<!--<input type="email" class="form-control" placeholder="">-->
		<small class="form-text text-muted"></small>
	</div> <!-- form-group end.// -->
	<!--<div class="form-group">
			<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="option1">
		  <span class="form-check-label"> Male </span>
		</label>
		<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="option2">
		  <span class="form-check-label"> Female</span>
		</label>
	</div> <!-- form-group end.// -->
	<div class="form-row">
		 <!-- form-group end.// -->
	<!--	<div class="form-group col-md-6">
		  <label>Country</label>
		  <select id="inputState" class="form-control">
		    <option> Choose...</option>
		      <option>Uzbekistan</option>
		      <option>Russia</option>
		      <option selected="">United States</option>
		      <option>India</option>
		      <option>Afganistan</option>
		  </select>
		</div> <!-- form-group end.// -->
	</div> <!-- form-row.// -->
	<div class="form-group">
		<label>Senha</label>
	    <!--<input class="form-control" type="password">-->
      <input type="password" class="form-control" id="exampleInputPassword1" required name ="senha" id="senha" placeholder="Digite a senha">
	</div> <!-- form-group end.// -->  
    <div class="form-group">
        <!-- <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>-->
        <input type="submit" class="btn btn-primary float-right" value="Cadastrar">
    </div> <!-- form-group// -->      
    <small class="text-muted">Ao clicar no botão "Cadastrar", você confirma que aceita nossos <br>Termos de uso e politica de privacidade.</small>      
	<div class="container">
	
	<?php 
	if(!isset($_SESSION['cadsucesso'])){

	}
	
	 else if($_SESSION['cadsucesso']== 10){?>
		<div class="alert alert-success" role="alert"><center>
 		Cadastro realizado com sucesso!</center>
	</div><?php $_SESSION['cadsucesso']=0;
	}
	 else if($_SESSION['cadsucesso']== 20){?>
		<div class="alert alert-danger" role="alert">
 		 Este CPF já esta sendo utilizado para outra conta!
	</div><?php $_SESSION['cadsucesso']=0;
	}   ?>

	       </div>                        
</form>


</script>
</article> <!-- card-body end .// -->
<div class="border-top card-body text-center">Ter uma conta? <a href="login.php"> Conecte-se</a></div>

	
</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->




</div> 



<!--container end.//-->

<br><br><!--
<article class="bg-secondary mb-3">  
<div class="card-body text-center">
    <h3 class="text-white mt-3">Bootstrap 4 UI KIT</h3>
<p class="h5 text-white">Components and templates  <br> for Ecommerce, marketplace, booking websites 
and product landing pages</p>   <br>
<p><a class="btn btn-warning" target="_blank" href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com  
 <i class="fa fa-window-restore "></i></a></p>
</div>
<br><br>-->


</article>

<?php
	include 'footer.php';
?>

</body>


</html>