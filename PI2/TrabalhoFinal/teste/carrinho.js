$(document).ready(function() {
    const minus = $('.quantity__minus');
    const plus = $('.quantity__plus');
    const input = $('.quantity__input');
    var preco= 0.00;

    minus.click(function(e) {
      
    });
    
    plus.click(function(e) {
     
    })
  });

  function aumentar(codigo,precoUnid){

    var qtd = $("#quantity"+codigo).val();
    qtd++;
    preco = qtd * precoUnid;
    $("#quantity"+codigo).val(qtd);
    $("#price"+codigo).val("R$"+preco.toFixed(2));
    console.log("PREÇO Aumenta:"+preco);
    if(qtd > 0)
      $(".quantity__minus").removeClass("disabled");

    recalculaTotal();
  }

  function diminuir(codigo,precoUnid){
      var qtd = $("#quantity"+codigo).val();
      qtd--;
      preco = qtd * precoUnid;
      $("#quantity"+codigo).val(qtd);
      $("#price"+codigo).val("R$"+preco.toFixed(2));
      console.log("PREÇO Diminui:"+preco);
      if(qtd <= 0)
        $(".quantity__minus").addClass("disabled");

      recalculaTotal();
  }

  function recalculaTotal(){
    var total = 0;
    $("input.price").each(function(){
      var p = $(this).val().substring(2, $(this).val().length);
      p = p.replace(",", "");
      total = parseFloat(total) + parseFloat(p);
    });
    total = total.toFixed(2);
   
    $("#valorTotalTD").html(total);
  }