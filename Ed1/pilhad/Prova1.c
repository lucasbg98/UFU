#include <stdio.h>
#include <stdlib.h>
#include "pilhad2.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para excluir um elemento especifico          |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int removeE(node *pilha, int x){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	int d = 0,z;
	
	if(empty(pilha) == 1)
		printf("Pilha Vazia!\n");
	else{
		node *tmp, *tmp2;
		tmp = pilha;
		while(tmp->prox != NULL){
			if((tmp->prox)->num == x){
				z = pop(pilha);
				d = 1;
				break;
			}
			else{
				z = pop(pilha);
				push(novo, z);
			}
		}
		if(empty(novo) == 1)
			return d;
		else{
			tmp2 = novo;
			while(tmp2->prox != NULL){
				z = pop(novo);
				push(pilha, z);
			}
		}
	}
return d;
}
				
int main(){
	
	node *pilha = (node *) malloc(sizeof(node));
	if(!pilha){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(pilha);
		int op, x, y, t, n;
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
					printf("Insira o numero que deseja excluir: \n");
					scanf("%d", &n);
					t = removeE(pilha, n);
					if(t == 1)
						printf("O elemento %d foi excluido!\n", n);
					else
						printf("O elemento nao foi encontrado!\n");
				break;
				default:
					printf("Operacao invalida!\n");
			}
		}
	}
	return 0;
}
