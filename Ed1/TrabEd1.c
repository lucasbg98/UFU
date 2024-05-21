#include <stdio.h>
#include <string.h>
#include <stdlib.h>

struct cadastro {

	int num;
	double saldo;
	char nome[20];
} conta[20];

int cad = 0;

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para cadastrar uma conta                     |\n");
    printf("|    2 para consultar dados de uma conta            |\n");
    printf("|    3 para excluir uma conta especifica            |\n");
    printf("|    4 para exibir conta(s) de maior saldo          |\n");
    printf("|    5 para excluir conta(s) de menor saldo         |\n");
    printf("|    6 para excluir primeira conta cadastrada       |\n");
    printf("|    7 para mostrar todas as contas registradas     |\n");
    printf("|    8 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

int verificar(int aux){
	
	int j, i =cad;
	
	for(j = 0; j < i ; j++){
			if(conta[j].num == aux){
				printf("Numero de conta ja existente, insira outro numero: \n");
				return 0;
			}
	}
return 1;
}	

void adcionar(){
	
	system("CLS");
	
	int i , flag;
	i = cad;
	flag = 0;
	if(i>19){
		printf("O numero maximo de contas cadastradas ja foi atingido\n");
		return;
	}
	else{
	printf("Insira o numero da conta: \n");
	scanf("%d", &conta[i].num);
	if(i > 0){
		while(flag != 1){
			if(verificar(conta[i].num) == 0){
				flag = 0;
				scanf("%d", &conta[i].num);
			}else
				flag = 1;
	}
	}
		printf("Insira o nome do cliente: \n");
		scanf("%s", conta[i].nome);
		printf("Insira o saldo da conta: \n");
		scanf("%lf", &conta[i].saldo);
		
		system("CLS");
		
		printf("Conta cadastrada com sucesso!\n");
		cad++;
	}
}

void consultar(){
	
	system("CLS");
	
	int i= cad;
	char x[20];
	
	printf("Insira o nome do cliente que deseja procurar: \n");
	scanf("%s", x);
	
	for(int j = 0; j < i; j++){
		
		if(strcmp(x, conta[j].nome) == 0){
			printf("Numero da conta: %d\n", conta[j].num);
			printf("Saldo da conta: %.2lf\n", conta[j].saldo);
		}
	}
}

void excluir(){
	
	system("CLS");
	
	int i = cad, j, x;
	
	printf("Insira o numero da conta que deseja excluir: \n");
	scanf("%d", &x);
	
	for(j = 0; j < i; j++){
		
		if(conta[j].num == x)	
			conta[j].num = conta[i-1].num;
			strcpy(conta[j].nome, conta[i-1].nome);
			conta[j].saldo = conta[i-1].saldo;
		}
		cad--;
		system("CLS");
		printf("Excluido com sucesso\n");
	}

void maior(){
	
	system("CLS");
	
	int  i = cad, j, vet[20], y=0;
	double x;
	
	x = conta[0].saldo;
	vet[y] = conta[0].num;
		
	for( j= 1; j < i ; j++){
		
		if(conta[j].saldo > conta[j-1].saldo){
			x = conta[j].saldo;
			y = 0;
			vet[y] = conta[j].num;	
		}if(conta[j].saldo == conta[j-1].saldo){
			y++;
			vet[y] = conta[j].num;
		}	
	}
	
	printf("O maior saldo e de %.2lf, e a(s) conta(s) com este saldo e(sao):\n", x);
	
	for(int z =0 ; z <= y; z++){
		printf("Conta: %d\n", vet[z]);
	}
}

void menor(){
	
	system("CLS");
	
	int i= cad, j, a, k, b=0;
	double x;
	
	x = conta[0].saldo;
	
	for(j = 1; j < i; j++){
		if(conta[j].saldo < conta[j-1].saldo){
			x = conta[j].saldo;
			a=0;
		}
		if(conta[j].saldo == x){
			a++;
		}
		
	}
	printf("O menor saldo eh de : %.2lf R$, e as seguintes contas com esse saldo foram excluidas: \n", x);
	while(b < a){
	for(k = 0; k < i; k++){
		if(conta[k].saldo == x){
			printf("Conta %d\n", conta[k].num);
			conta[k].num = conta[i-1].num;
			strcpy(conta[k].nome, conta[i-1].nome);
			conta[k].saldo = conta[i-1].saldo;
			cad--;
		}
   }
   b++;
}
}

void ex1(){
	
	system("CLS");
	
	int i = cad;
	printf("A seguinte conta foi excluida: \n");
	printf("Conta: %d\n", conta[0].num);
	printf("Cliente: %s\n", conta[0].nome);
	printf("Saldo: %.2lf\n", conta[0].saldo);
	
	conta[0].num = conta[i-1].num;
	conta[0].saldo = conta[i-1].saldo;
	strcpy(conta[0].nome, conta[i-1].nome);
	
	cad--;	
}

void mostrar(){
	
	system("CLS");
	
	int j;
	
	printf("----- %d CONTAS CADASTRADAS -----\n", cad);
	
	for(j = 0; j < cad; j++){
		printf("---- %d CADASTRO ----\n", j+1);
		printf("Conta: %d\n", conta[j].num);
		printf("Cliente: %s\n", conta[j].nome);
		printf("Saldo: %.2lf\n", conta[j].saldo);
		printf("\n\n");
	}
}

int main(){
	
	int x = 1;
	
	while( x!= 0){
		menu();
		int op;
		scanf("%d", &op);
		
		switch(op){
			
			case 1:
				adcionar();
			break;
			case 2:
				consultar();
			break;
			case 3:
				excluir();
			break;
			case 4:
				maior();
			break;
			case 5:
				menor();
			break;
			case 6:
				ex1();
			break;
			case 7:
				mostrar();
			break;
			case 8: 
				x = 0;
			break;
			default:
				system("CLS");
				printf("operacao invalida\n");
	}
}
return 0;
}
			
		
