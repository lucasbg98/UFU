#include <stdio.h>

int soma(int *x, int *y){

	int z;
	
	z = *x + *y;
	
	*x = 100;
	*y = 50;
	
return z;
}

int main(){

	int a, b, c;
	
	a = 10;
	b = 5;
	
	c = soma(&a, &b);
	
	printf("%d %d %d\n", a, b, c);

return 0;
}
