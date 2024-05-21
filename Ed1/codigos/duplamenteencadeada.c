#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct Node
{
    int elemento;
    struct Node *prox;
    struct Node *ant;
};
typedef struct Node node;

void menu()
{
    printf("[1] para inserir\n");
    printf("[2] para remover\n");
    printf("[3] para buscar\n");
    printf("[4] para exibir\n");
    printf("[5] para contar\n");
    printf("[6] para esvaziar\n\nOpcao :");
}

void inserir(node *estrutura, int elemento)
{
    node *novo = (node *) malloc(sizeof(node));
    novo->elemento = elemento;
    novo->prox = NULL;
    novo->ant = NULL;

    if(estrutura->prox == NULL)
    {
        estrutura->prox = novo;
        novo->ant = estrutura;
    }
    else
    {
        node *aux = estrutura->prox;
        while(aux->prox != NULL)
        {
            aux = aux->prox;
        }
        aux->prox = novo;
        novo->ant = aux;
    }
}

int busca(node *estrutura,int elemento)
{
    node *aux = estrutura->prox;
    int op=0;

    while(aux != NULL)
    {
        if(aux->elemento == elemento)
        {
            op++;
            return op;
        }
        aux = aux->prox;
    }
    return 0;
}

int pop(node *estrutura,int elemento)
{
    node *aux = estrutura->prox;

    if(aux->elemento == elemento)
    {
        node *temp = aux->prox;
        estrutura->prox = temp;
        temp->ant = estrutura;

        free(aux);
    }
    else
    {
        while(busca(estrutura,elemento))
        {
            node *aux = estrutura->prox;

            while(aux->elemento != elemento && aux->prox != NULL)
            {
                aux = aux->prox;
            }

            if(aux->prox == NULL)
            {
                node *a = aux->ant;
                a->prox = NULL;
                free(aux);
            }
            else
            {
                node *temp = aux->ant;
                temp->prox = aux->prox;

                node*temp2 = aux->prox;
                temp2->ant = temp;

                free(aux);
            }

        }
    }
}

int contar(node *estrutura)
{
    node *aux = estrutura->prox;
    int cnt=0;

    while(aux != NULL)
    {
        cnt++;
        aux = aux->prox;
    }
    return cnt;
}

void exibir(node *estrutura)
{
    node *aux = estrutura->prox;
    printf("       *Lista*\n\n");
    while(aux != NULL)
    {
        printf("        - %d -\n",aux->elemento);
        aux = aux->prox;
    }
    printf("\n");
    system("pause");
    system("CLS");
}

void exibir_recursivo(node *p)
{
    if(p == NULL)
    {
        printf("\n");
        return ;
    }

    printf("%d ",p->elemento);

    return exibir_recursivo(p->prox);
}

void esvaziar(node *estrutura)
{
    node *aux = estrutura->prox;

    while(aux->prox != NULL)
    {
        aux = aux->prox;
    }

    while(estrutura->prox != NULL)
    {
        node *temp = aux;
        aux = aux->ant;
        temp->prox = NULL;

        free(temp);
    }
}

int main()
{
    node lista;
    lista.prox = NULL;
    lista.ant = NULL;
    lista.elemento = '\0';

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

                inserir(&lista,c);

                break;

            case '2':
                system("CLS");
                printf("Digite o(s) elemento(s) que deseja excluir :");
                scanf("%d",&c);
                getchar();

                system("CLS");

                 if(busca(&lista,c)){
                    pop(&lista,c);
                    printf("Elemento(s) excluido(s) com sucesso!\n\n");
                }else
                    printf("ERRO -elemento nao encontrado!\n\n");
                break;

            case '3':
                system("CLS");
                printf("Digite o elemento que deseja buscar:");
                scanf("%d",&c);
                getchar();

                system("CLS");

                if(busca(&lista,c))
                    printf("Elemento encontado!\n\n");
                else
                    printf("ERRO -elemento nao encontado!-\n\n");

                break;

            case '4':
                system("CLS");
                node *aux = &lista;
                exibir_recursivo(aux->prox);

                break;

            case '5':
                system("CLS");

                printf("A lista esta com %d elementos!\n\n",contar(&lista));

                break;

            case '6':
                system("CLS");

                esvaziar(&lista);

                printf("Lista esvaziada com sucesso!\n\n");

        }
    }


    return 0;
}


/*

1
1
1
3
1
5
1
7


*/
