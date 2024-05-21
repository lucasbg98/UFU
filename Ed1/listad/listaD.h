#include <stdio.h>
#include <stdlib.h>

struct Node{
	int num;
	struct Node *prox;
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
}

void insereI(node *lista, int x){	
	
	node *novoI = (node *) malloc(sizeof(node));
	inicia(novoI);
	
	novoI->num = x;
	if(empty(lista) == 1){
	lista->prox = novoI;
	}
	else{
		node *tmp;
		tmp = lista->prox;
		lista->prox = novoI;
		novoI->prox = tmp; 
	}
}

void insereF(node *lista, int x){
	
	node *novoF = (node *) malloc(sizeof(node));
	inicia(novoF);
	
	novoF->num = x;
	if(empty(lista)== 1)
		lista->prox = novoF;
	else{
		node *tmp;
		tmp = lista->prox;
		while(tmp->prox != NULL){
			tmp = tmp->prox;
		}
		tmp->prox = novoF;
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
	}
return z;
}	

int removerF(node *lista){
	
	int z;
	if(empty(lista) == 1){
		printf("Lista Vazia!\n");
	}
	else{
		node *ult, *pen;
		ult = lista->prox;
		pen = lista;
		while(ult->prox != NULL){
			pen = ult;
			ult = ult->prox;
		}
		pen->prox = ult->prox;
		z = ult->num;
		free(ult);
	}
return z;
}

int removerE(node *lista, int x){
	
	int z, y = 0;
	if(empty(lista) == 1)
		printf("Lista Vazia\n");
	else{
		node *ult, *pen;
		ult = lista->prox;
		pen = lista;
		
		while(ult->prox != NULL){
			if(ult->num == x){
				pen->prox = ult->prox;
				z = ult->num;
				free(ult);
				y = 1;
				break;
			}
			else{
				pen = ult;
				ult = ult->prox;
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
