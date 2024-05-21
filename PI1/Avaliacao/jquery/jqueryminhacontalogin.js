
$(document).ready(function()
    	{

       	$("#entrar").keydown(function () {
           $(".msgdiv").text("");
       	});

        $('#entrar').click(function ()
        {
	   
            var nome = $("#inputnome");
	    var senha=$("#inputsenha");
	    
            if (!nome.val() ) {
                nome.focus();
		$("#msgdivnome").text("*Nome é Obrigatório!");

	    }else if(!senha.val()){
		senha.focus();
		$("#msgdivsenha").text("*A senha é Obrigatório!");

	    }else{

		var dados={

			'nome':$('#inputnome').val(),
			'senha':$('#inputsenha').val()
			
		};


		$.ajax({

			type: "post",
			url:"../Site/login_teste.php",
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

