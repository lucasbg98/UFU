#include <stdio.h>
#include <stdlib.h>

int cad=0,i,j;

void menu()
{
    printf("[1] para inserir no inicio\n");
    printf("[2] para inserir no fim\n");
    printf("[3] para remover no inicio\n");
    printf("[4] para remover no fim\n");
    printf("[5] para remover especifico\n");
    printf("[6] para realizar uma busca\n");
    printf("[7] para exibir elementos\n");
    printf("[8] para contar elementos\n");
    printf("[9] para esvaziar a lista\n");
    printf("[0] para finalizar o programa\n\nOpcao :");
}

void inserir_inicio(int *vetor,int elemento)
{
    cad++;

    for(i=cad; i>0; i--)
    {
        int aux = vetor[i-1];
        vetor[i-1] = vetor[i];
        vetor[i] = aux;
    }
    vetor[0] = elemento;
}

void inserir_fim(int *vetor,int elemento)
{
    vetor[cad] = elemento;
    cad++;
}

void exibir(int *vetor)
{
    for(i=0; i<cad; i++)
    {
        printf("        - %d -\n",vetor[i]);
    }
}

int pop_inicio(int *vetor)
{

    for(i=1; i<cad; i++)
    {
        int aux = vetor[i-1];
        vetor[i-1] = vetor[i];
        vetor[i] = aux;
    }
    cad--;
}

int pop_fim(int *vetor)
{
    cad--;
    vetor[cad] = -1;
}

int busca(int *vetor, int elemento)
{
    int op=0;
    for(i=0; i<cad-1; i++)
    {
        if(vetor[i] == elemento)
            op++;
    }
    return op;
}

int pop_espec(int *vetor,int elemento)
{
    for(i=0; i<cad; i++)
    {
        if(vetor[i] == elemento)
        {
            for(j=i+1; j<cad; j++)
            {
                int aux = vetor[j-1];
                vetor[j-1] = vetor[j];
                vetor[j] = aux;
            }
            cad--;
            i--;
        }
    }

    return elemento;
}

void esvaziar(int *vetor)
{
    cad--;

    do
    {
        vetor[cad] = -1;
        cad--;
    }while(cad);
}

int main()
{
    int lista[10];
    i=10;
    while(i)
    {
        i--;
        lista[i] = -1;
    }

    while(1)
    {
        menu();

        char op;
        scanf("%c",&op);
        getchar();

        int x;

        switch(op)
        {
            case '1':
                system("CLS");

                printf("Digite o valor que deseja inserir :");
                scanf("%d",&x);
                getchar();

                system("CLS");

                inserir_inicio(lista,x);
                break;

             case '2':
                system("CLS");

                printf("Digite o valor que deseja inserir :");
                scanf("%d",&x);
                getchar();

                system("CLS");

                inserir_fim(lista,x);
                break;

            case '3':
                system("CLS");

                pop_inicio(lista);
                break;

            case '4':
                system("CLS");

                pop_fim(lista);
                break;

            case '5':
                system("CLS");

                printf("Digite o valor que deseja excluir :");
                scanf("%d",&x);
                getchar();

                system("CLS");

                if(busca(lista,x))
                    printf("Elemento(s) - %d - escluido(s) com sucesso!\n\n",pop_espec(lista,x));
                else
                    printf("Elemento nao encontado!\n\n");
                break;

            case '6':
                system("CLS");

                printf("Digite o elemento que deseja buscar:");
                scanf("%d",&x);
                getchar();
                system("CLS");

                if(busca(lista,x))
                    printf("Elemento(s) encontrado(s)!\n\n");
                else
                    printf("Elemento nao encontado!\n\n");
                break;

            case '7':
                system("CLS");

                exibir(lista);
                break;

            case '8':
                system("CLS");
                printf("A lista esta com %d elementos!\n\n",cad);
                break;

            case '9':
                system("CLS");
                esvaziar(lista);
                printf("Lista esvaziada com sucesso!\n\n");
                break;

            case '0':
                return 0;

            default:
                system("CLS");
                printf("Operacao invalida!\n\n");
        }


    }

    return 0;
}

/*

1
1
1
2
1
3
1
4
1
5


*/
