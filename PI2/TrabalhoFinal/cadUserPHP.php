<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  

  <title>Cadastro Usuário</title>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.min.js"></script>
 
</head>

<body>
<?php
session_start();
$conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306);

    if($conexao){
       // echo "Conectei no BD!<br>";
        //if(isset($_POST["usuarios"])){


        //$sql = "INSERT INTO contato VALUES ";

        //$sql .= "('$nome', '$telefone', '$email', '$assunto', '$mensagem')"; 
            
      //  $sql = "INSERT INTO usuarios (cpf, nome, senha) VALUES ('".$_POST["cpf"]."','".$_POST["nome"]."','".$_POST["senha"]."')";
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $senha = md5($_POST["senha"]);
        $perfil = "usuario";


        $sql = "INSERT INTO usuarios (cpf, nome, senha, perfil_fk) VALUES ('".$cpf."','".$nome."','".$senha."','".$perfil."')";
    
        if (mysqli_query($conexao, $sql)) {
          header('location: cadUser.php');
          $_SESSION['cadsucesso'] = 10;

          
        echo "Nova tupla inserida com sucesso!";
        } else if(mysqli_errno($conexao) == 1062){
          header('location: cadUser.php');
          $_SESSION['cadsucesso'] = 20;
          die();
                    
                    //echo "CPF já existe em nossa base de dados.";
        }else 
            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
        
    } else 
        echo "Ops, deu erro!";
    
        //}


        
        

        
?></body>
</html>