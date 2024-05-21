#include <stdio.h>
#include <stdlib.h>
#include "filae2.h"

int main(){

	int op, u, x, y = 0, *pt = NULL, topo = 0, z;	
	pt = &topo;
	printf("Insira a quantidade de valores que a pilha tera: \n");
	scanf("%d", &u);
	int vet[u];
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				if(y < u){
					printf("Insira o numero que deseja adcionar: \n");
					scanf("%d", &x);
					insert(vet, x, pt);
					y++;
					printf("O valor foi adcionado com sucesso!\n");
				}
				else
					printf("Numero maximo de valores atingido, impossivel adcionar!\n");
			
			break;
			case 2:
				if(topo == 0)
					printf("A pilha ja se encontra vazia, nao eh possivel excluir mais valores\n");
				else{
					z = remover(vet,pt);
					printf("O valor %d foi removido da fila!\n", z);
					y--;
				}
			break;
			case 3:
				show(vet, pt);
			break;
			/*case 4:
				printf("Insira o numero que deseja procurar\n");
				scanf("%d", &o);
				if(p == 0)
					printf("Numero não econtrado!\n");
					
			break; */
			case 5: 
				printf("Todos os valores foram excluidos, a pilha foi esvaziada!\n");
				clear(pt);
			break;
			default: 
				printf("Operacao invalida, insira uma opcao correta\n");
		}
	}
return 0;
}
