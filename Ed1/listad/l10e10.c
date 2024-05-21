#include <stdio.h>
#include <stdlib.h>
#include "listaD2.h"


node ordena( node *lista1, node *lista2){
	
	node *aux = (node *) malloc(sizeof(node));
	inicia(aux);
	
	lista2->ant = lista1;
	
	if(aux->prox == NULL)
		aux->num = lista1->num;
	else{
		node *tmp;
		tmp = lista;
	
	
	
	
