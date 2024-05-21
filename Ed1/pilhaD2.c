#include <stdio.h>
#include <stdlib.h>

struct Node{
	
	int num;
	struct Node *prox;
};

typedef struct Node node;

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para mostrar a qntd de elementos da pilha    |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int empty(node *pilha){
	
	if(pilha->prox == NULL)
		return 1;
	else 
		return 0;
}

void inicia(node *pilha){
	
	pilha->prox = NULL;
}

void push(node *pilha, int x){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	
	novo->num = x;
	if(empty(pilha) == 1)
		pilha->prox = novo;
	else{
		node *tmp;
		tmp = pilha->prox;
		pilha->prox = novo;
		novo->prox = tmp;
	}
}

void pop(node *pilha){
	
	if(empty(pilha) == 1){
		printf("A pilha ja se encontra vazia\n");
		return;
	}
	else{
		node *tmp;
		tmp = (pilha->prox)->prox;
		free(pilha->prox);
		pilha->prox = tmp;
	}
}

void show(node *pilha){
	
	if(empty(pilha) == 1)
		printf("Pilha Vazia!\n");
	else{
		node *tmp = pilha->prox;
		printf("Topo >");
		while(tmp->prox != NULL){
			printf("	|%d|\n", tmp->num);
			tmp = tmp->prox;
		}
		printf("	|%d|\n", tmp->num);
	}
}

int count(node *pilha){
	
	int cont = 1;
	
	if(empty(pilha) == 1){
		printf("Pilha Vazia!\n");
		cont = 0;
	}else{
		node *tmp = pilha->prox;
		while(tmp->prox != NULL){
			cont++;
			tmp = tmp->prox;
		}
	}
	return cont;
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
					show(pilha);
				break;
				case 4:
					y = count(pilha);
					printf("Existem %d elementos cadastrados na pilha\n", y);
				break;
			}
		}
	}
	return 0;
}
