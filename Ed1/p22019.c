#include <stdio.h>
#include <stdlib.h>
#include "listaD.h"

void insereE( node *lista, x){
	
	node = (node *) malloc(sizeof(node));
	inicia(novoI);
	
	novo->num = x;
	if(empty(lista) == 1)
		lista->prox = novo;
	else{
		
		node *ult;
		node *pen;
		pen = lista->prox;
		ult = lista;

		while(pen->prox != NULL || pen->num < x){
				ult = pen;
				pen = pen->prox;
		}
		if(pen->prox  == NULL){
			pen->prox = novo;
			novo->prox = NULL;
		}
		else{
			ult->prox = novo;
			novo->prox = pen;
		}
	}
	
int main(){
	
	node *lista  = (node *) malloc(sizeof(node));
	inicia(lista);
	
	int op, x;
	
	while(1){
		scanf("%d", &op);
		switch(op){
			case 1:
					scanf("%d", &x);
					insereE(&lista, x);
			break;
		}
		
return 0;
}
