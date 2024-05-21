#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int cad=0;

struct cadastro {
	int nmr;
	char nome[100];
	double saldo;
}cadastro[15], auxx;

void menu(){
	printf("---------------MENU--------------\n");
	printf("Digite 1 para cadrastar um novo cliente\n");
	printf("Digite 2 para buscar algum cliente\n");
	printf("Digite 3 para excluir a(s) conta(s) de menor saldo\n");
	printf("Digite 4 para exibir os clientes cadastrados\n");
	printf("Digite 0 para sair\n");
}

void cadastrar(){
	int i, j;
	
	system("CLS");
	if(cad >= 15){
		printf("Voce ja cadastrou o numero maximo de clientes (15)\n");
		return;
	}
	printf("%d clientes cadastrados ate o momento\n", cad);
	for(i=0; i < 1; i++){
		printf("Insira o nome do cliente\n");
		getchar();
		fgets(cadastro[cad].nome,100,stdin);
		printf("Insira o numero da conta\n");
		scanf("%d", &cadastro[cad].nmr);
		if(cad > 1){
			for(j=0; j < cad ; j++){
				while(cadastro[j].nmr == cadastro[cad].nmr){
					printf("Numero de conta ja existente, favor inserir outro numero\n");
					scanf("%d", &cadastro[cad].nmr);
				}
			}
		}
		printf("Insira o saldo da conta\n");
		scanf("%lf", &cadastro[cad].saldo);
	}
	cad++;
	system("CLS");
	return;
}

void busca(){
	int i;
	char str[100];
	system("CLS");
	printf("Digite o nome do cliente\n");
	getchar();
	fgets(str,100,stdin);
	for(i=0; i < 15; i++){
		if(strcmp(str, cadastro[i].nome) == 0){
			printf("Nome do cliente: %s\n", cadastro[i].nome);
			printf("Numero da conta: %d\n", cadastro[i].nmr);
			printf("\n");
			printf("Valor do saldo: %.2lf\n", cadastro[i].saldo);
		}
	}
	int a;
	while(a !=0){
	printf("\n\n");
	printf("Digite zero para voltar ao menu\n");
	scanf("%d", &a);
}
	system("CLS");
	return;
}

void excluir(){
	int i, a, aux, cont=0, j, k,l, cresc=0, m;
	system("CLS");
	
	if(cad < 1)
		printf("Cadastre pelo menos um aluno\n");
	else{
		
	a = cadastro[0].saldo;
	for(i=0 ; i < cad ; i++){
		if(cadastro[i].saldo < a){
			aux = a;
			a = cadastro[i].saldo;
			cadastro[i].saldo = aux;
			cont=0;
		}
		if(cadastro[i].saldo == a)
			cont++;
	}
	for(m=0; i < cad ; m++){
		if(cadastro[m].saldo == a){
			auxx.saldo = cadastro[cresc].saldo;
			cadastro[cresc].saldo = cadastro[i].saldo;
			cadastro[m].saldo = auxx.saldo;
			cresc++;
		}
	} 
	for(j = 0; j < cont; j++){
		for(l=0; l < cad; l++){
		if(cadastro[j].saldo == a){
			for(k=1; k < cad; k++){
				strcpy(auxx.nome,cadastro[k-1].nome);
				strcpy(cadastro[k-1].nome,cadastro[k].nome);
				strcpy(cadastro[k].nome,auxx.nome);
				
				auxx.nmr = cadastro[k-1].nmr;
				cadastro[k-1].nmr = cadastro[k].nmr;
				cadastro[k].nmr = auxx.nmr;
				
				auxx.saldo = cadastro[k-1].saldo;
				cadastro[k-1].saldo = cadastro[k].saldo;
				cadastro[k].saldo =  auxx.saldo;
				}
		}
	}
		cad--;
	}
}
		printf("Conta(s) Excluida(s) com sucesso!\n");
	return;		
}
void exibir(){
	int i, a=1;
	
	system("CLS");
	
	for(i=0; i < cad ; i++){
		printf("%d Cliente\n", i+1);
		printf("Nome do Cliente: %s\n", cadastro[i].nome);
		printf("Numero da conta: %d\n", cadastro[i].nmr);
		printf("\n");
		printf("Saldo da conta: %.2lf\n", cadastro[i].saldo);
		printf("\n\n");
	}
	while(a !=0){
	printf("Digite zero para voltar ao menu\n");
	scanf("%d", &a);
}
	system("CLS");
	return;
}
int main(){
	
	while(1){
		menu();
		int a;
		scanf("%d", &a);
		switch(a){
			case 1:
				cadastrar();
			break;
			case 2:
				busca();
			break;
			case 3:
				excluir();
			break;
			case 4:
				exibir();
			break;
			case 0:
				return 0;
			break;
			default: 
				system("CLS");
				printf("Operacao invalida\n");
				
}
}
return 0;
}
