<?php 
    require_once('validacaoAcesso.php');
?>

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
            
            include('conexaoSGBD.php');
            $sql = "SELECT * FROM usuarios where cpf = '$cpf'";
            $result = $conexao->query($sql);
            $array=$result->fetch_array();
            $perfil=$array['perfil_fk'];             
            $_SESSION['nome']=$array['nome'];
            $conexao->close();
        ?>
    </head>
  
            
    <body onload="viewData()">
        
        <?php 
            include 'navbarMenu.php';

            
            if($perfil == "Administrador")
                include 'dropdownLoginAdmin.php';
            else
                include 'dropdownLoginUser.php';
    
            
        ?>
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
        <?php }
          
        ?>
        
    </body>

</html>