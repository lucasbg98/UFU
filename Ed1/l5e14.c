#include <stdio.h>
#include <string.h>

void dobra(char vet[], char vet2[], char vet3[]){
	
	int count = 0, x = strlen(vet);
	
	for(int i = 0; i < strlen(vet); i++){
		vet2[i] = vet[i];
	}
	for(int i = 0; i < strlen(vet); i++){
		if(vet[i] != ' ' && i+1 < x){
			vet3[count] = vet[i];
			count++;
		}
		
		else if (vet[i] == ' '){
			int aux = 1;
			vet3[count] = ' ';
			for(int j = count - i; j < count ; j++){
				vet3[count+aux] = vet2[j];
				aux++;
			}
			count = count + aux;
			vet3[count] = ' ';
			count++;
		}
		else if(i+1 == x){
			vet3[count] = vet[i];
			count++;
			int aux = 1;
			vet3[count] = ' ';
			for(int j = (count-1) - i; j < count ; j++){
				vet3[count+aux] = vet2[j];
				aux++;
			}
			count = count + aux;
			vet3[count] = ' ';
			count++;
		}
			
	}
}

int main(){
	
	char vet[50], vet2[50], vet3[strlen(vet) * 2];
	
	gets(vet);
	dobra(vet, vet2, vet3);
	
	printf("%s", vet3);
	
return 0;
}	
	

