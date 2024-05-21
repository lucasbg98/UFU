
<?php
	

	$id=$_POST['id'];
	
	$conexao=mysqli_connect("localhost","root","","meu_site",3306);

	if($conexao){

	$query="INSERT INTO Produtos(nome,quantidade,preco)VALUES('$nomeproduto','$quantidade','$preco')";
	$id++;	
	$insert=mysqli_query($conexao,$query);

	if($insert){

		echo "Adicionado ao carrinho!";
	
			

	}else{

		echo "Falha ao Adicionar ao carrinho";

	}

}


?>
