#include <stdio.h>
#include <stdlib.h>

void menu(){
	printf("              MENU               \n");     
	printf("Digite 1 para adcionar um elemento\n");
	printf("Digite 2 para excluir um elemento\n");
	printf("Digite 3 para ver os valores cadastrados\n");
	printf("Digite 4 para limpar a pilha\n");
	printf("Digite 5 para excluir um elemento especifico\n");
	printf("Digite 0 para encerrar o programa\n");
}

int pop(int *vet, int *topo){
	
	int y;
	y = vet[*topo-1];
	vet[*topo-1] = NULL;
	*topo = *topo -1;
	
	
	return y;
}

void push(int *vet, int y, int *topo){
	
	vet[*topo] = y;
	*topo = *topo+1;
}
	
void show(int *vet, int *topo){
	
	int i;
	for(i = 0; i < *topo; i++){
		printf("    %d     \n", vet[i]);
	}
}
	
	
void clean(int *vet,int *topo){
	
	int i;
	for(i = 0; i < *topo; i++){
		vet[i] = NULL;
	}
	*topo = 0;
}

int select(int *vet, int x, int *topo){
	int i, z=0, aux = 0, *auxtp= &aux;
	int vett[*topo];
	
		for(i = *topo-1; i >= 0 ; i--){
			if(vet[i] != x){
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
		
int main(){
	
	int topo = 0, x, op, *pt = &topo, u, o, y=0;
	printf("Insira o numero de valores que a pilha tera\n");
	scanf("%d", &u);
	system("CLS");
	int vet[u];
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				if(y < u){
					system("CLS");
					scanf("%d", &x);
					push(vet,x, pt);
					y++;
				}
				else
					printf("Numero maximo de usuarios cadastrados\n");
			break;
			case 2:
				system("CLS");
				pop(vet, pt);
				printf("Valor Excluido com Sucesso!\n");
				y--;
			break;
			case 3:
				system("CLS");
				printf("%d valores cadastrados:\n", *pt);
				show(vet, pt);
			break;
			case 4:
				system("CLS");
				clean(vet, pt);
				printf("Vetor limpo com sucesso!\n");
				y = 0;
			break;
			case 5:
				system("CLS");
				if(*pt-1 <=0)
                    printf("A pilha esta vazia!\n");
                else{
				printf("Digite o valor que deseja excluir\n");
				scanf("%d", &x);
				o = select(vet, x, pt);
				system("CLS");
				if(o == 0)
					printf("Numero nao encontrado\n");
				else
					printf("Numero(s) Excluido(s) com sucesso!\n");
				}
			break;
			case 0: 
				return 0;
			break;
			default:
				printf("opção invalida, digite novamente\n");
				
		}
}
return 0;
}


	
	
		
		
