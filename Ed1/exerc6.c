#include <stdio.h>

void troca();

int main(){

	int a, b;
	printf("insira os valores\n");
	scanf("%d %d", &a, &b);
	
	troca(&a, &b);
	printf("novos valores: %d %d\n", a, b);
	
return 0;

}

void troca(int *a, int *b){
	int temp;
	temp = *a;
	*a = *b;
	*b = temp;
	
	
}
