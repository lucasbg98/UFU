$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaLaboratorio.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                table+= '<tr>'
                + '<th>' +value.cod + '</th>'
                + '<th>' +'<button id="remover" name="remover"  class="btn btn-danger" >Remover</button>'+'</th>'
                + '</tr>'
                ;
            });
            $('.table tbody').html(table);
        },
        error:function(responseData){
            alert("Erro de resposta");
        }
    });


    $(".table").on('click','.btn',function(){

        var currentRow=$(this).closest("tr");
        var codL =currentRow.find("th:eq(0)").text();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerDeletaLaboratorio.php",
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