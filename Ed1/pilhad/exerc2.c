#include <stdio.h>
#include <stdlib.h>
#include "pilhad2.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor na pilha 1            |\n");
    printf("|    2 para adcionar um valor na pilha 2            |\n");
    printf("|    3 para excluir um valor na pilha 1             |\n");
    printf("|    4 para excluir um valor na pilha 2             |\n");
    printf("|    5 para exibir os valores das pilhas            |\n");
    printf("|    6 para comparar as pilhas                      |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int compare(node *pilha, node *pilha2){
	
	int z, x, y;
	x = count(pilha);
	y = count(pilha2);
	
	node *tmp, *tmp2;
	
	if(empty(pilha) == 1 || empty(pilha2) == 1){
		printf("Uma das pilhas se encontra vazia, impossivel fazer a comparacao\n");
		return 3;
	}else{
		
		if(y == x){
		tmp = pilha->prox;
		tmp2 = pilha2->prox;
		
		while(tmp->prox != NULL){
			if(tmp->num != tmp2->num){
				z = 0;
				break;
			}else{
				tmp = tmp->prox;
				tmp2 = tmp2->prox;
				z  = 1;
				}
			}
		}
		else
			z = 0;
	}	
return z;
}

int main(){
	
	node *pilha = (node *) malloc(sizeof(node));
	node *pilha2 = (node *) malloc(sizeof(node));
	if(!pilha || !pilha2){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(pilha2);
		inicia(pilha);
		int op, x, y, p, w, t;
		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
					printf("Insira o numero que deseja adcionar na pilha 1\n");
					scanf("%d", &x);
					push(pilha, x);	
					printf("O numero foi adcionado!\n");
				break;
				case 2:
					printf("Insira o numero que deseja adcionar na pilha 2\n");
					scanf("%d", &t);
					push(pilha2, t);	
					printf("O numero foi adcionado!\n");
				break;
				case 3:
					pop(pilha);
					printf("O numero foi excluido!\n");
				break;
				case 4:
					pop(pilha2);
					printf("O numero foi excluido!\n");
				break;
				case 5:
					y = count(pilha);
					printf("Existem %d elementos cadastrados na pilha 1\n", y);
					show(pilha);
					printf("\n");
					p = count(pilha2);
					printf("Existem %d elementos cadastrados na pilha 2\n", p);
					show(pilha2);
				break;
				case 6:
					w = compare(pilha, pilha2);
					if(w == 1)
						printf("As pilhas sao iguais\n");
					else if(w == 0)
						printf("As pilhas sao diferentes\n");
				break;
				default:
					printf("Operacao invalida!\n");
			}
		}
	}
	return 0;
}		
				
				
		
