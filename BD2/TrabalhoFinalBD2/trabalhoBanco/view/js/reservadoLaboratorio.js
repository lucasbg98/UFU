$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaLaboratorio.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                if(value.reservado != 0){
                table+= '<tr>'
                + '<th>' +value.cod + '</th>'
                +'<th>'+value.reservado+ '</th>'
                +'<th>'+'<input id="npatrimonio" name="npatrimonio" value= '+value.cod+' type="hidden">' + '</th>'
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
        var codL=currentRow.find("th:eq(0)").text();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerReservadoLaboratorio.php",
            dataType: "JSON",
            data:{
                
                'codL': codL
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