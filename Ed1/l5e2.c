#include <stdio.h>
#include <math.h>

void troca(int *x, int *y){
	
	int aux;
	
	aux = *x;
	*x = *y;
	*y = aux;
}

void decrement(int *x, int *y){
	
	*x = *x - 1;
	*y = *y + 1;
}

void bhask(int a, int b, int c, double *x1, double *x2){
	
	int delta;
	
	delta = (b	* b) - (4 * (a * c));
	
	*x1 = (-b + sqrt(delta))/ (2 * a);
	*x2 = (-b - sqrt(delta)) / (2 * a);
	
}

int main(){
	
	int x, y, a, b, c;
	double x1 = 0, x2 = 0;
	
	printf("Insira dois valores:\n");
	scanf("%d %d", &x, &y);
	printf("Os Valores sao: %d %d\n", x, y);
	
	troca(&x, &y);
	printf("Valores trocados: %d %d\n", x, y);
	
	decrement(&x, &y);
	printf("Valores alterados: %d %d\n", x, y);
	
	printf("insira 3 valores de uma equacao: \n");
	scanf("%d %d %d", &a, &b, &c);
	bhask(a, b, c, &x1, &x2);
	printf("As raizes dessa equacao sao: %.2lf %.2lf\n", x1, x2);

return 0;
}
