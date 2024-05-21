function validate(){

	var login = document.forms["Form2"]["login"].value;
	var senha = document.forms["Form2"]["senha"].value;
	var email = document.forms["Form2"]["email"].value;
	var senha2;

	if(login == "" || login.indexOf("") == -1){

		alert("Campo 'Usuário' não preenchido");
		return false;

	}



}