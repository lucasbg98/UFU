#include <stdio.h>

#define MAX 20

struct fila{
int item[MAX];
int inicio, fim;
}fila1, fila2, fila3 ;

typedef struct fila Fila;

void inicia(Fila *F){

	F->inicio = 0;
	F->fim = 0;
}

int insere(Fila *F,int x){

	if(F->fim==MAX)
		return 0;
	else{
		F->item[F->fim]= x;
		F->fim = F->fim + 1;
		return 1;
	}
}

int remover(Fila *F,int x){

	if(F->inicio==F->fim)
		return 0;
	else{
		x=F->item[F->inicio];
		F->inicio = F->inicio + 1;
		return x;
	}
}

void verifica(Fila *F){

	int x, k = F->inicio;
	for(int i = k; i < F->fim; i++){
		x = remover(F, F->item[F->fim]);
		if(x < 100)
			insere(&fila2, x);
		else
			insere(&fila3, x);
	}	
}

int main(){
	
	int x;
	
	inicia(&fila1);
	inicia(&fila2);
	inicia(&fila3);
	
	printf("Digite os valores da fila\n");
	for(int i = 0; i < 20; i++){
		scanf("%d", &x);
		insere(&fila1, x);
	}
	
	printf("Valores inseridos na fila: \n");
	for(int i = 0; i < 20 ; i++){
		printf("|%d| ", fila1.item[i]);
	}
	printf("\n");
	
	verifica(&fila1);
	
	printf("Fila 2: \n");
	for(int i = fila2.inicio; i < fila2.fim; i++){
		printf("|%d| ", fila2.item[i]);
	}
	printf("\n");
	
	printf("Fila 3: \n");
	for(int i = fila3.inicio; i < fila3.fim; i++){
		printf("|%d| ", fila3.item[i]);
	}
	printf("\n");
	
return 0;
}
	  

	




