#include <stdio.h>
#include <stdlib.h>

void menu(){
    printf("1 para inserir elementos\n");
    printf("2 para excluir o ultimo elemento inserido\n");
    printf("3 para excluir um elemento especifico\n");
    printf("4 para exibir todos os elementos\n");
    printf("5 para esvaziar\n");
    printf("6 para exibir o topo\n");
    printf("7 para realizar uma busca\n");
    printf("0 para finalizar o programa\n\n");
}

void push(char *vetor,char elemento, int *topo){

    vetor[*topo]=elemento;
    *topo += 1;

}

char pop(char *vetor,int *topo){

    int x = vetor[*topo-1];

    vetor[*topo -1] = '0';

    *topo -=1;
    return x;

}

int excluir(char *vetor,char elemento,int *topo){

    char aux[*topo-1];
    int i,j,op=0;
    int a_top = 0,  *aux_topo = &a_top;

    for(i=0,j=*topo-1; i<=j; j--){
        if(vetor[j] != elemento){
            push(aux,vetor[j],aux_topo);
            pop(vetor,topo);
        }
        else{
            pop(vetor,topo);
            op++;
        }
    }

    for(i=0,j=*aux_topo-1; i<=j; j--){
        push(vetor,aux[j],topo);
        pop(aux,aux_topo);
    }

    return op;

}

void exibir(char *vetor,int *topo){

    int i,j;
    char aux[*topo-1];
    int aux_top =0 , *aux_topo = &aux_top;

    printf("A pilha esta com %d elemento(s)!\n\n",*topo);

    for(i=0,j=*topo-1; i<=j; j--){
        printf("              |%c|\n",vetor[j]);
        push(aux,pop(vetor,topo),aux_topo);
    }
    printf("\n\n");

    for(i=0,j=*aux_topo; i<j; i++){
        push(vetor,pop(aux,aux_topo),topo);
    }

}

void esvaziar(char *vetor,int *topo){
    int i,j;

    for(i=0,j=*topo; i<j; i++){
        pop(vetor,topo);
    }
}

char ttop(char *vetor, int *topo){
    return vetor[*topo-1];
}

int buscar(char *vetor, char elemento, int *topo){
    char aux[*topo-1];
    int aux_topo = 0, *a_top = &aux_topo;
    int i,j,op=0;

    for(i=0, j=*topo-1; i<=j; j--){
        if(vetor[j] != elemento){
            push(aux,vetor[j],a_top);
            pop(vetor,topo);
        }
        else op++;
    }

    for(i=0,j=*a_top-1; i<=j; j--){
        push(vetor,aux[j],topo);
        pop(aux,a_top);
    }

return op;
}

int main(){

    printf("Digite a quantidade de elementos da pilha :");
    int n,i;
    scanf("%d",&n);
    system("CLS");

    char st[n],op,c,k;

    for(i=0; i<n; i++){
        st[i]='\0';
    }

    int top=0,*topo=&top;

    while(1){
        menu();
        getchar();
        scanf("%c",&op);

        switch(op){
            case '1':

                system("CLS");

                if(*topo >= n)
                    printf("Nao eh possivel inserir elementos, a pilha esta cheia !\n\n");
                else
                    {
                        printf("Digite o caractere que deseja inserir :");
                        getchar();
                        scanf("%c",&c);

                        push(st,c,topo);
                        system("CLS");
                    }

            break;

            case '2':

                system("CLS");

                if(*topo-1 <= 0)
                    printf("Nao eh possivel excluir elementos, a pilha esta vazia !\n");
                else
                {
                    c=pop(st,topo);
                    printf("O caractere '%c' foi excluido!\n\n",c);
                }

            break;

            case '3':

                system("CLS");

                if(*topo-1 <=0)
                    printf("Nao eh possivel excluir elementos, a pilha esta vazia !\n");
                else
                {
                    printf("Digite o caractere que deseja excluir :");
                    getchar();
                    scanf("%c",&c);

                    k=excluir(st,c,topo);

                    system("CLS");
                    if(k==0)
                        printf("Elemento nao encontrado !\n\n");
                    else
                        printf("Os elementos %c foram excluidos com sucesso!\n\n",c);
                }

            break;

            case '4':

                system("CLS");
                exibir(st,topo);

            break;

            case '5':
                system("CLS");
                esvaziar(st,topo);
                printf("Pilha esvaziada com sucesso !\n\n");
            break;

            case '6':

                system("CLS");
                char y = ttop(st,topo);
                printf("O elemento do topo eh %c \n\n",y);

            break;

            case '7':

                system("CLS");
                printf("Digite o elemento que deseja buscar :");
                getchar();
                scanf("%c",&c);

                system("CLS");
                if(buscar(st,c,topo)!=0) printf("Elemento encontrado!\n\n");
                else printf("Elemento nao encontrado!\n\n");

            break;

            case '0':

                return 0;

            break;
        }
    }

return 0;
}

/*
5
1
A
1
B
1
D
1
D
1
E

*/
