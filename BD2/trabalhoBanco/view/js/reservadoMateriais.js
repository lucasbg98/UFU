$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaMaterial.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                if(value.reservado != 0){
                table+= '<tr>'
                + '<th>' +value.cod + '</th>'
                + '<th>' +value.nome + '</th>'
                +'<th>' +value.reservado+ '</th>'
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
        var codM =currentRow.find("th:eq(0)").text();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerReservadoMaterial.php",
            dataType: "JSON",
            data:{
                
                'codM': codM
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