#include <stdio.h>
#include <stdlib.h>

struct Node{
	
	int num;
	struct Node *prox;
};

typedef struct Node node;

int empty(node *fila){
	
	if(fila->prox == NULL)
		return 1;
	else 
		return 0;
}

void inicia(node *fila){
	
	fila->prox = NULL;
}

void insert(node *fila, int x){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	
	novo->num = x;
	if(empty(fila) == 1)
		fila->prox = novo;
	else{
		node *tmp;
		tmp = fila->prox;
		fila->prox = novo;
		novo->prox = tmp;
	}
}

int remover(node *fila){
	
	int aux;
	
	if(empty(fila) == 1){
		printf("A fila ja se encontra vazia\n");
		return 0;
	}
	else{
		
		node *pen, *ult;
		ult = fila->prox;
		pen = fila;
		
		while(ult->prox != NULL){
			pen = ult;
			ult = ult->prox;
		}
		pen->prox = ult->prox;
		aux = ult->num;
		free(ult->prox);
	
	return aux;
	}
}

void show(node *fila){
	
	if(empty(fila) == 1)
		printf("Fila Vazia!\n");
	else{
		node *tmp = fila->prox;
		while(tmp->prox != NULL){
			printf("|%d| ", tmp->num);
			tmp = tmp->prox;
		}
		printf("|%d| ", tmp->num);
		printf("<- Inicio\n");
		
	}
}

int count(node *fila){
	
	int cont = 1;
	
	if(empty(fila) == 1){
		printf("Fila Vazia!\n");
		cont = 0;
	}else{
		node *tmp = fila->prox;
		while(tmp->prox != NULL){
			cont++;
			tmp = tmp->prox;
		}
	}
	return cont;
}
