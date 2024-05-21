#include <stdio.h>
#include <stdlib.h>

void menu()
{
    printf("1 para inserir\n");
    printf("2 para excluir\n");
    printf("3 para exibir\n");
    printf("4 para esvaziar\n");
    printf("0 para sair\n\n");
}
int tamanho=0;

void fila_inserir(int *vet, int elemento)
{

    vet[tamanho] = elemento;

    tamanho++;
}

int fila_excluir(int *vetor)
{
    int i,aux,x;

    for(i=1; i<tamanho-1; i++)
    {
        aux = vetor[i-1];
        vetor[i-1] = vetor[i];
        vetor[i] = aux;
    }

    x= vetor[tamanho-1];
    return x;
}

int main()
{
    int vet[10],i;

    for(i=0; i<10; i++)
    {
        vet[i] = -1;
    }

    char op,c;

    while(1)
    {
        menu();
        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':

            system("CLS");
            printf("Digite o elemento que deseja inserir :");

            scanf("%c",&c);
            getchar();

            fila_inserir(vet,c);


            break;

            case '2':

            fila_excluir(vet);

            break;

            case '3':

                system("CLS");

                printf("FILA : ");

                for(i=0; i<10; i++)
                {
                    if(vet[i] == 0)
                        break;
                    else
                        printf("%d ",vet[i]);
                }
                printf("\n");

            break;

            case '4':

                for(i=0; i<tamanho; i++)
                {
                    fila_excluir(vet);
                }

            break;

            case '0':
                return 0;
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
