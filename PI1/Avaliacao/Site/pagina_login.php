<html lang="br">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link  rel="stylesheet"  type="text/css" href="../css/style_login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<script type="text/javascript">

$(function(){
                $("#formlogin").submit(function(event) {

                event.preventDefault();//cancela a execucao padrao do submit

                var dados_form=$(this).serialize();


                $.ajax({

                      type: "post",
                      url: "login_teste.php",
                      data: dados_form,
                      success: function(responseData){

			$("#msgerror").html(""+responseData);

                      },

                      error: function(request,status,error){

                        $("#msgerror").html("Usuario ou senha incorretos<br/>"+error);
                     }

                    });
                });

	    });

</script>

<body>


	<div class="caixa_interna">

		 <div class="titulo">
			 <label>Login</label>
		 </div>

		<div id="msgerror"></div>

		<form id="formlogin"action="login_teste.php" method="POST" >

			<input type="text" name="nome" placeholder="Nome do usuário"></input>
			<input type="password" name="senha" placeholder="Senha"></input>

			<input id="botao_entrar" type="submit" value="Entrar"></input>


		</form>

	</div>

</body>



</html>
