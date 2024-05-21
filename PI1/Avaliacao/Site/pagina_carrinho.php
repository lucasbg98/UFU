


<html lang="br">
<head>
	<title>Carrinho</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style_carrinho.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	
			
<head>

<body>

<div class="sair" ><a href="?Sair">Sair</a></div>
<div id="msgdiv"></div>



<div class="tabela">
<h2>Item Adicionados</h2><br>


<div class="container">
         
  	<table class="table">
    		<thead class="thead-dark">
      			<tr>
				<th>Nome</th>
				<th>Quantidade</th>
				<th>Preço</th>
     		        </tr>
    		</thead>

    		<tbody>
      			<tr>

				<td></td>
				<td></td>
				<td></td>
	
	<?php
		
	session_start();
		
	
	$conexao=mysqli_connect("localhost","root","","meu_site",3306);
	
	if($conexao){

		if(isset($_SESSION['carrinho'])){

			foreach($_SESSION['carrinho'] as $id => $valor){

			$query="SELECT *FROM Produtos WHERE id=$id";

			$select=mysqli_query($conexao,$query);
		
				foreach($select as $coluna){

					echo "<tbody><td>".$coluna['nome']."</td>".
					      "<td>".$valor."</td>"."<td>".$coluna['preco']."</td>";			

				}

	
			}
	        }else{

			echo "<span>Carrinho vazio!</span>";


		}

	}
		
		
?>

	

     			</tr>
      
    		</tbody>
  	</table>
</div>
 	

	
</table>
<span id="total" >TOTAL R$</span>
<?php

		$conexao=mysqli_connect("localhost","root","","meu_site",3306);
		$precototal=0;

		if($conexao){

				//Total de produtos e preco
				$precototal=0;
				if (isset($_SESSION['carrinho'])){

					foreach(@$_SESSION['carrinho'] as $chave => $valor){

					
						$query="SELECT preco FROM Produtos WHERE id=$chave";
						$select=mysqli_query($conexao,$query);

						$linha = $select->fetch_assoc();
						$precototal+=$valor*$linha['preco'];
								 

					}

				}
				echo "<span>".$precototal."</span>";

		}



?>


</div>


<a href="?acao=comprartudo"><input id="comprartudo" class="botao" type="button" value="Comprar Tudo"></input></a>

<?php
	if(@$_GET['acao'] == 'comprartudo'){// O @ serve para mascarar o erro 

			if(!isset($_SESSION['logado'])){
				
				
				echo "<span>*Voce precisa estar logado</span>";

			}else{

				if(!isset($_SESSION['carrinho'])){

					echo "";	

				}else{
			
					$conexao=mysqli_connect("localhost","root","","meu_site",3306);
					$totalprodutos=0;
					$precototal=0;
					if($conexao){

						//Total de produtos e preco
						foreach($_SESSION['carrinho'] as $chave => $valor){

							 $totalprodutos+=$valor;
							 
							 $query="SELECT preco FROM Produtos WHERE id=$chave";
							 $select=mysqli_query($conexao,$query);

							 $linha = $select->fetch_assoc();
							 $precototal+=$valor*$linha['preco'];
							 

						}

						//inserindo na table Produto_Venda e Venda
						$_SESSION['total']=$precototal;
						$id=$_SESSION['id'];
						$query="INSERT INTO Vendas(usuario_id,data)VALUES('$id',now())";
						$insert=mysqli_query($conexao,$query);

						$id=mysqli_insert_id($conexao);
						foreach($_SESSION['carrinho'] as $chave => $valor){
	
							$query="INSERT INTO Produto_Venda(venda_id,produto_id,quantidade_total,valor_total)VALUES 								('$id','$chave','$totalprodutos','$precototal')";

							$insert=mysqli_query($conexao,$query);
						
						}
						
					 }
					 	
				}				

			}

		}
	
?>


	

</body>

</html>
