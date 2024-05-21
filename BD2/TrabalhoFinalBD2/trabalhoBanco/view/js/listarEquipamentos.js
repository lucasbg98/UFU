$(document).ready(function(){
    $.ajax({
        url: "../controller/controllerListaEquipamento.php",
        dataType: "JSON",
        success:function(data){
            $('.table').show();
            table = '';
            $.each(data,function(index,value){
                table+= '<tr>'
               
                + '<th>' +value.npatrimonio + '</th>'
                + '<th>' +value.nome + '</th>'
                + '<th>' +value.item + '</th>'
                + '<th>' +value.descricao + '</th>'
                + '<th>' +value.processo + '</th>'
                + '<th>' +value.empenho + '</th>'
                + '<th>' +value.empenho_siafi + '</th>'
                + '<th>' +value.local + '</th>'
                + '<th>' +value.observacao + '</th>'
                + '<th>' +'<button id="remover" name="remover"  class="btn btn-danger" >Remover</button>'+'</th>'
                +'</tr>'
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
        var npatrimonio=currentRow.find("th:eq(0)").text();
       
    
        $.ajax({

            type:"POST",
            url: "../controller/controllerDeletaEquipamento.php",
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