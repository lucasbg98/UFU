#include "pilhae.h"

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

void pop(int *vet, int *topo){
	
	int y;
	y = vet[*topo-1];
	*topo = *topo -1;
	printf("O valor %d foi excluido com sucesso!\n", y);  
}

void show(int *vet, int *topo){
	
	int i;
	printf("Valores contidos na pilha : \n");
	for(i = *topo -1; i >= 0  ; i--){
		printf("	|%d|\n", vet[i]);
	}
}

int search(int *vet, int o, int *topo){

		int i, z=0, aux = 0, *auxtp= &aux;
	int vett[*topo];
	
		for(i = *topo-1; i >= 0 ; i--){
			if(vet[i] != o){
				push(vett, vet[i], auxtp);
				pop(vet, topo);
			}else{
				pop(vet, topo);
				z++;
				}
		}
		
		for(i= *auxtp-1; i>= 0; i--){
			push(vet,vett[i], topo);
			pop(vett,auxtp);
    }

	return z;

}

void clear(int *topo){
	
	*topo = 0;
}
