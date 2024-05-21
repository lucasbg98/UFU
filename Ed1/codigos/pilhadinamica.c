#include <stdio.h>
#include <stdlib.h>



typedef struct{
    char elemento;
    struct Node *prox;
}; node;



void menu()
{
    system("CLS");
    printf("------------------ MENU -------------------\n");
    printf("[1] para inserir elementos\n");
    printf("[2] para excluir ultimo elemento inserido\n");
    printf("[3] para excluir elemento especifico\n");
    printf("[4] para realizar uma busca\n");
    printf("[5] para verificar elemento do topo\n");
    printf("[6] para exibir os elementos\n");
    printf("[0] para finalizar o programa\n");
    printf("-------------------------------------------\n\n");

}

int pilha_size(node *estrutura)
{

    if(estrutura->prox ==NULL)
    {
        return 0;
    }
    else
    {
        node *temp;
        temp = estrutura->prox;

        int cnt=1;

        while(temp->prox !=NULL)
        {
            temp = temp->prox;
            cnt++;
        }

        return cnt;
    }
}

void pilha_push(node *estrutura,char element)
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

        if( !pilha_size(estrutura) )
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
char pilha_pop(node *estrutura)
{

    if(pilha_size(estrutura) == 1)
    {
        node *temp = estrutura->prox;

        char c = temp->elemento;

        free(temp);

        estrutura->prox = NULL;


        return c;
    }

    else
    {
        node *temp1 = estrutura->prox;
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

char pilha_top(node *estrutura)
{
    node *aux;

    aux = estrutura->prox;

    while(aux->prox != NULL)
    {
        aux = aux->prox;
    }

    return aux->elemento;

}

void pilha_exibir(node *estrutura)
{


    node aux;
    node *pt;

    aux.prox = NULL;
    aux.elemento = '\0';

    if(!pilha_size(estrutura))
    {
        printf("A pilha esta vazia!\n\n");
        return ;
    }
    else
    {
        char c;

        while(pilha_size(estrutura))
        {
            pt = estrutura->prox;

            while(pt->prox !=NULL)
            {
                pt = pt->prox;
            }

            c = pt->elemento;

            printf("        |%c|\n",c);

            pilha_push(&aux,c);

            pilha_pop(estrutura);
        }

    }


    while(pilha_size(&aux))
    {
        pt = aux.prox;

        while(pt->prox !=NULL)
        {
            pt = pt->prox;
        }
        pilha_push(estrutura,pilha_top(&aux));
        pilha_pop(&aux);

    }

}

int pilha_excluir(node *estrutura,char element)
{
    node aux;
    aux.prox = NULL;
    aux.elemento = '\0';

    node *pt;

    int op=0;

    pt = estrutura->prox;

    while(pilha_size(estrutura))
    {
        if(pilha_top(estrutura) !=element)
        {
            pilha_push(&aux,pilha_pop(estrutura));
        }
        else
        {
            pilha_pop(estrutura);
            op++;
        }
    }

    while(pilha_size(&aux))
    {
        pilha_push(estrutura,pilha_pop(&aux));
    }

    if(op)
        return 1;
    else
        return 0;

}

void pilha_find(node *estrutura,char element)
{
    node aux;
    aux.prox = NULL;
    aux.elemento = '\0';

    node *pt;

    int op=0,cnt=pilha_size(estrutura);

    pt = estrutura->prox;

    while(pilha_size(estrutura))
    {
        if(pilha_top(estrutura) == element)
        {
            op++;
            printf("O Elemento %c foi encontrado na posicao %d da pilha!\n",element,cnt);
        }

        pilha_push(&aux,pilha_top(estrutura));
        pilha_pop(estrutura);

        cnt--;
    }

    while(pilha_size(&aux))
    {
        pilha_push(estrutura,pilha_pop(&aux));
    }

    if(op==0)
        printf("Elemento nao encontrado!\n\n");

}

int main()
{

    node stack;

    stack.elemento = '\0';
    stack.prox = NULL;

    char op,elem;

    while(1){
        menu();
        scanf("%c",&op);
        getchar();


        switch(op){
            case '1':

                system("CLS");

                printf("Digite o caractere que deseja inserir :");
                scanf("%c",&elem);
                getchar();

                pilha_push(&stack,elem);

                system("CLS");

            break;

            case '2':

                system("CLS");

                if(!pilha_size(&stack))
                    printf("A pilha esta vazia!\n\n");
                else
                {
                    printf("O elemento |%c| foi excluido!\n\n",pilha_pop(&stack));
                }

                system("pause");

            break;

            case '3':

                    system("CLS");

                    printf("Digite o caractere que deseja excluir :");
                    char c;
                    scanf("%c",&c);
                    getchar();

                    system("CLS");

                    if(pilha_excluir(&stack,c))
                        printf("Caractere(s) excluido(s) com sucesso!\n\n");
                    else
                        printf("O caractere ainda nao foi inserido na pilha!\n\n");

                    system("pause");

            break;

            case '4':

                system("CLS");

                printf("Digite o caractere que deseja buscar :");
                scanf("%c",&c);
                getchar();

                system("CLS");

                pilha_find(&stack,c);

                printf("\n");
                system("pause");

            break;

            case '5':

                system("CLS");

                char top = pilha_top(&stack);

                printf("Elemento do topo : -%c-\n\n",top);

                system("pause");

            break;

            case '6':

                system("CLS");

                printf("Elementos da pilha :\n\n");

                pilha_exibir(&stack);

                printf("\n");

                system("pause");

            break;

            case '0':

                return 0;

            break;

            default:
                system("CLS");
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
A
1
C
1
D
1
E

do
                    {
                        printf("    |%c|\n",pt->elemento);
                        pt = pt->prox;
                    }while(pt != NULL);

                    printf("\n");

*/
