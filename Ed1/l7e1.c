#include <stdio.h>

struct Pilha{
	int p[20];
	int topo = 0;
};

typedef struct Pilha pilha;

void push(pilha *vet, int x){
	
	if(*vet.topo < 0)
		*vet.topo = 0;

	*vet.p[*vet.topo] = x;
	*vet.topo = *vet.topo + 1;
	
}

int pop(pilha *x){
	
	int y;
	
	y = *x.p[*x.topo-1];
	*x.topo = *x.topo - 1;
	
return y;
}

void ordena(pilha vet[], int x, int *c2, int *c3){
	
	int y, topo2 = 0, topo3 = 0;
	
	void(i = 0 ; i < x ; i++){
		if(vet[i] < 100){
			y = pop(vet[0]);
			push(vet[1], y);
			*c2 = *c2 + 1;
		}
		else{
			y = pop(vet[0]);
			push(vet[2], y);
			*c3 = *c3 + 1;
		}
	}
	
}
			 
int main(){
	
	pilha p[3];
	int x, y, c2 = 0, c3 = 0;
	
	printf("Digite quantos elementos deseja inserir\n");
	scanf("%d", &x);
	
	while(x > 20){
		printf("Valor invalido, digite um valor menor que 20\n");
		scanf("%d", &x);
	}
	
	printf("Insira os valores na pilha\n");
	
	for(int i = 0; i < x; i++){
		scanf("%d", &y);
		push(p, y);
	}
	
	printf("Pilha 1: ");
	for(int i  = 0; i < x; i++){
		printf("%d ", p[0].p[i]);
	}
		printf("\n Ordenando... \n");
	
	ordena(p[3], x, &c2, &c3);
	
	printf("Pilha 2: ");
	for(int i = 0; i < c2 ; i++){
		printf("%d ", p[1].p[i]);
	}
	printf("\n Pilha 3: ");
	for(int i = 0; i < c3 ; i++){
		printf("%d ", p[2].p[i]);
	}
	printf("\n");
	
return 0;
}
	
		
		
