#include <stdio.h>
#include <stdlib.h>

int main () {
int i = 10 , j = 20;
int temp ;
int *p1 , * p2 ;
p1 = & i ;
p2 = & j;
temp = * p1 ;
* p1 = * p2 ;
* p2 = temp ;
printf ( " % d % d \n " , i , j ); /* O que sera impresso ???? */ 
return 0;
}

/*Será impresso os numeros 20 e 10 consecutivamente, pois no codigo acima p1 recebe o endereço de memória de 'i', e p2 o de 'j', apos isso ele executa
 * bubblesort jogando o valor contido no endereço de memoria de 'i', ou seja 10, para uma variável chamada temp, depois joga o valor contido no endereço de
 * memória de 'j' (20) dentro do endereço de memoria do 'i', e novamente jogou o valor de temp, que era 10 para o endereço de memoria de 'j', resumindo, ele
 * inverteu os valores das duas variaveis. */ 
