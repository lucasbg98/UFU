<html>

    <head>
        
    
    </head>

    <body>
        
        <?php
            session_start();
           
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];
            echo"<script type='text/javascript'>alert($cpf);</script>";
            
            $conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306);
           
             
            $result = mysqli_query($conexao, "SELECT * FROM usuarios where cpf =  '$cpf' and senha = md5('$senha')");
            
            if(mysqli_num_rows($result) > 0 ){
                $_SESSION['cpf'] = $cpf;
                $_SESSION['senha'] = $senha;
                header('location:logado.php');
            }
            else{
                unset($_SESSION['cpf']);
                unset($_SESSION['senha']);
                $msg= "CPF ou senha incorretos!";
                
                header('location:loginSEMAJAX.php');

                
               
              }
            ?>

    </body>
</html>
