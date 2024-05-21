

<?php

if($_POST){

		session_start();


		$nome=$_POST["nome"];
		$senha=$_POST["senha"];


		 $conexao=mysqli_connect("localhost","root","","meu_site",3306);

		if($conexao){

			$query="SELECT *FROM usuario WHERE nome='$nome' AND senha='$senha'";

			$select=mysqli_query($conexao,$query);



			if(mysqli_num_rows($select) <= 0){
			    header("");
				echo "Usuario não encontrado";
				

			}else{

				
				$_SESSION['logado']=true;
				$linha = $select->fetch_assoc();
				$_SESSION['id']=$linha['id'];
				
				echo "<script>location.href='Site.php'</script>";

			}


		}

	}


?>
