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
            <form class="form-horizontal" id="meuform" action="../controller/controllerCadastroUsuario.php" method="post"><br>
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="alinhamentoCentro">CADASTRO DE USUÁRIO</div>
                            <div class="panel-body">
                                <!-- Tipo de usuario -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="tipo">Tipo de Usuário <h11>*</h11></label>  
                                    <div class="col-md-2">
                                        <select id="tipo" name="tipo" class="form-control input-md" required="">
                                            <option value = "professor" >Professor</option>
                                            <option value = "aluno" >Aluno</option>
                                        </select>
                                    </div>
                                </div>
                                 <!-- Código usuario -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Cod"> Código <h11>*</h11></label>  
                                    <div class="col-md-2">
                                        <input id="cod" name="cod" placeholder="Apenas Números" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <!-- Nome usuario -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
                                    <div class="col-md-8">
                                        <input id="nome" name="nome" placeholder="" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                 <!-- Senha usuario-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="Senha"> Senha <h11>*</h11></label>  
                                    <div class="col-md-4">
                                        <input id="senha" name="senha" placeholder="" class="form-control input-md" required="" type="password">
                                    </div>
                                </div>
                                 <!-- email do usuario-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="prependedtext">Email Institucional <h11>*</h11></label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                            <input id="email" name="email" class="form-control" placeholder="email@ufu.br" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                                        </div>
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