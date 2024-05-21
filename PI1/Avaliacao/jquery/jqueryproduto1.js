


$(document).ready(function(){

	

	$('#botaocomprar').click(function(){

		var quantidade= $("#quantidade");
		var dados={	
	
		'quantidade':$('#quantidade').val(),
		'id':$('#id').val()
		

		};

		 if (quantidade.val() <=0 || quantidade.val()=="" ) {
                	 quantidade.focus();
			$("#msgdiv").text("*Quantidade Inválida");

            	 }else{
			
			$("#msgdiv").text("");
			$.ajax({

			type: "post",
			url:"adicionarcarrinho.php",
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
