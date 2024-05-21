			
function valNome()
{
    var campo = document.forms["Form2"]["login"];
	var aux = campo.value.indexOf(" ");
	var a='A';
	var b='Z';
	var c='a';
	var d='z';

	if(campo.value >= a && campo.value <= b || campo.value >= c && campo.value <= d) {
		if(aux == -1){
            campo.style.border = "solid 3px lightcoral";
            alert("Invalid name");
			return false;
		}
		else if(number(campo.value.charAt(aux +1)) == false) {
            campo.style.border = "solid 3px lightcoral";
            alert("Invalid name");
            return false;
		}
		else if(campo.value.length < 6 ){
            campo.style.border = "solid 3px lightcoral";
            alert("invalid name");
			return false;
		} 
		else {
			campo.style.border = "solid 1px #b3aca7";	
			return true;
		}	
	}
	else {
        campo.style.border = "solid 3px lightcoral";
        alert("Invalid name");
		return false;
	}	
}

function valCpf()
{
	var campo = document.forms["Form2"]["CPF"];

	if(campo.value.length != 14){
        campo.style.border = "solid 3px lightcoral";
        alert("invalid cpf");
		return false;
	}
	else{
		campo.style.border = "solid 1px #b3aca7";
		return true;
	}
}

function valSenha()
{
	var campo = document.forms["Form2"]["senha"];

	if(campo.value.length < 4){
        campo.style.border = "solid 3px lightcoral";
        alert("A senha precisa ser maior do que 3 digitos");
		return false;
	}
	else{
		campo.style.border = "solid 1px #b3aca7";
		return true;
	}

}

function valEmail(){

	var email = document.forms["Form2"]["email"];

	if(!email.value || email.value.indexOf("@")==-1 || email.value.indexOf('.')==-1){
		email.style.border = "solid 3px lightcoral";
		alert("invalid email");
		return false;
	}
	else{
		return true;
	}

}

function valCEP(){
    
	var cep = document.forms["Form2"]["CEP"];
	   if (cep.value.length == 0){
		cep.style.border = "solid 3px lightcoral";
		return false;            
	};
	if (cep.value.length == 8) {
	   return true;
			              
	}
	else {
		cep.style.border = "solid 3px lightcoral";        
	   alert('CEP Incorreto!');                   
	   return false;
   };
	
};

function verifSenha(){
	var x = document.forms["Form2"]["senha"];
    var y = document.forms["Form2"]["senha2"];

    if(y.value != x.value || !y.value){
		y.style.border = "solid 3px lightcoral";
        alert("invalid confirmation password");
		return false;
    }
    else{
		y.style.border = "solid 1px #b3aca7";
		return true;
    }
}

function loadFileAsText()
{
   var fileToLoad = document.getElementById("fileToLoad").files[0];
   var fileReader = new FileReader();
   fileReader.onload = function(fileLoadedEvent) 
   {
      var textFromFileLoaded = fileLoadedEvent.target.result;
      var texto = textFromFileLoaded;
      listar(texto);
   };

   fileReader.readAsText(fileToLoad, "UTF-8");
}

function listar(texto){

	var itens = texto.split('[usuario]');
	for(var i=1;i<itens.length;i++){
      var valores = itens[i].split("|");
		
		$(document).ready(function(){

	        $("ol").append("<li><a>[usuario]|"+valores[1]+"|"+valores[2]+"|"+valores[3]+"</a></li>");
	        
		});
   }
}

function saveTextAsFile()
{
 
	var aux = "[usuario]|";
    var textToSave = aux.concat(document.getElementById("Login").value);

    aux = "|";
    aux = aux.concat(document.getElementById("Senha").value);
    textToSave = textToSave.concat(aux);

    aux = "|";
    aux = aux.concat(document.getElementById("Email").value);
    textToSave = textToSave.concat(aux);

    aux = "|";
    aux = aux.concat(document.getElementById("cpf").value);
    textToSave = textToSave.concat(aux);

    aux = "|";
    aux = aux.concat(document.getElementById("cep").value);
    textToSave = textToSave.concat(aux);

    alert(textToSave);

    var textToSaveAsBlob = new Blob([textToSave], {type:"text/plain"});
    var textToSaveAsURL = window.URL.createObjectURL(textToSaveAsBlob);
    var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;
 
    var downloadLink = document.createElement("a");
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = "Download File";
    downloadLink.href = textToSaveAsURL;
    downloadLink.onclick = destroyClickedElement;
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
 
    downloadLink.click();
}

function destroyClickedElement(event)
{
    document.body.removeChild(event.target);
}


function salvar()
{
	var itens = document.getElementById("lista1").getElementsByTagName('a');
	var str = "<li><a>" +itens[0].innerHTML + "</a></li>";


	for(i=1; i<itens.length; i++)
	{
		str = str.concat("<li><a>"+itens[i].innerHTML + "</a></li>");

	}

	var textToSave = "";
	textToSave = textToSave.concat(str);
	alert(textToSave);

	var textToSaveAsBlob = new Blob([textToSave], {type:"text/plain"});
    var textToSaveAsURL = window.URL.createObjectURL(textToSaveAsBlob);
    var fileNameToSaveAs = document.getElementById("nomearquivo").value;
 
    var downloadLink = document.createElement("a");
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = "Download File";
    downloadLink.href = textToSaveAsURL;
    downloadLink.onclick = destroyClickedElement;
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
 
    downloadLink.click();
}
