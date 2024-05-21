#include <stdio.h>
#include <stdlib.h>

int fribonacci(int n){
	
	int f;
	
	if(n == 2 || n == 3)
		return 1;
	else{
		f = fribonacci(n-1) + fribonacci(n-2);
		return f;
	}
}

int fatorial(int n){
	
	int x;
	
	if(n == 0)
		return 1;
	else{
		x = n * fatorial(n-1);
		return x;
	}
}

int main(){
	
	int op, x, f, z, a;
	
	while(1){
		scanf("%d", &op);
		switch(op){
			case 1:
				printf("Insira o numero que deseja encontrar o fatorial: \n");
				scanf("%d", &x);
				f = fatorial(x);
				printf("O fatorial de %d = %d\n", x, f);
			break;
			case 2:
				printf("Insira qual a posicao da sequencia de fribonacci deseja acessar:\n");
				scanf("%d", &z);
				a = fribonacci(z);
				printf("A %d posicao eh o valor %d\n", z, a);
			break;
		}	
	}
return 0;
}
