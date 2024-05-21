<?php	

	
	$nome=$_POST['nome'];
	$sobrenome=$_POST['sobrenome'];
	$email=$_POST['email'];
	$data=$_POST['data'];
	$senha=$_POST['senha'];
	$confirmarsenha=$_POST['confirmarsenha'];
	$cpf=filter_input(INPUT_POST,"cpf",FILTER_SANITIZE_STRING);
	$telefone=$_POST['telefone'];
	$sexo=$_POST['sexo'];

	$conexao=mysqli_connect("localhost","root","","meu_site",3306);

	if($conexao){

		$query="INSERT INTO usuario(nome,sobrenome,email,datanascimento,cpf,senha,confirmarsenha,telefone,sexo)VALUES('$nome','$sobrenome','$email','$data','$cpf','$senha','$confirmarsenha','$telefone','$sexo')";

		$insere=mysqli_query($conexao,$query);

		if($insere){

			echo "Cadastro Realizado com sucesso!";
			

		}else{

			echo "Falha no Cadastro";

		}

	}

?>
