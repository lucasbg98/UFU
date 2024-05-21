
$(document).ready(function()
    	{

       	$("#botaosalvar").keydown(function () {
           $(".msgdiv").text("");
       	});

        $('#botaosalvar').click(function ()
        {
	    var email= $("#inputemail");
            var nome = $("#inputnome");
            var sobrenome= $("#inputsobrenome");
	    var cpf= $("#inputcpf");
	    var data= $("#inputdata");
	    var sexo= $("#inputsexo");
	    var telefone=$("#inputtelefone");
	    var senha=$("#inputsenha");
	    var confirmarsenha=$("#inputconfirmarsenha");
	  


            if (!nome.val() || nome.val().indexOf(" ")!=-1 ) {
                nome.focus();
		$("#msgdiv").text("Nome Inválido!");

            }else if(!sobrenome.val()){

		sobrenome.focus();
		$("#msgdiv").text("Sobrenome é Obrigatório!");

	   }else if(!cpf.val() ||  cpf.val().length <=10 || cpf.val().indexOf(" ")!=-1){

		cpf.focus();
		$("#msgdiv").text("Cpf Inválido!");

	   }else if(!data.val()){

		data.focus();
		$("#msgdiv").text("Data de nascimento é Inválida!");

	   }else if(!sexo.val() || sexo.val().toUpperCase()!="MASCULINO" && sexo.val().toUpperCase()!="FEMININO" 
		    || sexo.val().indexOf(" ")!=-1){

		sexo.focus();
		$("#msgdiv").text("Sexo é Inválido!");

	   }else if(!telefone.val() || telefone.val().length < 8 || telefone.val().length > 8 ){

		telefone.focus();
		$("#msgdiv").text("Telefone é Inválido!");

	   }else if(!senha.val() || senha.val().length >20){

		senha.focus();
		$("#msgdiv").text("Senha Inválida!");

	   }else if(!confirmarsenha.val() || senha.val() != confirmarsenha.val() ){

		$("#msgdiv").text("Confirmação da senha inválida!");
		confirmarsenha.focus();

	   }else if(!email.val() || email.val().indexOf("@")==-1 || email.val().indexOf('.')==-1){

		$("#msgdiv").text("Email Inválido!");
		email.focus();

	   }else{


		var dados={

			'nome':$('#inputnome').val(),
			'sobrenome':$('#inputsobrenome').val(),
			'email':$('#inputemail').val(),
			'data':$('#inputdata').val(),
			'senha':$('#inputsenha').val(),
			'confirmarsenha':$('#inputconfirmarsenha').val(),
			'cpf':$('#inputcpf').val(),
			'telefone':$('#inputtelefone').val(),
			'sexo':$('#inputsexo').val()
		};


		$.ajax({

			type: "post",
			url:"cadastrar.php",
			data: dados,

			success: function(responseData){
                        $("#msgdiv").html(""+responseData);

      	                },

                        error: function(request,status,error){
                        $("#msgdiv").html("Erro!"+request.responseText);
                        }

		});





	}
	
	   

	});

});




/*

$(function() {

		$("#botaosalvar").click(function(event){

		var dados={

			'nome':$('#inputnome').val(),
			'sobrenome':$('#inputsobrenome').val(),
			'email':$('#inputemail').val(),
			'data':$('#inputdata').val(),
			'senha':$('#inputsenha').val(),
			'confirmarsenha':$('#inputconfirmarsenha').val(),
			'cpf':$('#inputcpf').val(),
			'telefone':$('#inputtelefone').val(),
			'sexo':$('#inputsexo').val()
		};


		$.ajax({

			type: "post",
			url:"cadastrar.php",
			data: dados,

			success: function(responseData){
                        $("#msgdiv").html(""+responseData);

      	                },

                        error: function(request,status,error){
                        $("#msgdiv").html("Erro!"+request.responseText);
                        }

		});
	});
   });
*/
