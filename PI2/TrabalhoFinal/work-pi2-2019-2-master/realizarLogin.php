<html>

    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="contato.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    
    </head>

    <body>
        
        <?php
            session_start();
           
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];
            
            $conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306);
           
             
            $result = mysqli_query($conexao, "SELECT * FROM usuarios where cpf =  '$cpf' and senha = md5('$senha')");
            
            if(mysqli_num_rows($result) > 0 ){
                
                $_SESSION['cpf'] = $cpf;
                $_SESSION['senha'] = md5("$senha");
                $nome=$result->fetch_array();
                $_SESSION['nome']=$nome['nome'];
            
                
                //header('location:logado.php');
                
            }
            else{
                header("HTTP/1.0 400 Bad Request");
                unset($_SESSION['cpf']);
                unset($_SESSION['senha']);
                $msg= "CPF ou senha incorretos!";
                echo $msg;
              }
            ?>

    </body>
</html>
