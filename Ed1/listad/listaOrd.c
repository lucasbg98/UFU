#include <stdio.h>
#include <stdlib.h>
#include "listaD.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void ordena(node *lista, int x){
	
	node *ord = (node *) malloc(sizeof(node));
	inicia(ord);
	
	ord->num = x;
	if(empty(lista) == 1){
		lista->prox = ord;
	}
	else if(empty(lista) == 0){
		node *ult, *tmp2, *aux, *tmp;
		ult = lista->prox;
		tmp = lista->prox;
		tmp2 = lista->prox;
		
		while(ult->prox != NULL){
			ult = ult->prox;
		}
		if(x < tmp->num){
			insereI(lista, x);
		}
		else if(x > ult->num){
			insereF(lista, x);
		}
		else{
			while(tmp2->num < x){
				aux = tmp2;
				tmp2 = tmp2->prox;
			}
			
			aux->prox = ord;
			ord->prox = tmp2;
			
		}
	}
}

int main(){
	
	node *lista = (node *) malloc(sizeof(node));
	if(!lista){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(lista);
		int op, x, t;
		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
					printf("Insira o numero que deseja adcionar na lista\n");
					scanf("%d", &x);
					ordena(lista, x);
					printf("O numero foi adcionado!\n");
				break;
				case 2:
					printf("Insira o valor que deseja excluir:\n");
					scanf("%d", &t);
					removerE(lista, t);
				break;
				case 3:
					show(lista);
				break;
				default:
					printf("Operacao invalida\n");
				}
			}
		}
return 0;
}
					
				
			
			
		
