#include <stdio.h>
#include <stdlib.h>
#include "listae.h"

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor especifico             |\n");
    printf("|    3 para exibir os valores da lista              |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void ordena(int *vet, int x, int *topo){
	
	int i, j, k;
	
	if(*topo == 0){
		vet[0] = x;
		*topo = *topo + 1;
	}
	
	else if(x < vet[0]){
		for(k = *topo - 1; k >= 0; k--){
			vet[k+1] = vet[k];
		}
		*topo = *topo + 1;
		vet[0] = x;
	}
	else if(x > vet[*topo -1]){
		insertF(vet, x, topo);
	}
	else{
		for(i = 1; i < *topo ; i++){
			if(x > vet[i] && x < vet[i+1]){
				for(j = *topo -1; j > i; j--){
					vet[j+1] = vet[j];
				}
				vet[i+1] = x;
				*topo = *topo + 1;
			}
			else if(x < vet[i] && x > vet[i-1]){
				for(int p = *topo -1; p >= i; p--){
					vet[p+1] = vet[p];
				}
				vet[i] = x;
			}
		}
	}
}
				
int main(){
	
	int topo = 0, *pt, op, z, x, o, topo2 = 0, *pt2, l , i = 0, n, g , j = 0;	
	pt2 = &topo2;
	pt = &topo;
	printf("Insira o numero de elementos que a lista tera: \n");
	scanf("%d", &z);
	int vet[z], vet2[z], aux[z+z], *pt3, topo3 = 0;
	pt3 = &topo3;
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				printf("Insira em qual lista deseja adcionar:\n");
				scanf("%d", &n);
				if(n == 1){
					printf("Insira o elemento que deseja adcionar:\n");
					scanf("%d", &x);
					ordena(vet, x, pt);
					printf("Valor %d inserido na lista 1!\n", x);
				}
				else if(n == 2){
					printf("Insira o elemento que deseja adcionar:\n");
					scanf("%d", &x);
					ordena(vet2, x, pt2);	
					printf("Valor %d inserido na lista 2!\n", x);
				}
				else
					printf("opcao invalida\n");
			break;
			case 2:
				printf("Insira o elemento que deseja remover:\n");
				scanf("%d", &x);
				o = search(vet, x, pt);
				if(o == 1)
					printf("Valor %d excluido com sucesso!\n", x);
				else
					printf("Valor nao encontrado!\n");
			break;
			case 3:
				for(l = topo; l > 0 ; l--){
					ordena(aux, vet[i], pt3);
					i++;
				}
				for(g = topo2; g > 0; g--){
					ordena(aux, vet2[j], pt3);
					j++;
				}
				show(aux, pt3);
			break;
			case 4:
				show(vet, pt);
				show(vet2, pt2);
			break;
			default:
				printf("Operação inválida\n");
			}
		}
return 0;
	}	
