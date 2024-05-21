#include <stdio.h>

struct pessoa{
	
	int idade;
	char nome[30], sexo;
};

typedef struct pessoa pessoa;

double media( pessoa p[], int n){
	
	int count = 0, s = 0;
	double m; 
	
	for(int i = 0; i < n; i++){
		if(p[i].sexo == 'F'){
			count++;
			s += p[i].idade;
		}
	}
	
	m = s / count;
	
return m;
}			

int main(){

	int x;
	pessoa p[100];
	double m;
	
	printf("Quantas pessoas deseja cadastrar?\n");
	scanf("%d", &x);
	
	while(x > 100){
		printf("numero invalido de pessoas, o valor precisa ser abaixo de 100\n");
		scanf("%d", &x);
	}
	
	for(int i = 0 ; i < x; i++){
		printf("Insira o nome da %d pessoa\n", i+1);
		fflush(stdin);
		gets(p[i].nome);
		printf("Insira a idade da %d pessoa\n", i+1);
		scanf("%d", &p[i].idade);
		fflush(stdin);
		printf("Insira o sexo da %d pessoa\n", i+1);
		scanf("%c", &p[i].sexo);
		fflush(stdin);
		while(p[i].sexo != 'M' && p[i].sexo != 'F'){
			printf("Sexo invalido, favor insira um sexo valido:\n");
			scanf("%c", &p[i].sexo);
			fflush(stdin);
		}
	}
	
	m = media(p, x);
	printf("A media de idade das mulheres eh: %.2lf\n", m);
	
return 0;
}
