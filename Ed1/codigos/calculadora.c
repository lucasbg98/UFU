#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void menu()
{
    printf("[1] para calcular uma expressao\n");
    printf("[2] para finalizar o programa\n\n");
}

struct Node{
    char elemento;
    struct Node *prox;
};

typedef struct Node node;

int pilha_size(node *extrutura)
{

    if(extrutura->prox ==NULL)
    {
        return 0;
    }
    else
    {
        node *temp;
        temp = extrutura->prox;

        int cnt=1;

        while(temp->prox !=NULL)
        {
            temp = temp->prox;
            cnt++;
        }

        return cnt;
    }
}

void pilha_push(node *extrutura,char element)
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

        if( !pilha_size(extrutura) )
        {

            extrutura->prox = novo;
        }
        else
        {
             node *temp = extrutura->prox;

             while(temp->prox != NULL)
                temp = temp->prox;

             temp->prox = novo;
        }


    }

}
char pilha_pop(node *extrutura)
{

    if(pilha_size(extrutura) == 1)
    {
        node *temp = extrutura->prox;

        char c = temp->elemento;

        free(temp);

        extrutura->prox = NULL;


        return c;
    }

    else
    {
        node *temp1 = extrutura->prox;
        node *temp2;

        while(temp1->prox !=NULL)
        {
            temp2 = temp1;
            temp1 = temp1->prox;
        }

        temp2->prox = NULL;

        char c = temp1->elemento;
        free(temp1);


        return c;

    }

}

char pilha_top(node *extrutura)
{
    node *aux;

    aux = extrutura->prox;

    while(aux->prox != NULL)
    {
        aux = aux->prox;
    }

    return aux->elemento;

}

void pilha_exibir(node *extrutura)
{


    node aux;
    node *pt;

    aux.prox = NULL;
    aux.elemento = '\0';

    if(!pilha_size(extrutura))
    {
        printf("A pilha esta vazia!\n\n");
        return ;
    }
    else
    {
        char c;

        while(pilha_size(extrutura))
        {
            pt = extrutura->prox;

            while(pt->prox !=NULL)
            {
                pt = pt->prox;
            }

            c = pt->elemento;

            printf("        |%c|\n",c);

            pilha_push(&aux,c);

            pilha_pop(extrutura);
        }

    }


    while(pilha_size(&aux))
    {
        pt = aux.prox;

        while(pt->prox !=NULL)
        {
            pt = pt->prox;
        }
        pilha_push(extrutura,pilha_top(&aux));
        pilha_pop(&aux);

    }

}

int pilha_excluir(node *extrutura,char element)
{
    node aux;
    aux.prox = NULL;
    aux.elemento = '\0';

    node *pt;

    int op=0;

    pt = extrutura->prox;

    while(pilha_size(extrutura))
    {
        if(pilha_top(extrutura) !=element)
        {
            pilha_push(&aux,pilha_pop(extrutura));
        }
        else
        {
            pilha_pop(extrutura);
            op++;
        }
    }

    while(pilha_size(&aux))
    {
        pilha_push(extrutura,pilha_pop(&aux));
    }

    if(op)
        return 1;
    else
        return 0;

}

void pilha_find(node *extrutura,char element)
{
    node aux;
    aux.prox = NULL;
    aux.elemento = '\0';

    node *pt;

    int op=0,cnt=pilha_size(extrutura);

    pt = extrutura->prox;

    while(pilha_size(extrutura))
    {
        if(pilha_top(extrutura) == element)
        {
            op++;
            printf("O Elemento %c foi encontrado na posicao %d da pilha!\n",element,cnt);
        }

        pilha_push(&aux,pilha_top(extrutura));
        pilha_pop(extrutura);

        cnt--;
    }

    while(pilha_size(&aux))
    {
        pilha_push(extrutura,pilha_pop(&aux));
    }

    if(op==0)
        printf("Elemento nao encontrado!\n\n");

}

int calc_parenteses(char *string)
{
    int i;

    node pilha;
    pilha.elemento = '\0';
    pilha.prox = NULL;

    for(i=0; i<strlen(string);i++)
    {
        if(string[i] == '(')
        {
            pilha_push(&pilha,string[i]);
        }
        else if(string[i] == ')')
        {
            if(!pilha_size(&pilha))
            {
                return 0;
            }
            else
            {
                pilha_pop(&pilha);
            }
        }
    }

    if(!pilha_size(&pilha))
        return 1;
    else
        return 0;
}

int calcular(int n1,int n2,char c)
{
    switch (c)
    {
        case 43:
             return n1+n2;
        break;

        case 45:
            return n1-n2;
        break;

        case 47:
            return n1/n2;
        break;

        case 42:
            return n1*n2;
        break;
    }
}

int converter(char c)
{
    switch(c)
    {
        case '0':
            return 0;
        break;

        case '1':
            return 1;
        break;
        case '2':
            return 3;
        break;
        case '3':
            return 3;
        break;
        case '4':
            return 4;
        break;
        case '5':
            return 5;
        break;
        case '6':
            return 6;
        break;
        case '7':
            return 7;
        break;
        case '8':
            return 8;
        break;
        case '9':
            return 9;
        break;

    }
}

int main()
{
    char str[1000],x;

    scanf("%c",&x);
    getchar();

    node pilha;

    switch(x)
    {
        case '1':
            system("CLS");
            printf("Digite a expressao que deseja calcular :");
            fgets(str,1000,stdin);

            if(!calc_parenteses(str))
            {
                printf("Expressao invalida - checar parenteses -\n\n");
            }
            else
            {
                int i,a,b,c,d;

                for(i=strlen(str); i>0 ;i--)
                {

                    if(str[i] == '(')
                    {
                        a = converter(str[i+1]);
                        b = converter(str[i+3]);
                        c = str[i+2];
                        d = calcular(a,b,c);

                        pilha_push(&pilha, d);

                        printf("%d\n",d);
                    }

                }
        }

        break;

        case '2':
            return 0;
        break;

        default:
            system("CLS");
            printf("Operacao invalida!\n\n");
            system("pause");

    }
return 0;
}

























/*

1
A
1
A
1
C
1
D
1
E


*/

