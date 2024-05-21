#include <Stdio.h>

int i,tam=0;;

void push(int *vetor, int elemento);
int pop(int *vetor);
void exibir(int *vetor);
void menu()
{
    printf("PENSA NUM MENU BOLADAO AQUI\n");

}

int main()
{
    int pilha[10];
    for(i=0; i<10; i++)
        pilha[i] = -1;

    while(1)
    {
        menu();
        char op;
        int valor;


        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':
                system("CLS");
                printf("Digite o valor que deseja inseir :");
                scanf("%d",&valor);
                getchar();
                system("CLS");

                push(pilha,valor);

                break;
            case '2':
                system("CLS");

                pop(pilha);

                break;

            case '3':
                system("CLS");

                exibir(pilha);

        }
    }
}

void push(int *vetor , int elemento)
{
    vetor[tam] = elemento;
    tam++;
}

int pop(int *vetor)
{
    i=0;

    while(vetor[i] != -1)
    {
        i++;
    }
    vetor[i-1] = -1;
    tam--;
}

void exibir(int *vetor)
{
    for(i=0; i<tam; i++)
    {
        printf("%d\n",vetor[i]);
    }
}

