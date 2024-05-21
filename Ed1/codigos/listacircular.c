#include <stdio.h>
#include <stdlib.h>

struct Node
{
    int elemento;
    struct Node *prox;
    struct Node *ant;
};
typedef struct Node node;

void menu()
{
    printf("[1] para inserir no inicio\n");
    printf("[2] para remover no inicio\n");
    printf("[3] para inserir no fim\n");
    printf("[4] para remover no fim\n");
    printf("[5] para remover especifico\n");
    printf("[6] para buscar\n");
    printf("[7] para exibir\n");
    printf("[8] para esvaziar\n\nOpcao :");
}

void inserir_inicio(node *estrutura, int elemento)
{
    node *novo = (node *) malloc(sizeof(node));
    novo->elemento = elemento;

    if(estrutura->prox == NULL)
    {
        estrutura->prox = novo;
        novo->ant = estrutura;

        novo->prox = estrutura;
        estrutura->ant = novo;
    }
    else
    {
        node *aux = estrutura->prox;

        estrutura->prox = novo;
        novo->ant = estrutura;

        novo->prox = aux;
        aux->ant = novo;
    }
}

void inserir_fim(node *estrutura, int elemento)
{
    node *novo = (node *) malloc(sizeof(node));
    novo->elemento = elemento;

    if(estrutura->prox == NULL)
    {
        estrutura->prox = novo;
        novo->ant = estrutura;

        novo->prox = estrutura;
        estrutura->ant = novo;
    }
    else
    {
        node *a = estrutura->prox;

        while(a->prox != estrutura)
        {
            a = a->prox;
        }

        a->prox = novo;
        novo->ant = a;

        novo->prox = estrutura;
        estrutura->ant = novo;
    }
}
void exibir(node *estrutura)
{
    node *aux = estrutura->prox;

    while(aux != estrutura)
    {
        printf("        - %d -\n",aux->elemento);
        aux = aux->prox;
    }
}

int excluir_inicio(node *estrutura)
{
    node *aux = estrutura->prox;

    estrutura->prox = aux->prox;
    aux->ant = estrutura;

    free(aux);
}

int buscar(node *estrutura, int elemento)
{
    node *aux = estrutura->prox;

    while(aux != estrutura)
    {
        if(aux->elemento == elemento)
        {
            return 1;
        }

        aux = aux->prox;
    }
    return 0;
}

int excluir_fim(node *estrutura)
{
    node *a = estrutura->ant;
    node *b = a->ant;

    b->prox = estrutura;
    estrutura->ant = b;

    free(a);
}

int excluir_espec(node *estrutura,int elemento)
{
    node *aux = estrutura->prox;

    while(aux != estrutura)
    {
        if(aux->elemento == elemento)
        {
            node *aux2 = aux->ant;
            node *aux3 = aux->prox;

            aux2->prox = aux3;
            aux3->ant = aux2;

            free(aux);
            aux=aux2;
        }
        aux = aux->prox;
    }
    return elemento;
}

void esvaziar(node *estrutura)
{
    node *aux = estrutura->prox;

    while(buscar(estrutura,aux->elemento))
    {
        excluir_inicio(estrutura);

        aux = estrutura->prox;
    }
}

int main()
{
    node lista;
    lista.elemento = -1;
    lista.prox = NULL;
    lista.ant = NULL;

    while(1)
    {
        menu();
        char op;
        int x;

        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':

                system("CLS");
                printf("Digite o elemento que deseja inserir no inicio:");
                scanf("%d",&x);
                getchar();
                system("CLS");

                inserir_inicio(&lista,x);

                break;

            case '2':
                system("CLS");

                excluir_inicio(&lista);

                break;

            case '3':

                system("CLS");
                printf("Digite o elemento que deseja inserir no inicio:");
                scanf("%d",&x);
                getchar();
                system("CLS");

                inserir_fim(&lista,x);

                break;

            case '4':
                system("CLS");

                excluir_fim(&lista);

                break;

            case '5':
                system("CLS");
                printf("Digite o elemento que deseja excluir:");
                scanf("%d",&x);
                getchar();
                system("CLS");

                if(buscar(&lista,x))
                    printf("Elemento(s) %d excluido(s) com sucesso!\n\n",excluir_espec(&lista,x));
                else
                    printf("Elemento encontado!\n\n");

                break;

            case '6':
                system("CLS");

                printf("Digite o elemento que deseja buscar :");
                scanf("%d",&x);
                getchar();

                system("CLS");

                if(buscar(&lista,x))
                    printf("Elemento encontado!\n\n");
                else
                    printf("Elemento nao encontado!\n\n");


                break;

            case '7':
                system("CLS");

                exibir(&lista);


                break;

            case '8':
                system("CLS");

                esvaziar(&lista);

                break;

            case '0':
                return 0;

                break;

            default:
                system("CLS");
                printf("Opcao invalida!\n\n");
        }
    }

    return 0;
}
