#include <stdio.h>

struct pilha{
	int vet[5], topo;
};

typedef struct pilha pilha;

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor                       |\n");
    printf("|    2 para excluir um valor                        |\n");
    printf("|    3 para exibir os valores cadastrados           |\n");
    printf("|    4 para exibir o elemento no topo da pilha      |\n");
    printf("|    5 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void push(pilha *p, int x ){
	
	if(p.topo < 0)
		p.topo = 0;
		
	p.vet[p.topo] = x;
	p.topo = p.topo +1;
}

int pop(pilha *p){
	
	int y;
	y = p.vet[p.topo];
	p.topo = p.topo - 1;
	
	return y;
}

void show(struct pilha *p){
	
	struct pilha p2;
	p2.topo = 0;
	int y;
	
	
	
	printf("Valores contidos na pilha : \n");
	while(p.topo > 0){
		printf("	|%d|\n", p.vet[p.topo-1]);
		y = pop(p);
		push(p2, y);
	}
	while(p2.topo > 0){
		y = pop(p2);
		push(p, y);
	}
}

int top(struct pilha *p){
	
	return *p.vet[*p.topo - 1];
}

int main(){
	
	int y, op, k = 0;
	struct pilha *p;
	*p.topo = 0;
	
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				
				if(k == 5)
					printf("Numero máximo de valores ja cadastrados!\n");
				else{
				printf("Insira o elemento que deseja inserir na pilha:\n");
				scanf("%d", &y);
				push(p, y);
				printf("O elemento foi adcionado!\n");
				k++;
			}
			break;
			case 2:
				y = pop(p);
				printf("O elemento %d foi removido\n", y);
			break;
			case 3:
				show(p);
			break;
			case 4:
				y = top(p);
				printf("O elemento no topo da pilha eh : %d\n", y);
			break;
			case 5:
				return 0;
			break;
		}
	}
	
	
	
return 0;
}
	
	
	
