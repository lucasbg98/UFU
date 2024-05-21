#include <stdio.h>

double banco(double x, char y){
	
	double m;
	
	if(y == 'p')
		m = x * (3/100);
	else if(y == 'f')
		m = x * (4/100);
		
return m;
}

int main(){

	double x, m;
	char y;
	
	printf("Insira o valor do investimento: \n");
	scanf("%lf", &x);
	
	printf("Insira o tipo de investimento, 'P' para poupanca e 'F' para fundos de renda fixa");
	scanf("%c", &y);
	
	if(y != 'p' || y != 'f'){
		printf("Tipo de investimento inexistente, favor inserir um tipo valido\n");
		scanf("%c", &y);
	}
	
	m = banco(x, y);
	
	printf("O rendimento mensal eh de: %.2lf\n", m);
}
	
