#include <stdio.h>
#include <stdlib.h>

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

void insert(int *vet, int x, int *topo ){
	
	int i;
	if(*topo < 0)
		*topo = 0;
	if(*topo == 0)
		vet[*topo] = x;
	else{	
		for(i = *topo -1; i >= 0 ; i--){
			vet[i+1] = vet[i];
		}
		vet[0] = x;
	}
	*topo = *topo + 1;
}

int remover(int *vet, int *topo){
	
	int y;
	y = vet[*topo-1];
	*topo = *topo -1;
	
	return y;
}

void show(int *vet, int *topo){
	
	int i;
	printf("Valores contidos na pilha : \n");
	for(i = 0; i < *topo  ; i++){
		printf("|%d| ", vet[i]);
	}
		printf("\n");
}

void clear(int *topo){
	
	*topo = 0;
}
