<html>
<head>

    <title>Chassis Shop Carrinho</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="carrinho.css">
    <script src="carrinho.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>

    <?php
        session_start();
        //session_destroy();
        $qtdproduto=0;
        if(!isset($_SESSION["produtos"])){
            
        }
        else {
            if(isset($_POST['delete'])) {
                $aux = $_SESSION["produtos"];
                $new = array();

                for($i = 0; $i < count($aux); $i++){
                    if($aux[$i]['id'] != $_POST['delete']){
                        $new[] = $aux[$i];
                    }
                }

                $_SESSION["produtos"] = $new;
            }

            $produtos = $_SESSION["produtos"];
            foreach($produtos as $values)
                $qtdproduto++;

        }
    ?>
   
    <?php 
        include 'navbarMenu.php';
        include 'itensNavbarCarrinho.php';
    ?>
    <br><br>

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">E-COMMERCE CART</h1>
        </div>
    </section>

    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Produto(s)</th>
                                <th scope="col" >Acessível</th>
                                <th scope="col" class="text-center">Quantidade</th>
                                <th scope="col" class="text-center">Preço</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;
                                if(!isset($_SESSION["produtos"])){
                        
                                }
                                else {
                                    $produtos = $_SESSION["produtos"];
                                        
                                        
                                    foreach($produtos as $id=>$values){
                                        $aux="";
                                        $aux=($id%2==0)?"background-color: rgba(0,0,0,0)" : "background-color: #fff;";
                            ?>

                            <tr>
                                <td><a href="#"><img src="images/<?php echo $values['img'];?>" alt="" width="62" height="48"></a></td>

                                <td><br><?php echo $values['nome'];?></td>

                                <td><br><?php $estoque = $values['qtd'] !=0 ? "Em estoque":"Estoque esgotado"; 
                                                        echo $estoque ?> </td>

                                <td><br><div class="quantity">
                                    <a href="#" id="<?php echo('quantity__minus'.$values['id']);?>" class="quantity__minus" onclick="diminuir('<?php echo $values['id']; ?>','<?php echo $values['preco']; ?>')"><span>-</span></a>
                                    <input id="<?php echo('quantity'.$values['id']);?>" disabled type="text" class="quantity__input" value="<?php echo $values['qtd']?>">
                                    <a href="#" id="<?php echo('quantity__minus'.$values['id']);?>" class="quantity__plus" onclick="aumentar('<?php echo $values['id']; ?>','<?php echo $values['preco']; ?>')"><span>+</span></a>
                                </div></td>

                                <td><br> 
                                    <?php $valor = $values['preco'] * $values['qtd'] ?>
                                    <input id="<?php echo('price'.$values['id']);?>" style="<?php echo $aux;?>" disabled type="text" class="price" value="<?php echo "R$".number_format($valor,2, '.', '')  ?>">                        
                                </td>
                                                    
                                <td id="<?php echo $values['id'];?>"class="text-left">
                                    <form method="post">
                                        <input type="hidden" name = "delete" value= "<?php echo $values['id'] ?>">
                                        <button type = submit  class="button btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>    <br></a>
                                    </form>
                                </td>
                            </tr>  

                            <?php
                                    }
                                    
                                }
                            ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>TOTAL</strong></td>
                                    <?php 
                                        if(isset($_SESSION["produtos"])){
                                            $index = count($produtos);
                                            for($i = 0; $i < $index ; $i++){
                                                $total += $produtos[$i]['preco'] * $produtos[$i]['qtd'];
                                            }
                                        } 
                                    ?>

                                <td class="text-right font-weight-bold"><label id="valorTotalTD"><?php echo "R$".number_format($total,2, '.', '')  ;?></label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <a class="btn btn-lg btn-block btn-secondary text-uppercase" href="index.php">Continue Comprando</a>
                    </div>

                
                    <div class="col-sm-12 col-md-7   text-right float-right" >
                        <button class="btn btn-lg btn-block btn-success text-uppercase">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 copyright mt-3">
        <p class="float-left">
            <a href="#"><center>Voltar ao início</center></a>
        </p>
    </div>                
</div>
    </div>
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Danilo Pereira e Lucas Bragança Website 2019</p>
                <center><a class="nav-link" href="contato.php">Contato</a></center>
            </div>
        </footer>
</body>
</html>