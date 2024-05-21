#include <stdio.h>
#include <stdlib.h>

struct Node{
	
	int num;
	struct Node *prox;
};

typedef struct Node node;

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
		node *tmp = pilha->prox;
		
		while(tmp->prox != NULL){
			tmp = tmp->prox;
		}
		tmp->prox = novo;
	}
}

void pop(node *pilha){
	
	if(empty(pilha) == 1){
		printf("A pilha ja se encontra vazia\n");
		return;
	}
	else{
		node *pen, *ult;
		ult = pilha->prox;
		pen = pilha;
		
		while(ult->prox != NULL){
			pen = ult;
			ult = ult->prox;
		}
		pen->prox = ult->prox;
		free(ult);
	}
}

void show(node *pilha){
	
	if(empty(pilha) == 1)
		printf("Pilha Vazia!\n");
	else{
		node *tmp = pilha->prox;
		while(tmp->prox != NULL){
			printf("	|%d|\n", tmp->num);
			tmp = tmp->prox;
		}
		printf("	|%d|", tmp->num);
		printf(" < Topo\n");
	}
}

int count(node *pilha){
	
	int cont = 1;
	
	if(empty(pilha) == 1){
		printf("Pilha Vazia!\n");
		cont = 0;
	}
	else{
		node *tmp = pilha->prox;
		while(tmp->prox != NULL){
			cont++;
			tmp = tmp->prox;
		}
	}
	return cont;
}
