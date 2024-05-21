$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaLaboratorio.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                if(value.reservado == 0){
                table+= '<tr>'
                + '<th>' +value.cod + '</th>'
                +'<th>'+'<input id="cod" name="cod" placeholder="Insira o cod do professor/aluno" class="form-control input-md" required="" type="text">' + '</th>'
                +'<th>'+'<input id="npatrimonio" name="npatrimonio" value= '+value.cod+' type="hidden">' + '</th>'
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
        var codL=currentRow.find("th:eq(0)").text();
       
        var cod = currentRow.find("th:eq(1) input[type='text']").val();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerReservaLaboratorio.php",
            dataType: "JSON",
            data:{
                
                'cod':cod,
                'codL': codL
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