#include <stdio.h>
#include <stdlib.h>
#include "listaD.h"

void insereE( node *lista,int x){
	
	node *novo = (node *) malloc(sizeof(node));
	inicia(novo);
	
	novo->num = x;
	if(empty(lista) == 1)
		lista->prox = novo;
	else{
		node *ult;
		node *pen;
		pen = lista->prox;
		ult = lista;

		while(pen != NULL && pen->num < x){
			ult = pen;
			pen = pen->prox;
		}
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
					insereE(lista, x);
			break;
			case 2:
					show(lista);
			break;
		}
		
	}
		
return 0;
}
