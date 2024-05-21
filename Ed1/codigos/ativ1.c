#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int cad=0;

struct cliente {

    char nome[100];
    int codigo;
    double saldo;
}clt[15],aux;

int menu(){
    printf("------------------- MENU -------------------\n");
    printf("1 para cadastrar clientes\n");
    printf("2 para realizar uma pesquisa\n");
    printf("3 para excluir clientes com menor saldo\n");
    printf("4 para exibir todos os clientes cadastrados\n");
    printf("0 para finalizar o programa\n->");

    int op;
    scanf("%d",&op);

    return op;

}

void cadastro(){
    system("CLS");

    if(cad<=15){

            system("CLS");
            printf("Voce ja cadastrou %d de 15 clientes!\n",cad);

            printf("Digite o nome do cliente: ");
            fflush(stdin);
            gets(clt[cad].nome);

            printf("Digite o codigo da conta: ");
            int cod;
            scanf("%d",&cod);
            printf("\n");

            int op=1,i;
            if(cad==0) clt[cad].codigo=cod;

            if(cad>0){
                while(op){
                    int a=0;
                    for(i=0; i<cad; i++){
                        if(clt[i].codigo == cod){
                            printf("Este codigo ja esta sendo utilizado, favor informar outro :");
                            scanf("%d",&cod);
                            printf("\n");
                            a=1;
                            break;
                        }
                    }
                    if(a==0) op=0;
                }
            clt[cad].codigo=cod;

            }
            printf("Digite o saldo da conta\n");
            scanf("%lf",&clt[cad].saldo);
            cad++;

            system("CLS");
    }


    else {
        printf("Nao eh possivel cadastrar mais que 15 clientes, voce ja cadastrou :%d\n",cad);

    }
}

void pesquisa(){
    system("CLS");
    int k=0,i=0;

    printf("Digite o nome do cliente :");
    char st[100];
    fflush(stdin);
    gets(st);

    int op=0;

    for(; i<cad; i++){
        if(strcmp(clt[i].nome,st)==0){
            op++;
            printf("Cliente encontrado !\n");
            printf("Nome :%s  Saldo :%.2lf\n\n",clt[i].nome,clt[i].saldo);
        }
    }
    if(op==0)
        printf("Cliente nao cadastrado\n");
}

void excluir(){
    system("CLS");
    if(cad>=1){
    double menor=clt[0].saldo;
    int i=0,j;

    for(; i<cad; i++){
        if(clt[i].saldo<menor){
            menor=clt[i].saldo;
        }
    }

    printf("%lf\n",menor);
        j=cad;

        for(i=0; i<j; i++){
            if(clt[i].saldo==menor){
                if(i==14){
                    cad--;
                    break;
                }
                cad--;

                strcpy(aux.nome,clt[i].nome);
                strcpy(clt[i].nome,clt[i+1].nome);
                strcpy(clt[i+1].nome,aux.nome);

                aux.codigo=clt[i].codigo;
                clt[i].codigo=clt[i+1].codigo;
                clt[i+1].codigo=aux.codigo;

                aux.saldo=clt[i].saldo;
                clt[i].saldo=clt[i+1].saldo;
                clt[i+1].saldo=aux.saldo;



            }
        }
    }
    else
        printf("Eh necessario cadastrar pelo menos 1 cliente \n");
}

void exib(){
    system("CLS");
    int i=0;

    if(cad<1) printf("Nao ha clientes cadastrados !\n");
    else{
        printf("----------------- CLIENTES -----------------\n");

        for(; i<cad; i++){
            printf("Nome :%s    Codigo :%d     Saldo :%.2lf\n\n",clt[i].nome,clt[i].codigo,clt[i].saldo);
        }

        printf("--------------------------------------------\n\n");

    }
}

int main(){

    int x=1;

    while(x){
        int op;

        op=menu();

        switch(op){
            case 1:
                cadastro();
            break;

            case 2:
                pesquisa();
            break;

            case 3:
                excluir();
            break;

            case 4:
                exib();
            break;

            case 0:
                x=0;
            break;

            default:
                system("CLS");
                printf("Operacao invalida\n\n");
        }

    }

return 0;
}


/*

1
Cesar Henrique
1000
10.00
1
Lucas Bracanca
2000
5.00
1
Gabriel Veloso
3000
5.00
1
Marlon Brendo
4000
5.0
1
Lucas Gomes
5000
5.0






*/
