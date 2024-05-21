<html lang="br">

<head>
	<title>Cria Nova Conta</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style_cadastrar.css">
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	<script type="text/javascript" src="../jquery/jquerycadastro.js"></script>
        <script type="text/javascript" src="../scripts/scriptcadastro.js"></script>




</head>


<body>

<div class="caixa_interna">

<div id="titulo" >
		<div id="msgdiv"></div>

		<h2>Criar Conta</h2>
		<span>*Campos Obrigatórios</span><br>

</div><br><br>

<!--<form id="form" action="" method="post">-->




		<label>Email</label><span>*</span><br>
		<input id="inputemail" type="text" name="email"></input>
		<br><br>


	<ul>

		 <li>

			<label>Nome</label><span>*</span><br>
			<input id="inputnome" type="text" name="nome"></input>
			<br><br>
		 </li>

		 <li>
			<label>Sobrenome</label><span>*</span><br>
			<input id="inputsobrenome" type="text" name="sobrenome"></input>
			<br><br>

		 </li>

		 <li>
			<label>Data de Nascimento</label><span>*</span><br>
			<input id="inputdata" type="date" name="data"></input>
			<br><br>

		 </li>


		 <li>
			<label>Senha</label><span>*</span><br>
			<input id="inputsenha" type="password" name="senha"></input>
			<br><br>
		 </li>
	</ul>


	<ul>

	      <li>

		<label>CPF(Somente números)</label><span>*</span><br>
		<input id="inputcpf" type="text" name="cpf"></input>
		<br><br>

	      </li>

	      <li>
		<label>Sexo</label><span>*</span><br>
		<input id="inputsexo" type="text" name="sexo"></input>
		<br><br>

	      </li>


	      <li>

		<label>Telefone</label><span>*</span><br>
		<input id="inputtelefone" type="text" name="telefone"></input>
		<br><br>

	      </li>

	      <li>

		<label>Confirmar Senha</label><span>*</span><br>
		<input id="inputconfirmarsenha" type="password" name="confirmarsenha"></input>
		<br><br>

	      </li>

	</ul>


		<input id="botaosalvar" type="button"  value="Cadastrar" name="botaosalvar"></input>

<!--</form>-->

</div>

</body>



</html>
