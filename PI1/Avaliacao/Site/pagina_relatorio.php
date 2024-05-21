<?php

	session_start();

	if(!isset($_SESSION['logado'])){

		header("location:Site.php");
		session_destroy();
		
	}

?>

<html>
<head>
	<title>Relatório</title>	
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style_relatorio.css">

<head>


<body>

	<h2>Relatório de Compras</h2>
	<div class="container">
         
  	<table class="table">
    		<thead class="thead-dark">
      			<tr>
				<th>Cliente</th>
				<th>Quantidade Total</th>
				<th>Total a Pagar</th>
     		        </tr>
    		</thead>

    		<tbody>
      			<tr>

				<td></td>
				<td></td>
				<td></td>

			<?php

				$conexao=mysqli_connect("localhost","root","","meu_site",3306);
				if($conexao){

					
						$query="SELECT usuario.nome,quantidade_total,valor_total FROM usuario join Vendas on
						usuario.id=Vendas.usuario_id join Produto_Venda on Produto_Venda.venda_id=Vendas.id";
						$select=mysqli_query($conexao,$query);

						if(mysqli_num_rows($select) > 0){

							foreach($select as $coluna){
					
								echo "<tbody><td>".$coluna['nome']."</td>".
							      "<td>".$coluna['quantidade_total']."</td>"."<td>".$coluna['valor_total']."</td>";	
					
						
							}

						}else{

								echo "<span>Relatório Vazio! :(</span>";

						}
							
				}else{


						echo "Erro ao conectar-se ao banco :(";

				}

			?>


     			</tr>
      
    		</tbody>
  	</table>
</div>
 	

	
</table>



</body>


</html>
