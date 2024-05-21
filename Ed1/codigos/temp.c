#include <stdio.h>
#include <string.h>

int main(){
char *a, *b;
a = "uva";
b = "acabate";

if (strcmp(a,b)<0)  printf ("%s vem antes de %s no dicionario", a, b);
else printf ("%s vem depois de %s no dicionário", a, b);


return 0;
}


