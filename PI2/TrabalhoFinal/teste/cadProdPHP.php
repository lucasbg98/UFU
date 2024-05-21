<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="images/favicon.ico"/>
  <title>Cadastro Produto</title>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/jquery.min.js"></script>
 
</head>

<body>
  <?php
    session_start();

    if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha']))
      header('location: login.php');
    include('conexaoSGBD.php');

    if($conexao){

      $nome = $_POST["nome"];
      $preco = $_POST["preco"];
      $qtd = $_POST["qtd"];
      $descricao = $_POST["descricao"];
      $categoria_fk = $_POST["categoria"];
      
      if(isset($_FILES['img'])){
        $extensao = strtolower(substr($_FILES['img']['name'],-4));
        $tmp_name = basename($_FILES['img']['tmp_name']);
        $diretorio = "images/";
        $img = null;
      }
      $sql = "INSERT INTO produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES
        ('".$nome."','".$preco."','".$qtd."','".$descricao."','".$img."','".$categoria_fk."')"; 

      if ($conexao->query($sql)) {
        $last_id = $conexao->insert_id;
        $img = $last_id.$extensao;
        $sucesso = "UPDATE produto SET img='$img' WHERE id=$last_id";
        if($conexao->query($sucesso)) 
        copy($_FILES['img']['tmp_name'], $diretorio.$img);
        header('location: cadProd.php');
        $_SESSION['cadsucesso'] = 10;
        echo "Nova tupla inserida com sucesso!";
        
      } else if(!$conexao->query("SET a=1")==1062){
          header('location: cadProd.php');
          $_SESSION['cadsucesso'] = 20;
          die();
      }else 
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }else 
        echo "Ops, deu erro!";
    $conexao->close();
  ?>
</body>
</html>