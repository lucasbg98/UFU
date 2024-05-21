#include <stdio.h>
#include <stdlib.h>
#include <string.h>

char retorno_string[1000];
int cnt=0;
void menu()
{
    printf("[1] para realizar uma transferencia\n");
    printf("[2] para pagar contas\n");
    printf("[3] para ver a fila do banco\n");
    printf("[4] para exibir informacoes dos clientes\n");
    printf("[5] para cadastrar novos clientes\n");
    printf("[0] para finalizar o programa\n\n");
}

 struct fila
    {
        char nome[100];
        double saldo;
        int conta;
        double limite;
    };

struct Node
{
    struct fila cliente;

    struct Node *prox;
};

typedef struct Node node;

void fila_push(node *estrutura,int x,double y,char str[100],double lim)
{


    node *novo = (node*) malloc(sizeof(node));
    novo->cliente.conta = x;
    novo->cliente.saldo = y;
    strcpy(novo->cliente.nome,str);
    novo->prox = NULL;
    novo->cliente.limite = lim;

    if(estrutura->prox == NULL)
        estrutura->prox = novo;

    else
    {
        node *aux = estrutura->prox;

        while(aux->prox != NULL)
            aux = aux->prox;

        aux->prox = novo;
    }

}

void fila_pop(node *estrutura)
{
    node *aux = estrutura->prox;
    node *aux2 = aux->prox;

    free(aux);

    estrutura->prox = aux2;
}

void fila_exibir(node *estrutura)
{
    node *aux=estrutura->prox;

    while(aux != NULL)
    {
        printf("Nome :%s | ",aux->cliente.nome);
        printf(" Conta :%d | ",aux->cliente.conta);
        printf(" Saldo :R$%.2lf ",aux->cliente.saldo);
        printf(" Limite :R$%.2lf \n\n",aux->cliente.limite);
        aux = aux->prox;
    }
}

void fila_banco_exibir(node *estrutura)
{
    node *aux=estrutura->prox;

    printf("Fila do banco neste momento\n->");
    while(aux != NULL)
    {
        printf("%s    ",aux->cliente.nome);
        aux = aux->prox;
    }
    printf("\n\n");
}

int checasaldo(node *estrutura,double valor)
{
    node *aux = estrutura->prox;

            if(aux->cliente.saldo-valor < aux->cliente.limite)
                return 0;
            else
                return 1;
}

int busca(node *estrutura,int x)
{
    int op=0;

    node *aux=estrutura->prox;

    while(aux != NULL)
    {
        if(aux->cliente.conta == x)
        {
            op++;
            break;
        }
        aux = aux->prox;
    }

    if(op)
        return 1;
    else
        return 0;

}

void transferencia(node *estrutura,int recebe,double valor)
{
    int j=cnt;

    node *aux2 = estrutura->prox;

    while(j)
    {
        aux2 = aux2->prox;
        j--;
    }

    aux2->cliente.saldo -=valor;

    node *aux=estrutura->prox;

    while(aux != NULL)
    {
        if(aux->cliente.conta == recebe)
        {
            aux->cliente.saldo += valor;
            break;
        }
        aux = aux->prox;
    }


}

void pagaconta(node *estrutura,double valor)
{
    int op=0,j=cnt;

    node *aux=estrutura->prox;

    while(j)
    {
        aux = aux->prox;
        j--;
    }

    aux->cliente.saldo -= valor;
}

int main()
{
    node fila;
    fila.cliente.conta = 0;
    fila.cliente.saldo = 0;
    strcpy(fila.cliente.nome,"\0");
    fila.prox = NULL;

    node fila_banco;
    fila_banco.cliente.conta = 0;
    fila_banco.cliente.saldo = 0;
    strcpy(fila_banco.cliente.nome,"\0");
    fila_banco.prox = NULL;

    char op,c,str[100];
    int x,h=1;
    double y;

    do{
        system("CLS");

                printf("Digite o nome do cliente: ");
                gets(str);

                printf("Digite o numero da conta do cliente :");
                scanf("%d",&x);
                getchar();

                printf("Digite o saldo da conta do cliente :");
                scanf("%lf",&y);
                getchar();

                printf("Digite o limite da conta do cliente :");
                double lim;
                scanf("%lf",&lim);
                getchar();

                system("CLS");
                fila_push(&fila_banco,x,y,str,lim);
                fila_push(&fila,x,y,str,lim);

                printf("Digite zero para sair :");
                scanf("%d",&h);
                getchar();
    }while(h);

    system("CLS");

    while(1)
    {
        node *aux = fila_banco.prox;

        if(aux->cliente.nome)
            printf("Cliente que esta sendo atendido :%s\n\n",aux->cliente.nome);
        else
            printf("Nao ha clientes na fila!\n\n");

        menu();
        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '4':

                system("CLS");

                fila_exibir(&fila);

            break;

            case '1':

                system("CLS");

                    printf("Digite o numero da conta bancaria que recebera a transferencia :");
                    int e;
                    scanf("%d",&e);
                    getchar();

                    if(busca(&fila,e))
                    {
                        printf("Digite o valor que deseja transferir :");
                        double d;

                        scanf("%lf",&d);
                        getchar();

                        if(!checasaldo(&fila_banco,d))
                        {
                            system("CLS");
                            printf("O saldo da sua conta eh insufisciente!\n\n");
                        }
                        else{
                            system("CLS");
                            transferencia(&fila,e,d);
                            cnt++;
                            fila_pop(&fila_banco);
                        }
                    }

                    else{
                        system("CLS");
                        printf("Conta bancaria nao encontrada!\n\n");
                    }


            break;

            case '2':

                system("CLS");

                    printf("Digite o valor da conta a ser paga :");
                    double d;
                    scanf("%lf",&d);
                    getchar();

                    if(checasaldo(&fila,d))
                    {
                        system("CLS");
                        pagaconta(&fila,d);
                        cnt++;
                        fila_pop(&fila_banco);
                        printf("Conta paga com sucesso!\n\n");
                    }
                    else
                    {
                        system("CLS");
                        printf("Saldo insufisciente!\n\n");
                    }


            break;

            case '3':

                system("CLS");
                fila_banco_exibir(&fila_banco);

            break;

            case '5':

                do{
                    system("CLS");

                    printf("Digite o nome do cliente: ");
                    gets(str);

                    printf("Digite o numero da conta do cliente :");
                    scanf("%d",&x);
                    getchar();

                    printf("Digite o saldo da conta do cliente :");
                    scanf("%lf",&y);
                    getchar();

                    printf("Digite o limite da conta do cliente :");
                    double lim;
                    scanf("%lf",&lim);
                    getchar();

                    system("CLS");
                    fila_push(&fila_banco,x,y,str,lim);
                    fila_push(&fila,x,y,str,lim);

                    printf("Digite zero para sair :");
                    scanf("%d",&h);
                    getchar();

                }while(h);

            break;
        }
        system("pause");
        system("CLS");
    }
}

/*


Cesar
1000
5000
-1000
1
Henrique
2000
4000
-1000
1
Marcal
3000
1000
-1000
1
Cardoso
4000
100
-1000
0

1
4000
500
1
4000
500




*/
