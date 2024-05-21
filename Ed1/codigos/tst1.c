#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int i;

struct Node{
    char elemento;
    struct Node *prox;
};
typedef struct Node node;

void inserir(node *estrutura, char elemento)
{
    node *novo = (node *) malloc(sizeof(node));

    novo->elemento = elemento;
    novo->prox = NULL;


    if(estrutura->prox == NULL)
    {
        estrutura->prox = novo;
    }
    else
    {
        node *aux = estrutura->prox;

        while(aux->prox != NULL)
        {
            aux = aux->prox;
        }
        aux->prox = novo;
    }

}

char pop(node *estrutura)
{
    node *aux = estrutura->prox;
    node *aux2 = estrutura;

    char c;

    while(aux->prox != NULL)
    {
        aux2 = aux;
        aux = aux->prox;
    }

    c = aux->elemento;
    aux2->prox = NULL;

    free(aux);

    return c;
}

int vogal(char caractere)
{
    if(caractere == 'a' || caractere == 'e' || caractere == 'i' || caractere == 'o' || caractere == 'u' || caractere == 'A' || caractere == 'E' || caractere == 'I' || caractere == 'O' || caractere == 'U')
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

char *alterar(char *string)
{
    node pilha;
    pilha.elemento = '\0';
    pilha.prox = NULL;

    int cnt=0;

    for(i=0; i<strlen(string)-1; i++)
    {

        if(vogal(string[i]))
        {
            printf("%c ",string[i]);
        }
        else
        {
            while(!vogal(string[i]) && i < strlen(string)-1)
            {
                if(string[i] == '\0')
                    return ;
                else
                    inserir(&pilha,string[i]);
                i++;
                cnt++;
            }

            i--;


            while(cnt)
            {

                printf("%c ",pop(&pilha));
                cnt--;
            }

        }

    }
}


int main()
{



    char str[100];

    printf("Entre com a string :");
    fgets(str,100,stdin);


    alterar(str);


    return 0;
}
