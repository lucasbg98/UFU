#include <stdio.h>
#include <string.h>
#include <stdlib.h>   //Dupla: Pablo Henrique e Lucas Bragança.
 
#define max 5 //Altere o valor de max para controlar o numero de letras que o vetor terá;
 
struct Pilha{
    char letra[max];
    int topo;
};
 
struct Letra{
    int cont[max];
    char c[max];
};
 
typedef struct Pilha pilha;
typedef struct Letra letr;
 
void menu(){
    printf("------------------------ MENU -----------------------\n");
    printf("|    1 para adcionar uma letra                       |\n");
    printf("|    2 para excluir uma letra                        |\n");
    printf("|    3 para exibir as letras cadastradas             |\n");
    printf("|    4 para exibir a quantidade de movimentos        |\n");
    printf("|    5 para sair                                     |\n");
    printf("-----------------------------------------------------\n\n-->");
}
 
void inicia(pilha *p, letr *l){
    for(int i = 0; i < max; i++){
        l->cont[i] = 0;
        p->letra[i] = 0;
    }
}
 
void push(pilha *p, char x ){
 
    if(p->topo < 0)
        p->topo = 0;
 
    p->letra[p->topo] = x;
    p->topo = p->topo +1;
}
 
char pop(pilha *p){
 
    char y;
    y = p->letra[p->topo-1];
    p->topo = p->topo - 1;
 
    return y;
}
 
void show(pilha *p){
 
    pilha p2;
    p2.topo = 0;
    int y;
 
 
 
    printf("Valores contidos na pilha : \n\n");
    while(p->topo > 0){
        y = pop(p);
        push(&p2, y);
    }
    while(p2.topo > 0){
        y = pop(&p2);
        push(p, y);
        printf("    |%c|\n", p->letra[p->topo-1]);
    }
    printf("\n");
    printf("*Observacao: estamos printando a fila de forma invertida para melhor visualizacao*\n");
}
 
void cont(letr *l, char x){
 
    for(int i = 0; i < max ; i++){
        if(l->c[i] == x)
            l->cont[i]++;
    }
}
 
void pushO(char x, pilha *p, letr *l, int count ){
 
 
    char y;
    int k = 0;
    pilha aux;
    aux.topo = 0;
 
    if(p->topo == max){
        printf("A pilha ja esta cheia!\n");
        return;
    }
        if(p->topo == 0){
            push(p, x);
            cont(l, x);
        }
    else{
            for(int i = 0; i < p->topo; i++){
                while(k < count){
                    if(p->letra[p->topo-1] > x){
                        y = pop(p);
                        cont(l, y);
                        push(&aux, y);
                    }
                k++;
                }
            }
            push(p, x);
            cont(l, x);
 
 
            while(aux.topo > 0){
                y = pop(&aux);
                push(p, y);
                cont(l, y);
            }
 
    }
}
 
void popE(pilha *p, letr *l, char x){
	
	int h = 0;
	
    pilha aux;
    aux.topo = 0;
 
    int z, count = 0;
 
    if(p->topo == 0)
        printf("A pilha esta vazia!\n");
    else{
        while(p->letra[p->topo-1] != x && p->topo > 0){
            z = pop(p);
            h++;
            cont(l, z);
            count++;
            push(&aux, z);
        }
        if(x == p->letra[p->topo -1]){
            z = pop(p);
            cont(l, z);
            h++;
            count++;
            printf("Valor removido com sucesso!\n");
            printf("O valor andou %d casas para ser excluido\n", h);
        }
        else
            printf("Valor nao encontrado\n");
 
        while(aux.topo > 0){
            z = pop(&aux);
            push(p, z);
            cont(l, z);
        }
    }
}
 
int verifica(char x){
 
    if ((x >= 'a' && x <= 'z') || (x >= 'A' && x <= 'Z'))
       return 1;
   else
       return 0;
}
 
void quantidade(letr *l, int cl){
    for(int i = 0; i < cl; i++){
        printf("Letra: %c\n", l->c[i]);
        printf("Numero de vezes que foi empilhada/desempilhada: %d\n", l->cont[i]);
        printf("\n");
    }
}
 
 
int main(){
 
    pilha p;
    p.topo = 0;
 
    letr l;
 
    inicia(&p, &l);
 
    int count = 0, op, z = 0, cl = 0;
    char x, u;
 
    while(1){
 
        menu();
        scanf("%d", &op);
        switch(op){
            case 1:
                    fflush(stdin);
                    printf("digite a letra que deseja: ");
                    scanf("%c", &x);
                    z = verifica(x);
                    while(z == 0){
                        fflush(stdin);
                        printf("Valor invalido, apenas letras permitidas, digite novamente\n");
                        scanf("%c", &x);
                        z = verifica(x);
                    }
                    l.c[cl] = x;
                    cl++;
                    count++;
                    pushO(x, &p, &l, count);
                    fflush(stdin);
                    printf("Valor adcionado!\n");
                    system("pause");
                    system("cls");
 
 
 
            break;
 
            case 2:
                printf("Insira o valor que deseja remover\n");
                fflush(stdin);
                scanf("%c", &u);
				popE(&p, &l, u);
                system("pause");
                system("cls");
            break;
            case 3:
                show(&p);
                system("pause");
                system("cls");
            break;
            case 4:
                quantidade(&l, cl);
                system("pause");
                system("cls");
            break;
        }
 
    }
return 0;
}
