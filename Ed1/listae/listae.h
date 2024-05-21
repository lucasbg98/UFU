#include <stdio.h>
#include <stdlib.h>

void insertF(int *vet, int x, int *topo ){
	
	if(*topo < 0)
		*topo = 0;
		
	vet[*topo] = x;
	*topo = *topo +1;
}

void insertT(int *vet, int x, int *topo ){
	
	int i;
	if(*topo < 0)
		*topo = 0;
	if(*topo == 0)
		vet[*topo] = x;
	else{	
		for(i = *topo -1; i >= 0 ; i--){
			vet[i+1] = vet[i];
		}
		vet[0] = x;
	}
	*topo = *topo + 1;
}

int removerT(int *vet, int *topo){
	
	int y;
	y = vet[*topo-1];
	*topo = *topo -1;
	
	return y;
}

int removerF(int *vet, int *topo){
	
	int i, x;
	x = vet[0];
	for(i = 0; i < *topo; i++){
		vet[i] = vet[i+1];
	}
	*topo = *topo - 1;
	return x;
}

void show(int *vet, int *topo){
	
	int i;
	printf("Valores contidos na lista : \n");
	for(i = 0; i < *topo  ; i++){
		printf("|%d| ", vet[i]);
	}
		printf("\n");
}
int search(int *vet, int x, int *topo){
	
	int i, j, k = 0;
	
	for(i = 0 ; i < *topo ; i++){
		if(vet[i] == x){
			for(j = i; j < *topo  ; j++){
				vet[j] = vet[j+1];
			}
			k = 1;
		}
		else
			continue;
	}
	if(k == 1)
	*topo = *topo - 1;
	
return k;
}
		
				
		
