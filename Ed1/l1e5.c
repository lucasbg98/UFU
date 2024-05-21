#include <stdio.h>

int primo(int x){

	int z;
	
	if(x % x == 0 && x % 1 == 0)
		z = 1;
	else
		z = 0;
		
return z;
}

int main(){

	int x, z;
	
	printf("insira um valor: \n");
	scanf("%d", &x);
	
	if(x < 1){
		while(x < 1){
			printf("Valor invalido, insira um valor valido: \n");
			scanf("%d", &x);
		}
	}
	
	z = primo(x);
	
	if(z == 0)
		printf("O numero %d nao eh primo\n", x);
	else if( z == 1)
		printf("O numero %d eh primo\n", x);
		
return 0;
}
