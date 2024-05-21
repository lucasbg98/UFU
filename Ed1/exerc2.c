#include <stdio.h>
#include <string.h>

char * ache (char nome []) {
char * pnome ;
int i = 0;
while ( nome [ i ] != ' ') {
i ++;
}
i ++;
pnome = & nome [ i ];
return pnome ;
}
int main (void) {
char nomeCompleto [80];
char *p ;
printf( " Entre com o seu nome completo . " );
gets ( nomeCompleto );
p = ache ( nomeCompleto );
printf( p );
return 0;
}

/* O programa acima recebe um ponteiro de string e manda para uma outra função char, que faz outro ponteiro receber a string que foi mandada porém a partir
 * da posição 'i' em diante, depois retorna esse novo ponteiro para a função main e printa ele. */
