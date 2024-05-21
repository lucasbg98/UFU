#include <stdio.h>

int main(){

	int v1[10], v2[10], v3[10], x;
	
	printf("insira valores no primeiro vetor: ");
	
	for(int i = 0; i < 10; i++){
		scanf("%d", &x);
		v1[i] = x;
	}
	
	printf("insira valores no segundo vetor: ");
	
	for(int i = 0; i < 10; i++){
		scanf("%d", &x);
		v2[i] = x;
	}
	printf("Os Valores do terceiro vetor sao: ");
	for(int i = 0; i < 10; i++){
		v3[i] = v1[i] + v2[i];
		printf("%d ", v3[i]);
	}
	
	return 0;
}
		
	
