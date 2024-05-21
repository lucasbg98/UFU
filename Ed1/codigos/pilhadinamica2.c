#include <stdio.h>
#include <stdlib.h>


struct Node{
    char elemento;
    struct Node *prox;
};

typedef struct Node node;
int pilha_tamanho = 0;

int pilha_empty()
{

   if(pilha_tamanho <= 0) return 0;
   else return 1;

}

void pilha_push(node *cabeca,char element)
{
    printf("--1\n");

    node *nova_celula = (node*) malloc(sizeof(node));
    printf("--2\n");

    if(   pilha_empty()   )
    {
        printf("--3.1\n");

        cabeca->prox = nova_celula;
        printf("--3.2\n");
        nova_celula->elemento = element;
        printf("--3.3\n");
        nova_celula->prox = NULL;
        printf("--3.4\n");

        printf("aux->prox   %c\n",*nova_celula->prox);


    }
    else
    {

        nova_celula = cabeca->prox;

        while(nova_celula->prox != NULL)
        {
            nova_celula = nova_celula->prox;
        }

        nova_celula->elemento = element;
        nova_celula->prox = NULL;

        printf("aux->prox   %c\n",*nova_celula->prox);

    }


}


int main()
{
    node cabeca;

    char op,elem;
    scanf("%c",&op);
    getchar();

    switch(op)
    {
        case '1':

            scanf("%c",&elem);
            getchar();

            pilha_push(&cabeca,elem);

        break;
    }

    return 0;
}
