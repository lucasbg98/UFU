#include <stdio.h>
#include <stdlib.h>

struct Node
{
    int elemento;
    struct Node *prox;
};

typedef struct Node node;

void menu()
{
    printf("------------------ MENU -------------------\n");
    printf("[1] para inserir elementos\n");
    printf("[2] para excluir ultimo elemento inserido\n");
    printf("[3] para verificar elemento do topo\n");
    printf("[4] para exibir os elementos\n");
    printf("[0] para finalizar o programa\n");
    printf("-------------------------------------------\n\n");

}

void fila_push(node *estrutura,int x)
{
    node *novo = (node*) malloc(sizeof(node));
    novo->prox = NULL;
    novo->elemento = x;

    if(estrutura->prox == NULL)
    {
        estrutura ->prox = novo;
    }
    else
    {
        node *temp = estrutura->prox;

        while(temp->prox !=NULL){
            temp = temp->prox;
        }


        temp->prox = novo;
    }
}

int fila_pop(node *estrutura)
{
    node *aux = estrutura->prox;
    node *aux2 = aux->prox;

    int x =aux->elemento;

    free(aux);

    estrutura->prox = aux2;

    return x;

}

void fila_exibir(node *estrutura)
{
    node *aux = estrutura->prox;

    while(aux != NULL)
    {
        printf("%d ",aux->elemento);
        aux = aux->prox;
    }
}

int fila_top(node *estrutura)
{
    node *aux = estrutura->prox;

    while(aux->prox !=NULL)
        aux = aux->prox;

    return aux->elemento;
}

int main()
{
    node fila;
    fila.prox = NULL;
    fila.elemento = 0;

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

                printf("Digite o elemento que deseja inserir :");
                int x;
                scanf("%d",&x);
                getchar();

                system("CLS");

                fila_push(&fila,x);
                break;

            case '2':
                system("CLS");

                printf("Elemento excluido : %d\n",fila_pop(&fila));
                break;

            case '4':
                system("CLS");

                fila_exibir(&fila);
                printf("\n");
                break;

            case '3':
                system("CLS");

                printf("O elemento do topo eh :%d\n",fila_top(&fila));

        }

    }

    return 0;
}
