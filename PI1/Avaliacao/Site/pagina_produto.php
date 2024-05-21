<?php


		$conexao=mysqli_connect("localhost","root","","meu_site",3306);
		$id=$_GET['id'];
		

		if($conexao){

			$query="SELECT *FROM Produtos WHERE id=$id";
			$select= mysqli_query($conexao,$query);

			foreach($select as $coluna){

				echo "<title>".$coluna['nome']."</title>";
				echo "<h1>".$coluna['nome']."</h1>";
				echo "<p>".$coluna['descricao']."</p>";
				echo "<h2>"."Por R$".$coluna['preco']."</h2>";
			}

		}



?>
<html>

<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style_produto.css">
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	<script type="text/javascript" src="../jquery/jqueryproduto1.js"></script>


</script>

<head>

<body>

	
	<div class="caixa_interna">
		
		<div class="imgproduto">
		<img src="../imgprodutos/relogiopagina1.jpg" widht="350px" height="500px">
		</div>
		
		<div class="subcaixa">
		
			
				<h1></h1>
				<p></p>
			
			<h2></h2>
		
			<span>Quantidade</span>
			<input id="quantidade" class="quantidade" type="number" name="quantidade"></input><br>
			<div id="msgdiv"></div>
			<input id="botaocomprar" class="botao" type="button" value="Adicionar ao carrinho"></input>
			<input id="id" class="id" name="id"  type="hidden" value="<?php echo $_GET['id'] ?>" ></input>


		</div>




	</div>


</body>



</html>
