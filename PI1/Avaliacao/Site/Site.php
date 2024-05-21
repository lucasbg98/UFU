
<?php

	session_start();

	if(isset($_GET["Sair"])){
		header("location: Site.php");
		session_destroy();

	}


?>


<!DOCTYPE html>

<html lang="br">
<head>
	<title>Loja</title>
	<link rel="stylesheet" type="text/css" href="../css/style-navegador.css">
<head>


<body>

<header>
<div class="style-in">

	<div class="centro">



		<a class="login" href="pagina_login.php"><img  src="../css/icons/icon.png"> Login</a>
		<a class="relatorio" href="pagina_relatorio.php"><img src="../css/icons/relatorio.png">Relatório</a>
		<a class="sair" href="?Sair">Sair</a>

	</div>

</div>

<div class="menu_opcoes">


	<nav>
		<ul>


	 	 <li><a href="">Lançamentos</a></li>
	  	 <li><a href="">Masculinos</a>
			<ul>
			 	<li><a href="">Adidas</a></li>
				<li><a href="">Citizen</a></li>
				<li><a href="">Dumont</a></li>
				<li><a href="">Timex</a></li>
			</ul>

		 </li>
	 	 <li><a href="">Femininos</a>

			<ul>
				<li><a href="">Adidas</a></li>
				<li><a href="">Citizen</a></li>
				<li><a href="pagina_produto.php?id=2">Technos</a></li>
				<li><a href="pagina_produto.php?id=1">Condor</a></li>
			</ul>

		 </li>
	  	 <li><a href="">Marcas</a></li>
	  	 <li></li>

		</ul>
</nav>
</div>
</header>

<div class="links">

	 <a class="carrinho" href="pagina_carrinho.php"> <img src="../css/icons/carrinho.png"><br>Carrinho</a>

 	<a class="minha_conta" href="Site.php?p=pagina_minhaconta"> <img src="../css/icons/minha_conta.png"><br>Minha Conta</a>
		  <?php

			$valor=@$_GET['p'];
			if($valor == 'pagina_minhaconta'){

				require_once 'pagina_minhaconta.php';

			}

		   ?>

</div>




<div class="produtos">

		<ul>	

		
			<li>
	
				<div class="produto1">

					<a href="pagina_produto.php?id=1"><img src="../css/icons/relogio2.jpg" width="300px" height="300px">

						<p><h3>Relogio Condor</h3></p>
						<p>Preço: R$ 179,90</p>	
				
					</a>
				</div>

			</li>	


			<li>

					
				<div class="produto2">

					<a href="pagina_produto.php?id=2"><img src="../css/icons/relogio3.jpg" width="260px" height="260px">

						<p><h3>Relogio technos	</h3></p>
						<p>Preço:R$249,75</p>	
				
					</a>
				</div>




			</li>
					
		</ul>		
	
</div>
</body>

</html>
