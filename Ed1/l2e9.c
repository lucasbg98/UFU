#include <stdio.h>

void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar um valor ao estoque  	        |\n");
    printf("|    2 para excluir um valor ao estoque             |\n");
    printf("|    3 para exibir as estatisticas do produto       |\n");
    printf("|    0 para sair                                    |\n");
    printf("-----------------------------------------------------\n\n-->");
}

void adcionar(int vetQ[], double vetP[], double *saldo){
	
	int x, op, y;
	double p;
	
	printf("Insira qual produto deseja adcionar\n Arroz(1) Feijao(2) Biscoito(3) Molho de Tomate(4)\n");
	
	scanf("%d", &op);
	switch(op){
		case 1:
			printf("Insira a Quantidade de Arroz que deseja adcionar\n");
			scanf("%d", &x);
			
			p = x * vetP[0];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a compra?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Compra cancelada\n");
			else if(y == 1){
				if(*saldo - p < 0)
					printf("Saldo insuficiente para compra! Operacao cancelada\n");
					
				else{
					vetQ[0] += x;
					*saldo -= p;
					
					printf("Produto comprado com sucesso!\n");
				}
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a compra foi cancelada!\n");
		break;
		case 2:
			printf("Insira a Quantidade de Feijao que deseja adcionar\n");
			scanf("%d", &x);
			
			p = x * vetP[1];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a compra?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Compra cancelada\n");
			else if(y == 1){
				if(*saldo - p < 0)
					printf("Saldo insuficiente para compra! Operacao cancelada\n");
					
				else{
					vetQ[1] += x;
					*saldo -= p;
					
					printf("Produto comprado com sucesso!\n");
				}
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a compra foi cancelada!\n");
		break;	 
		case 3:
			printf("Insira a Quantidade de Biscoito que deseja adcionar\n");
			scanf("%d", &x);
			
			p = x * vetP[2];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a compra?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Compra cancelada\n");
			else if(y == 1){
				if(*saldo - p < 0)
					printf("Saldo insuficiente para compra! Operacao cancelada\n");
					
				else{
					vetQ[2] += x;
					*saldo -= p;
					
					printf("Produto comprado com sucesso!\n");
				}
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a compra foi cancelada!\n");
		break;
		case 4:
			printf("Insira a Quantidade de Molho de Tomate que deseja adcionar\n");
			scanf("%d", &x);
			
			p = x * vetP[3];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a compra?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Compra cancelada\n");
			else if(y == 1){
				if(*saldo - p < 0)
					printf("Saldo insuficiente para compra! Operacao cancelada\n");
					
				else{
					vetQ[3] += x;
					*saldo -= p;
					
					printf("Produto comprado com sucesso!\n");
				}
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a compra foi cancelada!\n");
		break;
		default:
			printf("Opcao invalida!\n");
		}
}

void retirar(int vetQ[], double vetP[], double *saldo){
	
	int y, x, op;
	double p;
	
	printf("Insira qual produto deseja Vender\n Arroz(1) Feijao(2) Biscoito(3) Molho de Tomate(4)\n");
	
	scanf("%d", &op);
	switch(op){
		case 1:
			printf("Insira a Quantidade de Arroz que deseja Vender\n");
			scanf("%d", &x);
			
			if(vetQ[0] < x)
				printf("Quantidade de produtos invalida, a venda foi cancelada!\n");
			else{
			p = x * vetP[0];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a venda?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Compra cancelada\n");
			else if(y == 1){
				*saldo += p;
				vetQ[0] -= x;
					
				printf("Produto vendido com sucesso!\n");
				
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a compra foi cancelada!\n");
			}
		break;
		case 2:
			printf("Insira a Quantidade de Feijao que deseja Vender\n");
			scanf("%d", &x);
			
			if(vetQ[1] < x)
				printf("Quantidade de produtos invalida, a venda foi cancelada!\n");
			else{
			p = x * vetP[1];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a venda?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Venda cancelada\n");
			else if(y == 1){
				*saldo += p;
				vetQ[1] -= x;
					
				printf("Produto vendido com sucesso!\n");
				
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a venda foi cancelada!\n");
			}
		break;
		case 3:
			printf("Insira a Quantidade de Biscoito que deseja Vender\n");
			scanf("%d", &x);
			
			if(vetQ[2] < x)
				printf("Quantidade de produtos invalida, a venda foi cancelada!\n");
			else{
			p = x * vetP[2];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a venda?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Venda cancelada\n");
			else if(y == 1){
				*saldo += p;
				vetQ[2] -= x;
					
				printf("Produto vendido com sucesso!\n");
				
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a venda foi cancelada!\n");
			}
		break;
		case 4:
			printf("Insira a Quantidade de Molho de Tomate que deseja Vender\n");
			scanf("%d", &x);
			
			if(vetQ[3] < x)
				printf("Quantidade de produtos invalida, a venda foi cancelada!\n");
			else{
			p = x * vetP[3];
			
			printf("O valor eh de %.2lfR$, deseja prosseguir com a venda?\n Digite 1 para Sim e 0 para Nao\n", p);
			scanf("%d", &y);
			
			if(y == 0)
				printf("Venda cancelada\n");
			else if(y == 1){
				*saldo += p;
				vetQ[3] -= x;
					
				printf("Produto vendido com sucesso!\n");
				
			}
			else if( y != 0 && y != 1)
				printf("Operacao invalida, a venda foi cancelada!\n");
			}
		break;
		default:
			printf("operacao inválida!\n");
		break;
	}
}
		
void dados(int vetQ[], double vetP[], double *saldo){
	
	for(int i = 0; i < 4; i++){
		if(i == 0)
			printf("Arroz:\n Preco: %.2lfR$\n Qnt em Estoque: %d\n", vetP[i], vetQ[i]);
		else if(i == 1)
			printf("Feijao:\n Preco: %.2lfR$\n Qnt em Estoque: %d\n", vetP[i], vetQ[i]);
		else if(i == 2)
			printf("Biscoito:\n Preco: %.2lfR$\n Qnt em Estoque: %d\n", vetP[i], vetQ[i]);
		else if(i == 3)
			printf("Molho de Tomate:\n Preco: %.2lfR$\n Qnt em Estoque: %d\n", vetP[i], vetQ[i]);
	}
	
	printf("Saldo no caixa: %.2lf\n", *saldo);
	
}
		
int main(){
	
	int vetQ[4], op;
	double saldo, vetP[4];
	
	printf("Insira o saldo inicial: \n");
	scanf("%lf", &saldo);
	
	for(int i = 0; i < 4; i++){
		vetQ[i] = 0;
	}
	
	vetP[0] = 1;
	vetP[1] = 1.5;
	vetP[2] = 2;
	vetP[3] = 2.5;
	
	

		while(1){
			menu();
			scanf("%d", &op);
			switch(op){
				case 1:
				
					adcionar(vetQ, vetP, &saldo);
				
				break;
				case 2:
					
					retirar(vetQ, vetP, &saldo);
					
				break;
				case 3:
					
					dados(vetQ, vetP, &saldo);
					
				break;
				case 0:
					return 0;
				break;
			}
		}
return 0;
}
