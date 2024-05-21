<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  

  <title>Novo cadastro</title>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 
</head>

<body>
<?php

    $conexao = mysqli_connect
        ("localhost", "root", "", "trabfinal", 3306);


        


    if($conexao){
       // echo "Conectei no BD!<br>";
        //if(isset($_POST["usuarios"])){


        //$sql = "INSERT INTO contato VALUES ";

        //$sql .= "('$nome', '$telefone', '$email', '$assunto', '$mensagem')"; 
            
        $sql = "INSERT INTO usuarios (cpf, nome, senha) VALUES ('".$_POST["cpf"]."','".$_POST["nome"]."','".$_POST["senha"]."')";

        
    
        if (mysqli_query($conexao, $sql)) {
        echo "Nova tupla inserida com sucesso!";
        } else if(mysqli_errno($conexao) == 1062){
            //echo "<a href='novocadastro.php'>";
            //echo  "<div class='alert alert-danger'>
                    //<strong>Alerta!</strong>CPF já existe em nossa base de dados.
                    //</div>";
                    /*$.ajax('/novocadastro.php', {
                        type: 'POST', // método http
                        data: { myData: 'This is my data.' }, // dados
                        success: function (resultado) {
                        alert(“Deu certo! <br>” + resultado);
                    },
                    error: function (errorMessage) {
                        alert(“Deu erro! <br>” + errorMessage);
                    }
                    });*/
        }else 
            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
        
    } else 
        echo "Ops, deu erro!";
    
        //}


        
        

        
?></body>
</html>