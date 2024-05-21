#include <stdio.h>
#include <stdlib.h>

void menu(){
    printf("1 para inserir um elemento\n");
    printf("2 para excluir ultimo elemento inserido\n");
    printf("3 para excluir um elemento especifico\n");
    printf("4 para exibir todos os elementos da pilha\n");
}

void inserir(char *st, char c, int *top){

    st[*top]=c;
    *top = *top + 1;

}

char excluir(char *st,int *top){
    char c = st[*top-1];
    st[*top -1] = NULL;
    *top = *top -1;
    return c;
}

char excluir2(char *st, char c,int *top){
    printf("1\n");
    int i,cnt=0;
    char st2[*top],x;
    int *top2 = NULL;
    for(i=0; i<*top; i++){
        st2[i]=NULL;
    }

    printf("2\n");
    for(i=0; i<*top-1; i++){
            printf("2.1\n");
        if(st[*top-1] != c)
        {
            printf("2.2\n");
            x=excluir(st,*top);
            printf("2.3\n");

            inserir(st2,x,&top2);
            printf("2.4\n");
            cnt++;
        }
        else{

            excluir(st,&top);
            printf("2.5\n");
        }
    }
    printf("3\n");

    for(i=0; i<cnt; i++){
        inserir(st,st2[cnt],&top);
        excluir(st2,&top2);
    }
    printf("4\n");
}

int main(){

    int n,i;
    printf("Tamanho do vetor :");
    scanf("%d",&n);

    char st[n],c,op;
    for(i=0; i<n; i++){
        st[i]=NULL;
    }

    system("CLS");

    int *top=NULL;

    while(1){
        menu();
        getchar();
        scanf("%c",&op);

        switch(op){

            case '1':

                system("CLS");
                printf("Caractere a ser inserido :");
                getchar();
                scanf("%c",&c);
                inserir(st,c,&top);

            break;

            case '2':

                system("CLS");
                printf("Elemento excluido : %c\n",excluir(st,&top));

            break;

            case '3':

                system("CLS");
                printf("Digite o caractere a ser excluido :");
                getchar();
                scanf("%c",&c);
                excluir2(st,c,&top);

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
C
1
D
1
E
*/
