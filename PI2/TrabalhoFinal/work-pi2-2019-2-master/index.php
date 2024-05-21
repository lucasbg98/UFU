<!DOCTYPE html>
<html lang="pt">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta  name="author" content="">
    <link rel="shortcut icon" href="images/favicon.ico" />

    <title>Chassis Shop Homepage</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">  
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js" type="text/javascript"></script>
      <script src="js/jquery.mask.min.js" type="text/javascript"></script>
      <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
     
    <?php
            
      session_start(); 
      //session_destroy();      
    ?>

  </head>

  <body>
    <!-- Navigation -->
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
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrinho.php">Carrinho</a>
            </li>
        
            
          </ul>
        </div>
      </div>
      
    </nav>
<br><br><br>
    <!-- Page Content -->
    
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="pos-f-t">
          <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
              <h5 class="text-white h4"><center>Menu</center></h5>
              <a href="#" class="list-group-item btn text-white bg-dark">Desktops</a>
              <a href="#" class="list-group-item btn text-white bg-dark">Notebooks</a>
              <a href="#" class="list-group-item btn text-white bg-dark">Smartphones</a>
              <a href="#" class="list-group-item btn text-white bg-dark">Teclados</a>
              <a href="#" class="list-group-item btn text-white bg-dark">Mouses</a>
              <a href="#" class="list-group-item btn text-white bg-dark">Monitores</a>
            </div>
          </div>
        <nav class="navbar navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
      </div>
    </div>
        <!-- /.col-lg-3 -->

    <div class="col-lg-12">

      <div id="carouselExampleIndicators" class="carousel slide my-1 carousel" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
          <img class="d-block w-100" src="images\logo.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images\logo3.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
          <img class="d-block w-100" src="images\logo2.jpg" alt="First slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    <?php
     

      if(isset($_POST["id"])){
        $novo = array('id' => $_POST['id'],'nome'=> $_POST['nome'],'preco'=> $_POST['preco'],
        'qtd'=> $_POST['qtd'],'img'=> $_POST['img'],'categoria_fk'=> $_POST['categoria_fk'], );
        
        
        if(!isset($_SESSION["produtos"])){
         $produtos = array($novo);
         
        }else {
          $jaExiste=0;
          
          //array_walk
          $produtos = $_SESSION["produtos"];
          
          $index = count($produtos);
          echo "Index:".$index;
          echo "NOVO: ".$novo['id'];



          for($i = 0 ; $i <= $index; $i++){
            //echo "PRODUTOS: ".$produtos[$i]['id'];
            if($produtos[$i]['id'] == $novo['id']){
              //echo "QUANTIDADE: ".$produtos[$i]['qtd'];

                $produtos[$i]['qtd'] += 1;
                //echo "QUANTIDADE POS: ".$produtos[$i]['qtd'];
                $jaExiste++;
            }


          }
          /*foreach($produtos as $values){
            //$produtos[0]['qtd'] = asdasd
            $comma_separated = implode(",", $values);
            $comma_separated1 = implode (",", $novo);


            echo $comma_separated1;
             $pieces = explode(",", $comma_separated);
             echo $pieces[3];
              
              if(array_column($novo,'id') == array_column($values,'id')){
                $qtd = array_column($values,'qtd');
                //echo $qtd;
                $qtd++;
                $jaExiste++;
              }
                //array_walk($produtos, $qtd, array_column($values,'id'));
               
            }*/
            
           
           if($jaExiste==0){
             $produtos = $_SESSION["produtos"];
             array_push($produtos, $novo);
             
           }
        }
        $_SESSION["produtos"] = $produtos;
        
      }

/*
       if(isset($_POST["id"])){
        $novo = array('id' => $_POST['id'],'nome'=> $_POST['nome'],'preco'=> $_POST['preco'],
        'qtd'=> $_POST['qtd'],'img'=> $_POST['img'],'categoria_fk'=> $_POST['categoria_fk'], );
          if(isset($_SESSION["produtos"])){
            $produtos = $_SESSION["produtos"];
            array_push($produtos, $novo);
          }else{
          $produtos = array($novo);
        }
        $_SESSION["produtos"] = $produtos;
        }
      ?>  */
      
      ?>
      
<div class="row">

<?php
$conexao = mysqli_connect ("localhost", "root", "", "trabfinal", 3306); 

if($conexao){
    $rsProdutos = mysqli_query($conexao, "SELECT * FROM produto");
    foreach($rsProdutos as $values){
      if($values['qtd']>0){
      ?>
      
      <form action="index.php" method="post" class="col-lg-4 col-md-6 mb-4">
        
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="images/<?echo $values['img'];?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#"><?echo $values['nome'];?></a>
              </h4>
              <h5><?echo $values['preco'];?></h5>
              <input type="hidden" name="id" value="<?php echo $values['id'];?>">
              <input type="hidden" name="nome" value="<?php echo $values['nome'];?>">
              <input type="hidden" name="preco" value="<?php echo $values['preco'];?>">
              <input type="hidden" name="qtd" value="1">
              <input type="hidden" name="descricao" value="<?php echo $values['descricao'];?>">
              <input type="hidden" name="img" value="<?php echo $values['img'];?>">
              <input type="hidden" name="categoria_fk" value="<?php echo $values['categoria_fk'];?>">
              <p class="card-text"><?php echo $values['descricao'];?></p>
              <input type="submit" class="btn btn-success" value="Adicionar ao carrinho">
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
        
        </div>
        </form>
    
  <?php
    }
  }   
}
?>
</div>
      </div>
    </div>
   </div>
    <div class="col-12 copyright mt-4">
      <p class="float-left">
          <a href="#"><center>Voltar ao início</center></a>
      </p>          
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Danilo Pereira e Lucas Bragança Website 2019</p>
        
              <center><a class="nav-link" href="contato.php">Contato</a></center>
            
      </div>
      <!-- /.container -->
    </footer>

  </body>

</html>
