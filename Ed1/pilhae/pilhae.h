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

void push(int *vet, int x, int *topo ){
	
	if(*topo < 0)
		*topo = 0;
		
	vet[*topo] = x;
	*topo = *topo +1;
}

int pop(int *vet, int *topo){
	
	int y;
	y = vet[*topo-1];
	*topo = *topo -1;
	
	return y;
}

void show(char *vet, int *topo){
	
	int i;
	printf("Valores contidos na pilha : \n");
	for(i = *topo -1; i >= 0  ; i--){
		printf("	|%d|\n", vet[i]);
	}
}


void clear(int *topo){
	
	*topo = 0;
}
