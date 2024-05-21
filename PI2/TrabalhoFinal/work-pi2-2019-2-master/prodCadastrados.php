<!DOCTYPE html>
<html>
    <head>
    <title>Bem vindo!</title>
    <meta charset="UTF-8">

    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery.mask.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
        
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatable').DataTable();
        });
        </script>
        <?php
            session_start();
            //  session_destroy();
                    
            if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha']))
                header('location: login.php');
            else {
                $cpf = $_SESSION['cpf'];
                //$nome = $_SESSION['nome'];
                //echo"<script type='text/javascript'>alert($cpf);</script>";
            }
        ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h3>Chassis Shop</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
            </li>
            
            <?php 
                //session_start();
                
                $conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306);
    
                $result = mysqli_query($conexao, "SELECT nome FROM usuarios where cpf = '$cpf'");
                $nome=$result->fetch_array();
                $_SESSION['nome']=$nome['nome'];
                //echo"<script type='text/javascript'>alert( $nome);</script>";
           
           ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['nome'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="logado.php">Home login</a>
                        <a class="dropdown-item" href="cadProd.php">Cadastrar Produto</a>
                        <a class="dropdown-item" href="prodCadastrados.php">Produtos Cadastrados</a>
                        <a class="dropdown-item" href="login.php?sair=ok">Sair</a>
                    <?php 
                        if(isset($_GET['sair'])){
                            
                            session_destroy();
                            header("location: index.php");
                            exit();
                        }
                    ?>
                        
                    </div>
                </li>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <br>
        <br>
        <br>

        <div class="container-fluid">
        <h1><center>Produtos cadastrados<center></h1>
        <form action="logado.php" id="form1" runat="server" method="post">
            <table border="3px" id="datatable" > <!--mesmo id da function-->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>   
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Qtd.</th>
                        <th>Categoria</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php

       
                        $conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306); 

                        if($conexao){
                            $rsClientes = mysqli_query($conexao, "SELECT * FROM produto");
                            foreach($rsClientes as $values){

                                echo '<tr>'
                                    .'<td><center>'. $values['id'] .'</center></td>'
                                    .'<td><a href="#"><img src="images/'.$values['img'].'" alt=""height="55" width="72"></a>'.'</td>'
                                    .'<td>'.  $values['nome'] .'</td>'
                                    .'<td>'.  $values['descricao'] .'</td>'
                                    .'<td>'.  $values['preco'] .'</td>'
                                    .'<td>'.  $values['qtd'] .'</td>'
                                    .'<td>'.  $values['categoria_fk'] .'</td>'
                                    
                                .'</tr>';

                            }   
                        }

                    ?>
                </tbody>
            </table>
        </form>
        </div>


        </body>

        </html>