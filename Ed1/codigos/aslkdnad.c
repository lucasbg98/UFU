#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void menu()
{
    printf("[1] para inserir caracteres\n");
    printf("[2] para excluir primeiro caractere da fila\n");
    printf("[3] para excluir um caractere especifico\n");
    printf("[4] para realizar uma busca\n");
    printf("[5] para esvaziar a fila\n");
    printf("[6] para exibir a fila\n");
    printf("[0] para finalizar o programa\n\n");
}

int fila_size(char *vetor)
{
    int cnt=0,i;

    if(vetor[0] == '\0')
        return 0;

    for(i=0; i<strlen(vetor); i++)
    {
        cnt++;

        if(vetor[i] == '\0')
            break;

    }

    return cnt;
}

void fila_inserir(char *vetor,char elemento)
{
    vetor[fila_size(vetor)] = elemento;
}

char fila_excluir(char *vetor)
{
    int i,j;
    char aux,c=vetor[0];

    for(j=0; j<fila_size(vetor);j++)
    {
        for(i=1; i<fila_size(vetor)-1; i++)
        {
            aux = vetor[i-1];
            vetor[i-1] = vetor[i];
            vetor[i] = aux;
        }
    }

    vetor[fila_size(vetor)-1] = '\0';


    if(fila_size(vetor)==0)
        vetor[0] = '\0';
    else
        vetor[fila_size(vetor)-1] = '\0';

    return c;
}

int fila_excluir2(char *vetor,char elemento)
{
    int op=0;
    char aux[fila_size(vetor)];

    while(fila_size(vetor))
    {
        if(vetor[0] != elemento)
        {
            fila_inserir(aux,fila_excluir(vetor));
        }
        else
        {
            fila_excluir(vetor);
            op++;
        }
    }

    while(fila_size(aux))
    {
        fila_inserir(vetor,fila_excluir(aux));
    }

    if(op)
        return 1;
    else
        return 0;
}

void fila_find(char *vetor,char elemento)
{
    int op=0,cnt=0;
    char aux[fila_size(vetor)-1];

    system("CLS");

    while(fila_size(vetor)-1)
    {
        cnt++;
        fila_inserir(aux,fila_excluir(vetor));

        if(vetor[0] == elemento)
        {
            op++;
            printf("Caractere encontrado na posicao %d\n",cnt);
        }
    }

    while(fila_size(aux)-1)
    {
        fila_inserir(vetor,fila_excluir(aux));
    }

    if(!op)
        printf("Caractere nao encontrado!\n\n");
}

void fila_empty(char *vetor)
{

    while(fila_size(vetor)-1)
    {
        fila_excluir(vetor);
    }
}

void fila_exibir(char *vetor)
{
    char aux[fila_size(vetor)],c;

    int i;

    for(i=0; i<fila_size(aux); i++)
    {
        aux[i] = '\0';
    }

    printf("Fila :");

    int k= fila_size(vetor);

    while(k != 0)
    {
        c=vetor[0];

        printf("%c ",c);

        fila_inserir(aux,vetor[0]);
        fila_excluir(vetor);

        k--;
    }

    while(fila_size(aux))
    {
        fila_inserir(vetor,fila_excluir(aux));
    }
}

int main()
{
    printf("Digite o tamanho do vetor :");
    int x;

    scanf("%d",&x);
    getchar();

    char fila[x];

    int i;
    for(i=0; i<x; i++)
    {
        fila[i] = '\0';
    }

    system("CLS");

    while (1)
    {
        menu();
        char op;

        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':

                system("CLS");

                if(fila_size(fila)>=x)
                {
                    printf("A fila esta cheia !\n\n");
                }
                else
                {
                    printf("Digite o caractere que deseja inserir :");
                    char c;

                    scanf("%c",&c);
                    getchar();

                    system("CLS");

                    fila_inserir(fila,c);
                }

            break;

            case '2':

                system("CLS");

                if(!fila_size(fila))
                {
                    printf("A fila esta vazia!\n\n");

                }
                else
                {
                  printf("Elemento excluido : %c\n",fila_excluir(fila));
                }

            break;

            case '3':

                system("CLS");

                if(fila_size(fila) == 0)
                {
                    printf("A fila esta vazia!\n\n");
                }
                else
                {
                    printf("Digite o caractere que deseja excluir:");
                    char c;

                    scanf("%c",&c);
                    getchar();

                    if(fila_excluir2(fila,c))
                        printf("Caracteres excluidos com sucesso!\n\n");
                    else
                        printf("Caractere nao encontrado!\n\n");
                }

            break;

            case '4':
                system("CLS");

                if(!fila_size(fila))
                {
                    printf("A fila esta vazia!\n\n");
                }
                else
                {
                    printf("Digite o caractere que deseja buscar :");
                    char c;

                    scanf("%c",&c);
                    getchar();

                    fila_find(fila,c);
                }
            break;

            case '5':

                system("CLS");

                fila_empty(fila);
                printf("Fila esvaziada com sucesso!\n\n");

            break;

            case '6':
                system("CLS");

                fila_exibir(fila);
                printf("\n");

            break;

            case '7':
                system("CLS");


                printf("     %d\n",fila_size(fila));

            break;

            default:
                system("CLS");

                printf("Operacao invalida!\n\n");

                system("pause");

        }

    }

    return 0;
}


/*

10
1
A
1
B
1
C
1
D
1
E



*/
