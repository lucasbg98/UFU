$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaEquipamento.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                if(value.reservado != 0){
                table+= '<tr>'
                + '<th>' +value.npatrimonio + '</th>'
                + '<th>' +value.nome + '</th>'
                +'<th>'+value.reservado+ '</th>'
                +'<th>'+'<input id="npatrimonio" name="npatrimonio" value= '+value.npatrimonio+' type="hidden">' + '</th>'
                + '<th>' +'<button id="reservar" name="reservar"  class="btn btn-danger" >Remover</button>'+'</th>'
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
       
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerReservadoEquipamento.php",
            dataType: "JSON",
            data:{
                
                'npatrimonio': npatrimonio
            },
            
            success:function(data){

                    currentRow.find("th").remove();
                    alert("Removido!");
               
            },
            error:function(responseData){
                alert("Erro de resposta");
            }
        


        });
    });



});