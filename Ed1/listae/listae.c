#include <stdio.h>
#include <stdlib.h>
#include "listae.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor no topo               |\n");
    printf("|    2 para adcionar um valor no fim                |\n");
    printf("|    3 para excluir um valor no topo                |\n");
    printf("|    4 para excluir um valor no fim                 |\n");
    printf("|    5 para excluir um valor especifico             |\n");
    printf("|    6 para exibir os valores da lista              |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int main(){
	
	int topo = 0, *pt, op, z, x, o;
	pt = &topo;
	printf("Insira o numero de elementos que a lista tera: \n");
	scanf("%d", &z);
	int vet[z];
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				printf("Insira o elemento que deseja adcionar:\n");
				scanf("%d", &x);
				insertT(vet, x, pt);
				printf("Valor %d inserido no topo da lista!\n", x);
			break;
			case 2:
				printf("Insira o elemento que deseja adcionar:\n");
				scanf("%d", &x);
				insertF(vet, x, pt);
				printf("Valor %d inserido no fim da lista!\n", x);
			break;
			case 3:
				o = removerT(vet, pt);
				printf("Valor %d removido no topo da lista!\n", o);
			break;
			case 4:
				o = removerF(vet, pt);
				printf("Valor %d removido no fim da lista!\n", o);
			break;
			case 5:
				printf("Digite o Valor que deseja excluir:\n");
				scanf("%d", &x);
				o = search(vet, x, pt);
				if(o == 1)
					printf("Valor excluido com sucesso!\n");
				else
					printf("Numero nao encontrado!\n");
			break;
			case 6:
				show(vet, pt);
			break;
			default:
				printf("Operação inválida\n");
			}
		}
return 0;
	}
				
