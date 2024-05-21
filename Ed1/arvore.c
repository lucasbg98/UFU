#include <stdio.h>
#include <stdlib.h>

struct node{
	int x;
	struct node *prox;
	struct node *ant;
};
typedef struct node node;

void unir(node *p, node *q){
	node *aux = p;
	node *aux1 = p->prox;
	node *aux2 = q->prox;
	node *aux3;
	while(aux2 != null){
		if(aux1->elemento > aux2->elemento){
			aux3 = aux2;
			aux->prox = aux3;
			aux3->ant = aux;
			aux1->ant = aux3;
			aux3->prox-> aux1;
			aux2 = aux2->prox
		}
		else{
			aux = aux->prox
			aux1= aux1->prox
		}
	}
}

void main(){
	node 
}
