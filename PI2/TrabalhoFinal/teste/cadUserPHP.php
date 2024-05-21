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
    include('conexaoSGBD.php');

    if($conexao){
       
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $senha = md5($_POST["senha"]);
        $perfil = "usuario";


        $sql = "INSERT INTO usuarios (cpf, nome, senha, perfil_fk) VALUES ('".$cpf."','".$nome."','".$senha."','".$perfil."')";
    
        if ($conexao->query($sql)) {
          header('location: cadUser.php');
          $_SESSION['cadsucesso'] = 10;

          
        echo "Nova tupla inserida com sucesso!";
        } else if(!$conexao->query("SET a=1")==1062){
          header('location: cadUser.php');
          $_SESSION['cadsucesso'] = 20;
          die();
                    
                    //echo "CPF já existe em nossa base de dados.";
        }else  
            echo "Erro: " . $sql . "<br>" . $conexao->error;
        
    } else 
        echo "Ops, deu erro!";
    
        //}
        $conexao->close();

        
        

        
?></body>
</html>