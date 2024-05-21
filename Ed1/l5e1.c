#include <stdio.h>

void ordena(int *x, int *y,int *z){
	
	int aux;
	
	if(*z > *y){
		aux = *y;
		*y = *z;
		*z = aux;
	}
	if(*y > *x){
		aux = *x;
		*x = *y;
		*y = aux;
	}
	if(*z > *y){
		aux = *y;
		*y = *z;
		*z = aux;
	}
}
	

int main(){
	
	int x, y, z;
	
	printf("Insira 3 valores inteiros: \n");
	scanf("%d %d %d", &x, &y, &z);
	
	ordena(&x, &y, &z);
	
	printf("%d %d %d\n", x, y, z);
	
return 0;
}
