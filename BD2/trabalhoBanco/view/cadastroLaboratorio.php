<!DOCTYPE html>
<html lang="en">

<head>
    <title>CADASTRO DE USUÁRIO</title>
    <meta charset="utf-8">
    <!--link dos botstrap para a barra de menu responsivel-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- link das pastas para a eslilizacao do site-->
    <link rel="stylesheet" href="../css/cadastro_css.css">
    <script type="text/javascript" src="java/javascript.js"></script>
</head>

<body>
    <!--parte do menu com as opcoes -->
    <?php
    include_once("navebarTecnico.php");
    ?>
    <!--conteudo da pagina --> 
    <div class="container">
        <div class="coluna col15">
            <form class="form-horizontal" id="meuform" action="../controller/controllerCadastroLaboratorio.php" method="post"><br>
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="alinhamentoCentro">CADASTRO DE LABORATÓRIO</div>
                            <div class="panel-body">
                                <!-- codigo -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="cod">Código<h11>*</h11></label>  
                                    <div class="col-md-4">
                                    <input id="cod" name="cod" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
                                    </div>
                                </div>
                                 
                                 <!-- botoes cadastrar ou cancelar-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Cadastrar"></label>
                                    <div class="col-md-8">
                                        <button id="Cadastrar" name="Cadastrar" class="btn btn-success" type="Submit">Cadastrar</button>
                                        <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
                                        <div id="mensagemDiv"><h5 style ="color: red;"></h5></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <br><br>
</body>
</html>