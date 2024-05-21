
$(document).ready(function(){

	

	$('#comprartudo').click(function(){

		
			var dados={	
	
			'id':$('#id').val()	

			};

            
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
