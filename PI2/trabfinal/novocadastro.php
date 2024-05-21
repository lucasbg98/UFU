<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Novo cadastro</title>

  
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/shop-homepage.css" rel="stylesheet">
  <!--<style>
    *{
      max-width:100% !important; 
    }
  </style>-->
  <?php
          
    session_start(); 
    //session_destroy();
    
  ?>
</head>

<body>

<div class="container">

   <h2>Cadastro Usuário</h2>
   <div class="row col-xs-3 col-sm-3 col-md-9 col-lg-9">
  <form action="novocadastroPHP.php" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">CPF</label>
      
      <input type="text" class="form-control" id="exampleInputEmail1"  required name ="cpf"  placeholder="Digite o CPF">
      
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Nome    </label>
      <input type="text" class="form-control" id="exampleInputEmail1" required name ="nome"   placeholder="Digite o Nome">
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" required name ="senha" placeholder="Digite a senha">
    </div>


    <?php
            

            if(isset($_POST["cpf"])){
             
                  //$cpf = $_POST["cpf"];
                  
                  
                  
                  
                  //$rsClientes = mysqli_query($conexao, "SELECT * FROM usuarios where 'cpf' =  $cpf");//faz a consulta na linha de cima e recebe a tabela com a qtd ocorrencias.
                  //$rowcount=mysqli_num_rows($rsClientes);// Nesta linha pega a tabela e verifica quantas linhas ocorreu a igualdade do cpf digitado com o banco

                  if($rowcount==0){
             
                    $novo = array('cpf' => $_POST['cpf'],'nome'=> $_POST['nome'],'senha'=> $_POST['senha'], );
                    if(isset($_SESSION["usuarios"])){
                      
                      $usuarios = $_SESSION["usuarios"];
                      array_push($usuarios, $novo);
                    }else{
                    $usuarios =  array($novo);

                  }
                  $_SESSION["usuarios"] = $usuarios;
                }else {
                    echo "CPF ja existe";
                }
              }
            
          ?>
    
    <input type="submit" class="btn btn-primary float-right" value="Cadastrar">
    </div>
  </form>
  </div>






</body>


</html>