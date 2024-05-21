#include <stdio.h>
#include <stdlib.h>

struct Node{
	int num;
	struct Node *prox;
	struct Node *ant;
};

typedef struct Node node;

int empty(node *lista){
	
	if(lista->prox == NULL)
		return 1;
	else 
		return 0;
}

void inicia(node *lista){
	
	lista->prox = NULL;
	lista->ant = NULL;
}

void insereI(node *lista, int x){	
	
	node *novoI = (node *) malloc(sizeof(node));
	inicia(novoI);
	
	novoI->num = x;
	if(empty(lista) == 1){
	lista->prox = novoI;
	novoI->ant = lista;
	}
	else{
		node *tmp;
		tmp = lista->prox;
		lista->prox = novoI;
		novoI->ant = lista;
		novoI->prox = tmp;
		tmp->ant = novoI; 
	}
}

void insereF(node *lista, int x){
	
	node *novoF = (node *) malloc(sizeof(node));
	inicia(novoF);
	
	novoF->num = x;
	if(empty(lista)== 1){
		lista->prox = novoF;
		novoF->ant = lista;
	}
	else{
		node *tmp;
		tmp = lista->prox;
		while(tmp->prox != NULL){
			tmp = tmp->prox;
		}
		tmp->prox = novoF;
		novoF->ant = tmp;
	}
}

int removerI(node *lista){
	
	int z;
	if(empty(lista) == 1)
		printf("Lista Vazia!\n");
	else{
		node *tmp;
		z = (lista->prox)->num;
		tmp = (lista->prox)->prox;
		free(lista->prox);
		lista->prox = tmp;
		tmp->ant = lista;
	}
return z;
}	

int removerF(node *lista){
	
	int z;
	if(empty(lista) == 1){
		printf("Lista Vazia!\n");
	}
	else{
		node *tmp;
		tmp = lista->prox;
		tmp->ant = lista;
		while(tmp->prox != NULL){
			tmp->ant = tmp;
			tmp = tmp->prox;
		}
		(tmp->ant)->prox = tmp->prox;
		z = tmp->num;
		free(tmp);
	}
return z;
}

int removerE(node *lista, int x){
	
	int z, y = 0;
	if(empty(lista) == 1)
		printf("Lista Vazia\n");
	else{
		node *tmp;
		tmp = lista->prox;
		tmp->ant = lista;
		
		while(tmp->prox != NULL){
			if(tmp->num == x){
				(tmp->ant)->prox = tmp->prox;
				z = tmp->num;
				free(tmp);
				y = 1;
				break;
			}
			else{
				tmp->ant = tmp ;
				tmp = tmp->prox;
			}
		}
		if(y == 0 )
			printf("Valor nao encontrado!\n");
		else if(y == 1)
			printf("Valor %d excluido com sucesso!\n", z);
	}

return z;
}

void show(node *lista){

	node *tmp;
	tmp = lista->prox;
	printf("v Inicio\n");
	while(tmp->prox != NULL){
		printf("|%d| ", tmp->num);
		tmp = tmp->prox;
	}
	printf("|%d|\n",tmp->num); 
}
