#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct Node
{
    char elemento;
    struct Node *prox;
};

typedef struct Node node;

void menu()
{
    printf("[1] para inserir elementos na fila\n");
    printf("[2] para excluir primeiro elemento da fila\n");
    printf("[3] para excluir um elemento especifico\n");
    printf("[4] para realizar uma busca\n");
    printf("[5] para esvaziar a fila\n");
    printf("[6] para exibir elementos da fila\n");
    printf("[0] para finalizar o programa\n\n");
}

int fila_size(node *estrutura)
{
    if(estrutura->prox == NULL)
        return 0;

    else
    {
        int cnt=1;
        node *aux = estrutura->prox;

        while(aux->prox != NULL)
        {
            aux = aux->prox;
            cnt++;
        }
        return cnt;
    }


}

int fila_inserir(node *estrutura,char element)
{


    node *novo = (node *) malloc(sizeof(node));

    if(novo == NULL)
    {
        printf("Nao eh possivel inserir elementos -Memoria cheia-\n");
    }
    else
    {
        novo->elemento = element;
        novo->prox = NULL;

        if( !fila_size(estrutura) )
        {

            estrutura->prox = novo;
        }
        else
        {
             node *temp = estrutura->prox;

             while(temp->prox != NULL)
                temp = temp->prox;

             temp->prox = novo;
        }


    }

}

char fila_excluir(node *estrutura)
{
        node *aux = estrutura->prox;
        node *aux2 = aux->prox;

        char c = aux->elemento;

        free(aux);

        estrutura->prox = aux2;

        return c;
}

int fila_excluir2(node *estrutura, char element)
{
    node fila2,*aux;
    fila2.prox = NULL;
    fila2.elemento = '\0';

    int op=0;

    while(fila_size(estrutura))
    {
        aux = estrutura->prox;

        if(aux->elemento != element)
        {
            fila_inserir(&fila2,fila_excluir(estrutura));
        }
        else
        {
            fila_excluir(estrutura);
            op++;
        }
    }

    while(fila_size(&fila2))
    {
        fila_inserir(estrutura,fila_excluir(&fila2));
    }

    if(op)
        return 1;
    else
        return 0;
}

void fila_exibir(node *estrutura)
{
   node *aux = estrutura ->prox;
   node fila2;
   fila2.prox = NULL;
   fila2.elemento = '\0';

    if(!fila_size(estrutura))
    {
        printf("Operacao invalida -fila vazia-\n\n");
        return;
    }

    printf("Fila :");

   do
   {
        printf(" %c ",aux->elemento);

        fila_inserir(&fila2,aux->elemento);
        fila_excluir(estrutura);

        aux = estrutura->prox;

   }while(fila_size(estrutura) != 0);

   while(fila_size(&fila2))
   {
       fila_inserir(estrutura,fila_excluir(&fila2));
   }

   printf("\n\n");
}

void fila_find(node *estrutura, char element)
{
    node fila2,*aux;
    fila2.prox = NULL;
    fila2.elemento = '\0';

    int op=0,cnt=0;

    while(fila_size(estrutura))
    {
        cnt++;
        aux = estrutura->prox;

        if(aux->elemento == element)
        {
            printf("Elemento encontrado na posicao %d\n",cnt);
            op++;
        }

        fila_inserir(&fila2,fila_excluir(estrutura));
    }

    while(fila_size(&fila2))
    {
        fila_inserir(estrutura,fila_excluir(&fila2));
    }

    if(op == 0)
        printf("Elemento nao encontrado!\n\n");
    else
        printf("\n");



}

int fila_clear(node *estrutura)
{
    if(!fila_size(estrutura))
        return 0;
    else
    {
        node *aux;

        while(fila_size(estrutura))
        {
            fila_excluir(estrutura);
        }

        return 1;
    }
}

int main()
{
    node fila;

    fila.elemento = '\0';
    fila.prox = NULL;

    while (1)
    {
        menu();
        char op,c;
        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':
                system("CLS");

                printf("Digite o caractere que deseja inserir :");
                scanf("%c",&c);
                getchar();

                system("CLS");

                if(fila_inserir(&fila,c))
                {
                    printf("Elemento inserido com sucesso!\n\n");
                }
                else
                {
                    printf("Impossivel inserir elementos -memoria cheia-!\n\n");
                }

            break;

            case '2':

                system("CLS");

                if(!fila_size(&fila))
                {
                    printf("Impossivel excluir elementos -fila vazia-\n\n");
                    system("pause");
                }
                else
                {
                    printf("O elemento |%c| foi excluido com sucesso!\n\n",fila_excluir(&fila));
                }

            break;

            case '3':

                system("CLS");

                printf("Digite o elemento que deseja excluir :");
                scanf("%c",&c);
                getchar();

                system("CLS");

                if(fila_excluir2(&fila,c))
                {
                    printf("Elementos excluidos com sucesso!\n\n");
                }
                else
                {
                    printf("Elemento nao encontrado!\n\n");
                }

            break;

            case '4':

                system("CLS");

                printf("Digite o caractere que deseja buscar :");
                scanf("%c",&c);
                getchar();

                system("CLS");

                fila_find(&fila,c);

            break;

            case '5':

                system("CLS");

                if(fila_clear(&fila))
                    printf("Fila esvaziada com sucesso!\n\n");
                else
                    printf("A fila nao contem elementos!\n\n");


            break;

            case '6':
                system("CLS");

                fila_exibir(&fila);
            break;

            default:
                printf("Operacao invalida!\n\n");
                system("pause");
        }
    }

    return 0;
}


/*

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
