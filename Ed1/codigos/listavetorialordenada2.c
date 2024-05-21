#include <stdio.h>
#include <stdlib.h>

void exibir(int *vetor)
{
    int i=0;
    while(vetor[i] != -1)
    {
        printf("%d ",vetor[i]);
        i++;
    }
}

int main()
{
    int lista[10];

    memset(lista,-1,sizeof(lista));

    exibir(lista);

    return 0;
}
