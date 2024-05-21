#include <stdio.h>
#include <string.h>

int palavra(char vet[50]){
	
	int x = 1;
	
	for(int i = 0; i < 50 ; i++){
		if(vet[i] == ' ')
			x++;
	}
	
return x;
}

int main(){
	
	char vet[50];
	int x;
	
	printf("Insira uma palavra/frase:\n");
	gets(vet);
	
	x = palavra(vet);
	
	printf("Existem %d palavras nesta frase\n", x);
	
return 0;
}
