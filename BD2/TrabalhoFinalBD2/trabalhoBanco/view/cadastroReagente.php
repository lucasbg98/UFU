<!DOCTYPE html>
<html lang="en">

<head>
    <title>CADASTRO REAGENTE</title>
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
            <form class="form-horizontal" action="../controller/controllerCadastroReagente.php" id="meuform" method="post"><br>
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="alinhamentoCentro">CADASTRO DE REAGENTE</div>
                            <div class="panel-body">
                                 <!-- codigo -->
                                 <div class="form-group">
                                    <label class="col-md-2 control-label" for="cod">Código<h11>*</h11></label>  
                                    <div class="col-md-4">
                                    <input id="cod" name="cod" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
                                    </div>
                                </div>
                    
                                 <!-- Nome-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
                                    <div class="col-md-9">
                                        <input id="nome" name="nome" placeholder="Nome do equipamento" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                               
                                <!-- tipo e grupo-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="tipo">Tipo <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="tipo" name="tipo" placeholder=" Tipo" class="form-control input-md" required="" type="text">
                                    </div>
                                    <label class="col-md-1 control-label" for="grupo">Grupo<h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="grupo" name="grupo" placeholder="Grupo" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                
                                  <!--unidade e quantidade-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="unidade">Unidade <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="unidade" name="unidade" placeholder="Unidade" class="form-control input-md" required="" type="text">
                                    </div>
                                    <label class="col-md-1 control-label" for="quant">Quantidade Estoque<h11>*</h11></label>  
                                    <div class="col-md-4">
                                    <input id="quant" name="quantE" placeholder="Apenas números(Ex.:10.5)" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$+.">
                                    </div>
                                    <label class="col-md-7 control-label" for="quant">Quantidade Recipiente<h11>*</h11></label>  
                                    <div class="col-md-4">
                                    <input id="quant" name="quantR" placeholder="Apenas números(Ex.:10.5)" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$+.">
                                    </div>
                                </div>
                                <!-- observação-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="obs">Observação</label>  
                                    <div class="col-md-9">
                                        <input class="form-control" id='obs' name ='obs' type='text' > 
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