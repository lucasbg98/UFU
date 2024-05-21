<?php

   
require_once('validacaoAcesso.php');
    include('conexaoSGBD.php');


    $usuarios_cpf = $_SESSION['cpf'];
   

    $produtos = $_SESSION["produtos"];
    $sql = "SELECT * FROM usuarios where cpf = '$cpf'";
    $result = $conexao->query($sql);


    if($result->num_rows > 0 ){
              
        $_SESSION['cpf'] = $usuarios_cpf;
        $_SESSION['nome'] = $nome['nome'];
        

        $conexao->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);
        $flag=0;

        $now = new DateTime();
        $date = $now->format('Y-m-d H:i:s');  
        $sql = "INSERT INTO compra (valorTot, usuarios_cpf, datetim) VALUES ('".$valorTot."','".$usuarios_cpf."','".$dateTim."')";
        $last_idCompra = $conexao->insert_id;
        foreach($produtos as $values){
            $produtoNome = $values['nome'];
            $prodId = $values['id'];
            $prodQtd = $values['qtd'];
            $sql = "SELECT qtd FROM produto where id = '$prodId' and nome = '$produtoNome'";
            $qtdProdBanco = $conexao->query($sql);
            $qtdFinalProd = $qtdProdBanco - $prodQtd;

            if($qtdFinalProd <=-1){ 
                $conexao->rollback();
                $flag++;
            }else {
                $sql = "UPDATE produto SET qtd='$qtdFinalProd' WHERE id='$prodId'";
                if ($conexao->query($sql)) {
                    $last_idProduto = $conexao->insert_id;
                    $compra_id = $last_idCompra;
                    $produto_id = $last_idProduto;
                    $sql1 = "INSERT INTO produto_has_compra (produto_id, compra_id, qtd, preco) VALUES
                    ('".$produto_id."','".$compra_id."','".$qtd."','".$preco."')"; 
            
                }
                //$conexao->trigger_error($sql);
                $conexao->query($sql);
            }
        }
      
        $conexao->commit();
        $conexao->close();  
        echo "Compra efetuada com sucesso.";
        print_r($produtos);
    }
    else{
        header("HTTP/1.0 400 Bad Request");
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        $msg= "".$produtos;
        echo $msg;
        print_r($produtos);


        }



?>





