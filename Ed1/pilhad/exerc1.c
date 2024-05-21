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

void resolver(node *pilha){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	int cont = 0, z;
	double media = 0;

	if(empty(pilha) == 1){
		printf("Pilha Vazia!\n");
		return;
	}else{
		int min, max;
		node *tmp;
		tmp = pilha;
		max = (pilha->prox)->num;
		min = (pilha->prox)->num;
		
		while(tmp->prox != NULL){
			if((tmp->prox)->num > max)
				max = (tmp->prox)->num;
			else if((tmp->prox)->num < min)
				min = (tmp->prox)->num ;
					
			z = pop(pilha);
			push(novo, z);
			media += z;
		}
		node *tmp2;
		tmp2 = novo->prox;
		while(tmp2->prox != NULL){
			z = pop(novo);
			push(pilha, z);
			cont++;
		}
		printf("O valor maximo eh: %d\n", max);
		printf("O valor minimo eh: %d\n", min);
		printf("A media eh: %.2lf\n", media/cont);
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
					resolver(pilha);
				break;
				default:
					printf("Operacao invalida!\n");
			}
		}
	}
	return 0;
}
