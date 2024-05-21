
<?php

	session_start();
	
	
	$quantidade=$_POST['quantidade'];
	$id=$_POST['id'];
	
	
	if(!isset($_SESSION['carrinho'])){
		
		$_SESSION['carrinho']=array();

	}

				
	
	if(!isset($_SESSION['carrinho'][$id])){

		$_SESSION['carrinho'][$id]=$quantidade;
			
			
	}else{
				
			$_SESSION['carrinho'][$id]+=$quantidade;
			
	}



	echo "Adicionado ao carrinho!";

	


	

?>
