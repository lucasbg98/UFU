#include <stdio.h>

double media(double x, double y, double z){
	
	double m;
	
	m = ((x * 2) + (y * 3) + (z * 5)) / 10;
	
	return m;
}

int main(){
	
	double x, y, z, m;

	printf("Digite o valor do Trabalho de Laboratorio: \n");
	scanf("%lf", &x);
	
	printf("Digite o valor da Avaliacao Semestral: \n");
	scanf("%lf", &y);
	
	printf("Digite o valor do Exame Final: \n");
	scanf("%lf", &z);
	
	m = media(x,y,z);
	
	if(m > 8 && m <= 10)
		printf("O aluno possui nota de conceito A\n");
	if(m > 7 && m <= 8)
		printf("O aluno possui nota de conceito B\n");
	if(m > 6 && m <= 7)
		printf("O aluno possui nota de conceito C\n");
	if(m > 5 && m <= 6)
		printf("O aluno possui nota de conceito D\n");
	if(m >= 0 && m <= 5)
		printf("O aluno possui nota de conceito E\n");
	
return 0;
}
	
	
