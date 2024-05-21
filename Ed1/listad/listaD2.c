#include <stdio.h>
#include <stdlib.h>
#include "listaD2.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int main(){
	
	node *lista = (node *) malloc(sizeof(node));
	if(!lista){
		printf("Sem memoria disponivel!\n");
		return 0;
	}
	else{
		inicia(lista);
		int op, x, t;
		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
					printf("Insira o numero que deseja adcionar na lista\n");
					scanf("%d", &x);
					insereI(lista, x);
					printf("O numero foi adcionado!\n");
				break;
				case 2:
					printf("Insira o valor que deseja excluir:\n");
					scanf("%d", &t);
					removerE(lista, t);
				break;
				case 3:
					show(lista);
				break;
				case 4:
					printf("Insira o numero que deseja adcionar na lista\n");
					scanf("%d", &x);
					insereF(lista, x);
					printf("O numero foi adcionado!\n");
				break;
				case 5:
					removerI(lista);
				break;
				case 6:
					removerF(lista);
				break;
				default:
					printf("Operacao invalida\n");
				}
			}
		}
return 0;
}
