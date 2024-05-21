#include <stdio.h>

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

#define MAX 5

struct fila{
int item[MAX];
int inicio, fim;
}f;

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

int remover(Fila *F){
	
	int x;
	
	if(F->inicio==F->fim)
		return 0;
	else{
		x=F->item[F->inicio];
		F->inicio = F->inicio + 1;
		return x;
	}
}

void saida(Fila *F){
	
	printf("O proximo elemento a sair da fila eh: %d\n", F->item[F->inicio]);
}	

void print(Fila *F){
	
	
	
	for(int i = 0; i < MAX; i++){
		printf("|%d| ", F->item[i]);
	}
	printf("\n");
	/*Fila aux;
	int x;
	
	for(int i = 0; i < MAX; i++){
		x = remover(F);
		printf("|%d| ", x);
		insere(&aux, x);
	}
	
	printf("\n");
	for(int i = 0; i < MAX; i++){
		x = remover(&aux);
		insere(F, x);
	} */
}	

int main(){
	
	Fila f;
	int op, x, y;
	inicia(&f);
	
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
					printf("Digite o numero que deseja inserir na fila:\n");
					scanf("%d", &x);
					y = insere(&f, x);
					if(y == 0)
						printf("A fila ja esta cheia, impossivel inserir mais valores!\n");
					else
						printf("Numero Adcionado!\n");
			break;
			case 2: 
					y = remover(&f);
					if(y != 0)
						printf("Elemento %d excluido com sucesso!\n", y);
					else
						printf("A fila esta vazia\n");
			break;
			case 3:
					saida(&f);
			break;
			case 4:
					print(&f);
			break;
			case 5:
					return  0;
			break;
			default:
					printf("opcao invalida\n");
			break;
		}
	}
return 0;
}
					
	
	
	
