<!DOCTYPE html>
<html lang="en">

<head>
    <title>CADASTRO EQUIPAMENTO</title>
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
            <form class="form-horizontal" id="meuform" action="../controller/controllerCadastroEquipamento.php" method="post"><br>
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="alinhamentoCentro">CADASTRO DE EQUIPAMENTO</div>
                            <div class="panel-body">

                                <!-- codigo -->
                                <div class="form-group"  method="POST">
                                    <label class="col-md-2 control-label" for="cod">Código<h11>*</h11></label>  
                                    <div class="col-md-4">
                                    <input id="cod" name="npatrimonio" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
                                    </div>
                                </div>
                                 <!-- Item equipamento-->
                                 <div class="form-group">
                                    <label class="col-md-2 control-label" for="item">Item <h11>*</h11></label>  
                                    <div class="col-md-9">
                                        <input id="item" name="item" placeholder="Item" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                  
                                 <!-- Nome equipamento-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
                                    <div class="col-md-9">
                                        <input id="nome" name="nome" placeholder="Nome do equipamento" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <!-- descrição-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="descricao">Descrição <h11>*</h11></label>  
                                    <div class="col-md-9">
                                        <input id="descricao" name="descricao" placeholder="Descreva o equipamento" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <!-- processo e local-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="processo">Processo <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="processo" name="processo" placeholder=" Número do processo" class="form-control input-md" required="" type="text">
                                    </div>
                                    <label class="col-md-1 control-label" for="local">Local <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="local" name="local" placeholder="Local" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <!-- empenho e empenho SIAFE-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="empenho">Empenho <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="empenho" name="empenho" placeholder="Empenho" class="form-control input-md" required="" type="text">
                                    </div>
                                    <label class="col-md-1 control-label" for="siafi">Empenho SIAFI <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="siafi" name="siafi" placeholder="Empenho SIAFI" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <!-- observação-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="obs">Observação</label>  
                                    <div class="col-md-9">
                                        <input class="form-control" id='obs' name ='observacao' type='text' > 
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