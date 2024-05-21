#include <stdio.h>
#include <stdlib.h>
#include "listaD.h"

/*struct Node{
	int num;
	struct Node *prox;
}; */

//typedef struct Node node;

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para comparar as listas                      |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void compara(node *lista1, node *lista2, int *c1, int *c2){
	
	*c1 = 0;
	*c2 = 0;
	
	while(lista1->prox != NULL){
		*c1 = *c1 +1;
		lista1 = lista1->prox;
	}
	while(lista2->prox != NULL){
		*c2 = *c2+1;
		lista2 = lista2->prox;
	}
	;
		

}
	
int main(){
	
	int c1 , c2 , op, x, y;
	node *lista1 = (node *) malloc(sizeof(node));
	node *lista2 = (node *) malloc(sizeof(node));
	
	inicia(lista1);
	inicia(lista2);
	
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
					printf("Em qual lista deseja inserir? Digite 1 para a primeira lista e 2 para a segunda\n");
					scanf("%d", &x);
					while(x != 1 && x!= 2){
						printf("Valor invalido, digite um numero valido\n");
						scanf("%d", &x);
					}
					printf("Digite o numero que deseja inserir:\n");
					scanf("%d", &y);
					if(x == 1)
						insereI(lista1, y);
					else if(x == 2)
						insereI(lista2, y);
						
					printf("Numero inserido com sucesso!\n");
			break;
			case 2:
					compara(lista1, lista2, &c1, &c2);
					
					printf("A lista 1 possui %d elementos\n", c1);
					printf("A lista 2 possui %d elementos\n", c2);
					
					if(c1 > c2)
						printf("A lista 1 eh maior que a lista 2\n");
					else if(c1 < c2)
						printf("A lista 2 eh maior que a lista 1\n");
					else if(c1 == c2)
						printf("Ambas listas sao iguais\n");
			break;
		}
	}
return 0;
}






