#include <stdio.h>

int main(){

	int v[10], x, v2[10], y = 0, z = 0;
	for(int i =0; i < 10; i++){
		scanf("%d", &x);
		v[i] = x;
		if( x < 0){
			v2[y] = x;
			y++;
		}
	}
	for(int i = 0; i < 10 ; i++){
		if(v[i] > 0)
			z+= v[i];
		}
		printf("O vetor inserido foi: ");
	for(int i = 0; i < 10; i++){
		printf("%d ", v[i]);
	}
		printf("Existem %d valores negativos, e sao eles: ", y);
		
	for(int i = 0; i < y; i++){
		printf("%d ", v2[i]);
	}
	printf("A soma dos valores positivos eh: %d", z);

return 0;
}
		
