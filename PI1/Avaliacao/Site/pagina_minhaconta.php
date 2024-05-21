<html lang="br">

<head>
	<title>Login do Cliente</title>
	<link rel="stylesheet" type="text/css" href="../css/style_minhaconta.css">
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	<script type="text/javascript" src="../jquery/jqueryminhacontalogin.js" ></script>
	<meta charset="utf-8">



<head>

<body>


<!--<div id="titulo"><h4>Cadastre-se ou Acesse a sua conta</h4></div>-->


<div class="caixa_interna">

	<div class="cadastre-se" ><h4>CADASTRE-SE</h4></div>
	<div id="msgdiv"></div>
	<div class="clientes_registrados" ><h4>CLIENTES REGISTRADOS<h4></div>



		
		<div id="msgdivnome" ></div>
		<input id="inputnome" type="text" placeholder="Nome ou Email"></input>
		<br><br><br>

		<div id="msgdivsenha" ></div>
		<input id="inputsenha" type="password" placeholder="Senha"></input>
		<br><br>
		<label>*Campos Obrigatorios</label>

		<a  id="cadastrar" href="pagina_cadastrar.php">Cadastre-se</a>
		<br><br>
		<input  id="entrar" type="button" value="Entrar"></input>



</div>

</body>


</html>
