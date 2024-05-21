$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaMaterial.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                table+= '<tr>'
                + '<th>' +value.cod + '</th>'
                + '<th>' +value.nome + '</th>'
                + '<th>' +value.item + '</th>'
                + '<th>' +value.tipo + '</th>'
                + '<th>' +value.descricao + '</th>'
                + '<th>' +value.unidade + '</th>'
                + '<th>' +value.empenho + '</th>'
                + '<th>' +value.empenho_siafi + '</th>'
                + '<th>' +value.local + '</th>'
                + '<th>' +value.danificado_descartado + '</th>'
                + '<th>' +value.estoque + '</th>'
                + '<th>' +value.observacao + '</th>'
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
        var codM =currentRow.find("th:eq(0)").text();
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerDeletaMaterial.php",
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