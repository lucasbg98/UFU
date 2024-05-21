#include <stdio.h>
#include <stdlib.h>
#include "filad2.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para mostrar a qntd de elementos da pilha    |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int main(){
	
	node *fila = (node *) malloc(sizeof(node));
	if(!fila){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(fila);
		int op, x, y, z;
		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
					printf("Insira o numero que deseja adcionar na pilha\n");
					scanf("%d", &x);
					insert(fila, x);	
					printf("O numero foi adcionado!\n");
				break;
				case 2:
					z = remover(fila);
					printf("O numero %d foi excluido!\n", z);
				break;
				case 3:
					show(fila);
				break;
				case 4:
					y = count(fila);
					printf("Existem %d elementos cadastrados na pilha\n", y);
				break;
			}
		}
	}
	return 0;
}
