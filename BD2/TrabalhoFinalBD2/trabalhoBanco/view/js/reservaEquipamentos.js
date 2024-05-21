$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaEquipamento.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                if(value.reservado == 0){
                table+= '<tr>'
                + '<th>' +value.npatrimonio + '</th>'
                + '<th>' +value.nome + '</th>'
                +'<th>'+'<input id="cod" name="cod" placeholder="Insira o cod do professor/aluno" class="form-control input-md" required="" type="text">' + '</th>'
                +'<th>'+'<input id="npatrimonio" name="npatrimonio" value= '+value.npatrimonio+' type="hidden">' + '</th>'
                + '<th>' +'<button id="reservar" name="reservar"  class="btn btn-success" >Reservar</button>'+'</th>'
                
                ;
                }
            });
            $('.table tbody').html(table);
        },
        error:function(responseData){
            alert("Erro de resposta");
        }


    });


    $(".table").on('click','.btn',function(){

        var currentRow=$(this).closest("tr");
        var npatrimonio=currentRow.find("th:eq(0)").text();
       
        var cod = currentRow.find("th:eq(2) input[type='text']").val();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerReservaEquipamento.php",
            dataType: "JSON",
            data:{
                
                'cod':cod,
                'npatrimonio': npatrimonio
            },
            
            success:function(data){

                    currentRow.find("th").remove();
                    alert("Reservado!");
               
            },
            error:function(responseData){
                alert("Erro de resposta");
            }
        


        });
    });



});