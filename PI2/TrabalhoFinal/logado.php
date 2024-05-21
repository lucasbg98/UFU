<!DOCTYPE html>
<html>
    <head>
        <title>Bem vindo!</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">  
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
        <script src="js/jquery.tabledit.js"></script>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    
    
        <?php
            session_start();
            //  session_destroy();
                    
            if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha']))
                header('location: login.php');
            else {
                $cpf = $_SESSION['cpf'];
                //$nome = $_SESSION['nome'];
                //echo"<script type='text/javascript'>alert($cpf);</script>";


                $conexao = mysqli_connect ("localhost", "root", "lbg122010", "trabfinal", 3306);
                
                $result = mysqli_query($conexao, "SELECT perfil_fk FROM usuarios where cpf = '$cpf'");
                $perfil=$result->fetch_array();
                $perfil=$perfil['perfil_fk'];
            
                 
            }
        ?>
    </head>
  
            
    <body onload="viewData()">
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
                            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bem vindo,
                                <?php echo $_SESSION['nome'];?>
                            </a>
                            <div class="dropdown-menu active" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="logado.php">Home login</a>


                                <?php
                                    if($perfil == "Administrador" || $perfil == "Gerente"){
                                        ?>

                                        <a class="dropdown-item" href="cadProd.php">Cadastrar Produto</a>
                                        <a class="dropdown-item" href="prodCadastrados.php">Produtos Cadastrados</a>
                                    <?php } ?>
                                <div class="dropdown-divider"></div>
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
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>

        <?php
            if($perfil == "Administrador" || $perfil == "Gerente"){
            ?>
        <div class="container">
            <h1><center>Usuários Cadastrados<center></h1>
            <table id="tabledit" class = "table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Perfil</th>
                        <th>Senha</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>        
        </div>

        <script type="text/javascript">
            
            
            function viewData(){
                $.ajax({
                    url: 'userCadastrados.php?p=view',
                    method: 'GET'
                }).done(function(data){
                    $('tbody').html(data)
                    tableData()
                })
            }
            function tableData(){
                $('#tabledit').Tabledit({
                    url: 'userCadastrados.php',
                    eventType: 'dbclick',
                    ediButton: true,
                    deleteButton: true,
                    //hideIndentifier: false,
                    /*\\buttons: {
                        edit: {
                            class: 'btn btn-sm btn-warning',
                            html: '<span class="glyphicon glyphicon-pencil">Edit</span> Editar',
                            action: 'edit'
                        },
                        delete: {
                            class: 'btn btn-sm btn-danger',
                            html: '<span class="glyphicon glyphicon-trash"></span> Excluir',
                            action: 'delete'
                        },
                        save: {
                            class: 'btn btn-sm btn-success',
                            html: 'Save'
                        },
                        restore: {
                            class: 'btn btn-sm btn-warning',
                            html: 'Restore',
                            action: 'restore'
                        },
                        confirm: {
                            class: 'btn btn-sm btn-default',
                            html: 'Confirm'
                        }
                    }*/
                    columns: {
                        identifier: [0, 'cpf'],
                        editable: [[1, 'nome'], [2, 'perfil_fk'], [3, 'senha']]
                    },
                    onSuccess: function(data, textStatus, jqXHR) {
                        console.log('onSuccess(data, textStatus, jqXHR)');
                        console.log(data);
                        console.log(textStatus);
                        console.log(jqXHR);
                    },
                    onFail: function(jqXHR, textStatus, errorThrown) {
                        console.log('onFail(jqXHR, textStatus, errorThrown)');
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    },
                    onAjax: function(action, serialize) {
                        console.log('onAjax(action, serialize)');
                        console.log(action);
                        console.log(serialize);
                    }
                });
            }
        </script>
        <?php }?>
        
    </body>

</html>