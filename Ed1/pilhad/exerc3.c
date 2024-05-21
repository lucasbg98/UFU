#include <stdio.h>
#include <stdlib.h>
#include "pilhad2.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para resolver a pilha                        |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void ordena(node *pilha){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	node *pilha2 = (node *) malloc(sizeof(node));
	inicia(pilha2);
	
	int z, ord=0, x, k, y;
	
	if(empty(pilha) == 1){
		printf("Pilha Vazia!\n");
		return;
	}else{
		
		x = count(pilha);
		y = x;
		node *tmp, *tmp2, *tmp3;
		tmp3 = pilha;
		tmp2 = novo;
		while(y > 0){
			tmp = pilha;
			ord = (pilha->prox)->num;
			
			while(tmp->prox != NULL){
				if((tmp->prox)->num < ord){
					ord = (tmp->prox)->num;
				}
				tmp = tmp->prox;
			}
			while(tmp3->prox != NULL){
				if((tmp3->prox)->num == ord){
					k = pop(pilha);
					push(pilha2, k);
				}
				else{
				z = pop(pilha);
				push(novo, z);
				}
			}
			while(tmp2->prox != NULL){
				z = pop(novo);
				push(pilha, z);
			}
			y--; 
		}
		
		node *aux;
		aux = pilha2;
		while(aux->prox != NULL){
			z = pop(pilha2);
			push(pilha, z);
		}
	}
}

int main(){
	
	node *pilha = (node *) malloc(sizeof(node));
	if(!pilha){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(pilha);
		int op, x, y;
		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
					printf("Insira o numero que deseja adcionar na pilha\n");
					scanf("%d", &x);
					push(pilha, x);	
					printf("O numero foi adcionado!\n");
				break;
				case 2:
					pop(pilha);
					printf("O numero foi excluido!\n");
				break;
				case 3:
					y = count(pilha);
					printf("Existem %d elementos cadastrados na pilha\n", y);
					show(pilha);
				break;
				case 4:
					ordena(pilha);
					printf("Pilha ordenada com sucesso!\n");
				break;
				default:
					printf("Operacao invalida!\n");
			}
		}
	}
	return 0;
}
			
			
		
		
		
		
		
		
		
		
