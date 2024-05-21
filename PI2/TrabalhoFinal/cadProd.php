<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Cadastro Produto</title>
  
  <link href="css/bootstrap.min.css" rel="stylesheet">  
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/jquery.mask.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
  <link rel="shortcut icon" href="images/favicon.ico" />

  <script type="text/javascript">
    $(document).ready(function(){
        $('#preco').mask('000000000000000.00', {reverse: true});
        $('#qtd').mask('0########');
    });
    </script>
 
  
    <?php
        session_start();
        //  session_destroy();
                
        if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha']))
            header('location: login.php');
        else {
            $cpf = $_SESSION['cpf'];
            $nome = $_SESSION['nome'];

            $conexao = mysqli_connect ("localhost", "root", "lbg122010", "trabfinal", 3306);
                
                $result = mysqli_query($conexao, "SELECT perfil_fk FROM usuarios where cpf = '$cpf'");
                $perfil=$result->fetch_array();
                $perfil=$perfil['perfil_fk'];
            
                if($perfil != "Administrador"){
                    $_SESSION['cadproduto'] = 30;
                    header('location: login.php');
                    
                }



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
            
            
                $conexao = mysqli_connect ("localhost", "root", "lbg122010", "trabfinal", 3306);

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
        <br><br><br>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


    <div class="row justify-content-center">
    <div class="col-md-4">
    <div class="card">
    <header class="card-header">
        <!--<a href="login.php" class="float-right btn btn-outline-primary mt-1">Conecte-se</a>-->
        <h4 class="card-title mt-2">Cadastro Produto</h4>
    </header>
    <article class="card-body">
    <form action="cadProdPHP.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col form-group">
            <label>Nome do Produto</label>
            <input type="text" class="form-control" required name="nome" id="nome"  placeholder="Digite o nome do produto">
        
            </div> <!-- form-group end.// -->
            
        </div> <!-- form-row end.// -->
        
        <div class="form-group">
            <label>Preço final do Produto</label>
        <input type="text" class="form-control" required name="preco" id="preco"  placeholder="Digite valor final do produto">
        <small class="form-text text-muted">Favor inserir apenas números</small>
            
            <small class="form-text text-muted"></small>
            <label>Quantidade</label>
            <input type="text" class="form-control cpf-mask" required name="qtd" id="qtd" placeholder="Digite somente números" >
        </div> <!--form-group end.// -->


        <div class="form-group">
            <label for="exampleFormControlSelect1">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria" require_once placeholder="Categoria">
                <option>Notebook</option>
                <option>Desktop</option>
                <option>Mouse</option>
                <option>Teclado</option>
                <option>Smartphone</option>
                <option>Headset</option>
        
            </select>
        </div><!--form-group end.// -->


        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descrição do produto</label>
            <textarea class="form-control" id="descricao" name="descricao" require placeholder="Digite a descrição do produto" rows="3"></textarea>
        </div>


        <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <!-- O Nome do elemento input determina o nome da array $_FILES -->
             Enviar esse imagem: <input name="img" id="img" type="file" />
        </div>
        
        <div class="form-group">
            <!-- <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>-->
            <input type="submit" class="btn btn-primary float-right" value="Cadastrar">
        </div> <!-- form-group// -->      
            
                            
    </form>


    </script>
    </article> <!-- card-body end .// -->

    </div> <!-- col.//-->
    <div class="container">
        
        <?php 
        if(!isset($_SESSION['cadsucesso'])){

        }
        
        else if($_SESSION['cadsucesso'] == 10){?>
            <div class="alert alert-success" role="alert"><center>
            Produto cadastrado com sucesso!</center>
        </div><?php $_SESSION['cadsucesso']=0;
        }
        else if($_SESSION['cadsucesso'] == 20){?>
            <div class="alert alert-danger" role="alert"><center>
            Este produto já esta cadastrado!</center>
        </div><?php $_SESSION['cadsucesso']=0;
        }   ?>
        

            </div>  
    </div> <!-- row.//-->




    </div> 




    <!--container end.//-->

    <br><br>
    <article class="bg-secondary mb-3">  
    <div class="card-body text-center">
    <!-- <h3 class="text-white mt-3">Copyright &copy; Danilo Pereira Website 2019</h3>-->
    <p class="h5 text-white">Created by Danilo Pereira,   <br>for crazy developers...</p>   <br>
    <p><a class="btn btn-success" target="_blank" href="http://www.facebook.com/danilo49"> Facebook  
    <i class="fa fa-window-restore "></i></a></p>
    </div>
    <br><br>


    </article>



</body>


</html>