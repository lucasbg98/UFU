#include <stdio.h>
#include <string.h>
#include "pilhae.h"

void inverte(char *vet, int *topo){
	
	char aux[30], j;
	int i, a=0, *pt;
	pt = &a;
	
	for(i = 0; i <= *topo; i++){
		if(vet[i] == ' '|| i == *topo){
			int *pt2;
			int h = i;
			pt2 = &h;
			while(a < i){
				j = pop(vet, pt2);
				push(aux, j, pt);
			}
			aux[a] = ' ';
			a++; 
		}
	}
		aux[*topo+1] = '\0';
		printf("%s", aux);
	}

	

int main(){
	
	char vet[30];
	printf("Insira a frase que deseja inverter: \n");
	gets(vet);
	int topo = strlen(vet);
	int *pt;
	pt = &topo;
	inverte(vet, pt);
	
	
return 0;
}

