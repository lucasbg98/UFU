#include <stdio.h>
#include <string.h>
#include <stdlib.h>


struct Node{
	int idade;
	char nome[30];
	struct Node *prox;
};

typedef struct Node node;

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para buscar um valor especifico              |\n");
    printf("|    5 para limpar toda a pilha                     |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int empty(node *lista){
	
	if(lista->prox == NULL)
		return 1;
	else 
		return 0;
}

void inicia(node *lista){
	
	lista->prox = NULL;
}

void insereI(node *lista, int x, char nome[]){	
	
	node *novoI = (node *) malloc(sizeof(node));
	inicia(novoI);
	
	novoI->idade = x;
	strcpy(novoI->nome, nome);
	
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

int removerE(node *lista, char x[]){
	
	int y = 0;

	if(empty(lista) == 1)
		printf("Lista Vazia\n");
	else{
		node *ult, *pen;
		ult = lista->prox;
		pen = lista;
		
		while(strcmp(ult->nome, x) != 0 || ult->prox != NULL){
				pen = ult;
				ult = ult->prox;
		}
		if(strcmp(ult->nome, x) == 0)
			y++;
		if(y > 0){
			pen->prox = ult->prox;
			free(ult);
		}
		else if(y == 0 )
			printf("Valor nao encontrado!\n");
	}
return y;
}

void show(node *lista){

	node *tmp;
	tmp = lista->prox;
	printf("v Inicio\n");
	while(tmp->prox != NULL){
		printf("%s\n", tmp->nome);
		printf("|%d|\n", tmp->idade);
		tmp = tmp->prox;
	}
	printf("\n");
	printf("%s\n", tmp->nome);
	printf("|%d|\n",tmp->idade); 
}

//void aumento(node *lista){
	
int main(){
	
	int idade, op;
	char nome[30];
	node *lista = (node *) malloc(sizeof(node));
	inicia(lista);
	
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				scanf("%d", &idade);
				fflush(stdin);
				gets(nome);

				insereI(lista, idade, nome);
			break;
			case 2:
				fflush(stdin);
				gets(nome);
				removerE(lista, nome);
				
				
			break;
			case 3:
				show(lista);
			break;
		}
	}
return 0;
}
	
	
	
	
	
