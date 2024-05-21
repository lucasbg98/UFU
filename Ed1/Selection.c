#include <stdio.h>
#include <stdlib.h>

int ordena(int vet[],int tam){

     int i,j,min,aux;

     for(i=0; i<tam-1 ;i++){
            min=i;

        for(j=i+1;j<tam;j++){
          if(vet[j] < vet[min]){
            min=j;
          }
        }

        if(i!=min){
            aux=vet[i];
            vet[i]=vet[min];
            vet[min]=aux;

        }

     }

}


int main(){

     int vet[7];

     printf("\nMetodo de ordenacao\n");
     printf("\n-Selection Sort\n");
     for(int i=0;i<7;i++){
        printf(">:");
        scanf("%d",&vet[i]);

     }
     printf("\n-Antes da ordenacao\n");
     for(int i=0;i<7;i++){
        printf("%d ",vet[i]);

     }

     ordena(vet,7);

     printf("\n-Ordenado:\n");
     for(int i=0;i<7;i++){
        printf("%d ",vet[i]);

     }


    return 0;
}
