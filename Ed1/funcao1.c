#include <stdio.h>

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para realizar uma soma                       |\n");
    printf("|    2 para realizar uma subtracao                  |\n");
    printf("|    3 para realizar uma multiplicacao              |\n");
    printf("|    4 para realizar uma divisao                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int soma( int x, int y){
		
		int k;
		k = x + y;
		
		return k;
	}
	
int sub( int x, int y){
	
	int k;
	k = x - y;
	
	return k;
}

int multi( int x, int y){
	
	int k;
	k = x * y;
	
	return k;
}

double div(double x, double y){
	
	double k;
	k = x / y;
	
	return k;
}

int main(){
	
	int x, y, z, op;
	double x1, y1, z1;
	
	while(1){
		menu();
		scanf("%d", &op);
		switch(op){
			case 1:
				printf("Insira o primeiro valor\n");
				scanf("%d", &x);
			
				printf("Insira o segundo valor\n");
				scanf("%d", &y);
				
				z = soma(x,y);
				printf("Resultado: %d\n", z);
			break;
			case 2:
				printf("Insira o primeiro valor\n");
				scanf("%d", &x);
			
				printf("Insira o segundo valor\n");
				scanf("%d", &y);
				
				z = sub(x,y);
				printf("Resultado: %d\n", z);
			break;
			case 3:
				printf("Insira o primeiro valor\n");
				scanf("%d", &x);
			
				printf("Insira o segundo valor\n");
				scanf("%d", &y);
				
				z = multi(x,y);
				printf("Resultado: %d\n", z);
			break;
			case 4:
				printf("Insira o primeiro valor\n");
				scanf("%lf", &x1);
			
				printf("Insira o segundo valor\n");
				scanf("%lf", &y1);
				
				z1 = div(x,y);
				printf("Resultado: %.2lf\n", z1);
			break;
			default:
				printf("Opcao invalida, favor digitar outro numero\n");
			}
		}
		
return 0;
}
			
				
	
	
	
	
	
