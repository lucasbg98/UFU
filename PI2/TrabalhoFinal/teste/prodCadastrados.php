<?php 
    require_once('validacaoAcesso.php');
?>
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
      
    </head>
    <body>
        
            
            <?php 
                include 'navbarMenu.php';
                include 'dropdownLoginAdmin.php';
                          
                include 'conexaoSGBD.php';
                $sql = "SELECT * FROM usuarios where cpf = '$cpf' limit 1";
                $result = $conexao->query($sql);
                $array=$result->fetch_array();
                $_SESSION['nome']=$array['nome'];
                $perfil=$array['perfil_fk'];

                if($perfil != "Administrador")
                    header("login.php");
                
                else {
                    $sql = "SELECT * FROM produto";
                    $rsClientes = $conexao->query($sql);
                    $conexao->close();
                }
           ?>
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
                    ?>
                </tbody>
            </table>
        </form>
        </div>


        </body>

        </html>