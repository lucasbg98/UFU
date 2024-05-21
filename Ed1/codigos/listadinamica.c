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

void push_inicio(node *estrutura, int valor)
{
    node *novo = (node *) malloc(sizeof(node));
    novo->elemento = valor;
    novo->prox = NULL;

    if(estrutura->prox != NULL)
    {
        node *aux = estrutura->prox;
        estrutura->prox = novo;
        novo->prox = aux;
    }
    else
        estrutura->prox = novo;
}

void push_fim(node *estrutura,int valor)
{
    node *novo = (node *) malloc(sizeof(node));
    novo->elemento = valor;
    novo->prox = NULL;

    if(estrutura->prox != NULL)
    {
        node *aux= estrutura->prox;

        while(aux ->prox != NULL)
            aux = aux->prox;

        aux->prox = novo;

    }
    else
        estrutura->prox = novo;
}

int pop_inicio(node *estrutura)
{
    if(estrutura->prox == NULL)
        return -1;
    else
    {
        node *aux = estrutura->prox;
        estrutura->prox = aux->prox;

        int x = aux->elemento;

        free(aux);

        return x;
    }
}

int pop_fim(node *estrutura)
{
    if(estrutura->prox == NULL)
        return -1;
    else
    {
        node *aux = estrutura->prox;
        node *aux2;

        if(aux->prox == NULL)
        {
            int y = aux->elemento;
            free(aux);
            estrutura->prox = NULL;
            return y;
        }

        while(aux->prox != NULL){
            aux2 = aux;
            aux = aux->prox;
        }

        int x = aux->elemento;

        aux2->prox = NULL;
        free(aux);

        return x;
    }
}

int pop_espec(node *estrutura,int valor)
{
    int op=0;

    node *a = estrutura->prox;

    if(a->elemento == valor)
    {
        estrutura->prox = a->prox;
        free(a);
        op++;
    }
    else
    {
        node *temp = estrutura->prox;

        while(temp->prox != NULL)
        {
            temp = temp->prox;
        }
        if(temp->elemento == valor)
        {
            op++;
            pop_fim(estrutura);
        }

    }

    a = estrutura->prox;
    node *b = NULL;

    while(a->prox != NULL)
    {
        if(a->elemento == valor)
        {
            op++;
            b->prox = a->prox;
            free(a);
            a = b->prox;
        }

        b = a;
        a = a->prox;
    }

    if(op)
        return 1;
    else
        return 0;


}

void exibir(node *estrutura)
{
    node *aux = estrutura->prox;

    do{
      printf("%d\n",aux->elemento);
      aux = aux->prox;
    }while(aux!=NULL);
}

int busca(node *estrutura, int valor)
{
    int op=0;
    node *aux = estrutura->prox;

    while(aux != NULL)
    {
        if(aux->elemento == valor)
            op++;
        aux = aux->prox;
    }

    if(op)
        return 1;
    else
        return 0;
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

void esvaziar(node *estrutura)
{
    while(contar(estrutura))
    {
        pop_fim(estrutura);
    }
}

int main()
{
    node lista;
    lista.elemento = -1;
    lista.prox = NULL;

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
                printf("Digite o valor que deseja inserir no inicio:");
                scanf("%d",&x);
                getchar();

                system("CLS");

                push_inicio(&lista,x);

                break;

            case '2':

                system("CLS");
                printf("Digite o valor que deseja inserir no fim:");
                scanf("%d",&x);
                getchar();

                system("CLS");

                push_fim(&lista,x);

                break;

            case '3':
                system("CLS");
                int y = pop_inicio(&lista);

                if(y>=0)
                    printf("O elemento %d foi excluido com sucesso!\n\n",y);
                else
                    printf("*ERRO* -a lista nao possui elementos!-\n\n");

                break;

            case '4':
                system("CLS");
                y = pop_fim(&lista);

                if(y>=0)
                    printf("O elemento %d foi excluido com sucesso!\n\n",y);
                else
                    printf("*ERRO* -a lista nao possui elementos!-\n\n");

                break;

            case '5':
                system("CLS");
                if(lista.prox == NULL)
                    printf("Nao ha elementos na lista!\n\n");
                else
                {
                    printf("Digite o elemento que deseja excluir :");
                    scanf("%d",&x);
                    getchar();

                    if(pop_espec(&lista,x))
                    {
                        printf("Elemento(s) removido(s) com sucesso!\n\n");
                    }
                    else
                    {
                        printf("Elemento nao encontrado!\n\n");
                    }
                }

                break;

            case '6':

                system("CLS");
                printf("Digite o elemento que deseja buscar:");
                scanf("%d",&x);
                getchar();

                system("CLS");

                if(busca(&lista,x))
                    printf("Elemento encontrado com sucesso!\n\n");
                else
                    printf("Elemento nao encontrado!\n\n");


            break;

            case '7':
                system("CLS");

                if(lista.prox == NULL)
                    printf("Nao ha elementos na lista!\n\n");
                else
                    exibir(&lista);

                system("pause");
                system("CLS");

                break;

            case '8':

                system("CLS");

                printf("A lista esta com %d elementos!\n\n",contar(&lista));

            break;

            case '9':
                system("CLS");

                esvaziar(&lista);

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
3
1
6



*/
