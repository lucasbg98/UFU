#include <stdio.h>
#include <stdlib.h>


void menu(){
	
	printf("------------------------ MENU -----------------------------\n");
	printf("Digite 1 para adcionar um novo valor\n");
	printf("Digite 2 para remover um valor\n");
	printf("Digite 3 para exibir os valores cadastrados\n");
	printf("Digite 4 para limpar todos os valores da fila\n");
	printf("-----------------------------------------------------------\n");
	
}


void pop(int *vet, int *topo){
	
	int i,aux = 0;
	
	if(*topo > 1){
			
	for(i=1; i < *topo; i++){
		
		aux = vet[i];
		vet[i] = vet[i-1];
		vet[i-1] = aux;
	}
	}

	*topo = *topo - 1;
	
}

void push(int *vet, int x, int *topo){
	
	vet[*topo] = x;
	
	*topo = *topo + 1;
}

void show(int * vet, int * topo){
	
	int i;
	
	for(i = 0; i < *topo ; i++){
		
		printf("|%d| ", vet[i]);
	
}
	printf("\n\n");
}

void clean(int *vet, int *topo){
	
	int i;
	
	for(i = 0; i < *topo ; i++){
		
		vet[i] = NULL;
	
	}
	
}

int main(){
	
	int topo= 0, *pt = &topo, u, op, x;
	
	printf("Insira a quantidade de valores que a fila tera: \n");
	
	scanf("%d", &u);
		
	system("CLS");
	
	int vet[u];
	
	while(1){
		menu();
		
		scanf("%d", &op);
		
		switch(op){
			
			case 0:
				
				return 0;
				
			break;
			
			case 1:
			
				system("CLS");
			
				if(topo < u){
					printf("Digite o valor que deseja adcionar: \n");
					
					scanf("%d", &x);
					
					push(vet, x, pt);
					
					system("CLS");
				}
				else{
					
					printf("Numero maximo de valores inseridos\n");
				}
				
			break;
			
			case 2:
			
				system("CLS");
			if(topo > 0){
				
				pop(vet, pt);
				
				printf("Valor excluido com sucesso!\n");
				
			}else
				printf("Nao existem mais valores para excluir\n");
				
			break;
			
			case 3:
			
				system("CLS");
				
				show(vet, pt);
				
			break;
			
			case 4:
			
				system("CLS");
				
				clean(vet, pt);
				
				topo = 0;
				
				printf("Fila limpa com sucesso!\n");
				
			break;
			
			default:
				
				printf("comando invalido\n");
			
		}
	}
		
return 0;
}
			
					
					
				
	
