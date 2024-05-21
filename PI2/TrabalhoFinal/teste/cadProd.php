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
        $('#nome').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'); //varchar 45
        $('#preco').mask('00000000.00', {reverse: true});
        $('#qtd').mask('0########');
        //$('#descricao').mask('');
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

            include('conexaoSGBD.php');
            $sql = "SELECT * FROM usuarios where cpf = '$cpf' limit 1";
                
            $result = $conexao->query($sql);
            $array=$result->fetch_array();
            $perfil=$array['perfil_fk'];
            $_SESSION['nome']=$array['nome'];

        
            if($perfil != "Administrador"){
                $_SESSION['cadproduto'] = 30;
                header('location: login.php');
                
            }
            $conexao->close();
        }
    ?>
</head>

    <body>

    <?php 
        include 'navbarMenu.php' ;
        include 'dropdownLoginAdmin.php' ;
    ?>
   
    </nav>
        <br><br><br>

    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">-->


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
        <input type="hidden" name="MAX_FILE_SIZE" value="9999999" />
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



    </article>
    </div> 




    <!--container end.//-->

    <br><br>
    
    


    


    <?php
        include('footer.php');
    ?>
</body>


</html>