#include <stdio.h>
#include <stdlib.h>


struct Node
{
    int elemento;
    struct Node *prox;
};

void menu()
{
    printf("1 para inserir valores\n");
    printf("2 para remover ultimo valor inserido\n");
    printf("3 para exibir elementos da pilha\n");
    printf("4 para verificar elemento do topo\n");
    printf("0 para finalizar o programa\n\n");
}

typedef struct Node node;

void pilha_push(node *estrutura, int elemento)
{
    node *aux = (node*) malloc(sizeof(node));
    aux->prox = NULL;
    aux->elemento = elemento;

    if(estrutura->prox == NULL)
    {
        estrutura->prox = aux;
    }
    else
    {
        node *temp = estrutura->prox;

        while(temp->prox !=NULL)
            temp = temp->prox;

        temp->prox = aux;
    }
}

int pilha_pop(node *estrutura)
{
    node *aux = estrutura->prox;
    node *temp;

    if(estrutura->prox == NULL)
    {
        return 0;
    }


    while(aux->prox !=NULL)
    {
        temp = aux;
        aux = aux->prox;
    }

    int x = aux->elemento;

    temp->prox = NULL;
    free(aux);

    return x;
}

void pilha_exibir(node *estrutura)
{
    node *aux = estrutura->prox;

    while(aux != NULL)
    {
        printf("|%d|\n",aux->elemento);
        aux = aux->prox;
    }
}

int pilha_top(node *estrutura)
{
    node *temp = estrutura->prox;

    while(temp->prox != NULL)
    {
        temp = temp->prox;
    }

    return temp->elemento;
}

int main()
{
    node stack;
    stack.prox = NULL;
    stack.elemento = 0;

    while(1)
    {
        menu();
        char op;
        int c;

        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':
                system("CLS");

                printf("Digite o elemento que deseja inserir :");
                scanf("%d",&c);
                getchar();
                system("CLS");

                pilha_push(&stack,c);
                break;

            case '2':
                system("CLS");

                pilha_pop(&stack);
                break;

            case '3':
                system("CLS");

                pilha_exibir(&stack);
                break;

            case '4':
                system("CLS");

                printf(" O elemento do topo eh : %d\n\n",pilha_top(&stack));
                break;

        }




    }


    return 0;
}
