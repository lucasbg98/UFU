#include <stdio.h>

int main();
int dobro();

int main(){

	int a, b;
	printf("Insira um numero\n");
	scanf("%d", &a);
	b = dobro(&a);
	printf("Novo valor da variavel: %d\n", b);

	
return 0;
}

int dobro(int *a){
	
	int x;
	
	x = *a * 2;
	
	return x;
}
