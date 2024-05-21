#include <stdio.h>
#include <stdlib.h>

#define tam 5

int testavetorponteiro();
int testevetor2(int vet[tam]);

int main(){
	
	testavetorponteiro();
	getchar();
	
return 0;
}

int testavetorponteiro(){
	int vet[tam]={1,2,3,4,5}, a = 0, i;
	a = testevetor2(vet);
	printf("\nA media retornada pela funcao foi: %d\n", a);
	printf("\n elementos do vetor apos a funcao testevetor2: ");
	for(i=0; i < tam; i++){
		printf("%d, ", vet[i]);
	}
	
	return 0;
}

int testevetor2(int vet1[tam]){
	float media;
	int i, count=0;
	printf("os elementos do vetor passado como paramentro:\n");
	for(i=0; i < tam; i++){
		printf("%d", vet1[i]);
		count += vet1[i];
	}
	media = count / i;
	printf("\n\nA media inicial eh: %f", media);
	
	count =0;
	for(i=0; i < tam; i++){
		printf("\n Digite um novo numero para vetor: \n");
		scanf("%d", &vet1[i]);
		count += vet1[i];
	}
	
	media = count / i;
	printf("\n\nA nova media eh: %f (dentro da funcao)", media);
	
	return media;
}
	

	
