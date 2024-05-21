function mostrar(categoria){

	$("form").show();
	$("form").not("[name='cat_" + categoria + "']").hide();

}