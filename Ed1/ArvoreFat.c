#include <stdio.h>
#include <stdlib.h>

struct node{
    int elemento;
    struct node *dir;
    struct node *esq;
};
typedef struct node node;

node *aloca(int x)
{
    node *novo = malloc(sizeof(node));
    novo->dir = NULL;
    novo->esq = NULL;
    novo->elemento = x;
}

void construir_fat(node *estrutura)
{
    if(estrutura->elemento<=1)
        return;
    estrutura->esq = aloca(estrutura->elemento);
    estrutura->dir= aloca(estrutura->elemento - 1);

    construir_fat(estrutura->dir);
}

void emordem(node *estrutura)
{
    if(estrutura == NULL)
        return;

    emordem(estrutura->esq);
    printf("%d ",estrutura->elemento);
    emordem(estrutura->dir);
}

int calcular_fatorial(node *estrutura)
{
    if(estrutura->elemento <= 1)
        return 1;
    else
        return estrutura->esq->elemento * calcular_fatorial(estrutura->dir);
}

int main()
{
    inicio: printf("Fat: ");
    int x;
    scanf("%d",&x);
    system("CLS");
    printf("Arvore: ");

    node arvore;
    arvore.dir = NULL;
    arvore.esq = NULL;
    arvore.elemento=x;

    construir_fat(&arvore);
    emordem(&arvore);

    printf("\n\nValor do Fib(%d): %d\n\n",x,calcular_fatorial(&arvore));

    goto inicio;
    return 0;
}
