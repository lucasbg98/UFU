#include <stdio.h>
#include <string.h>


int comp(){
	
	char nome1[20], nome2[20];
	int x, y, z = 0;
	gets(nome1);
	gets(nome2);
	
	x = strlen(nome1);
	y = strlen(nome2);
		
	for(int i = 0; i < x || i < y; i++){
		if(nome1[i] > nome2[i])
			z = 1;
		else if (nome1[i] < nome2[i]) 
			z = -1;
	}
		
	return z;
		
}

int main(){
	
	int x;
	
	x = comp();
	
	if(x > 0)
		printf("A primeira palavra eh maior que a segunda\n");
	else if(x < 0)
		printf("A segunda palavra eh maior que a primeira\n");
	else if(x == 0)
		printf("Ambas palavras possuem o mesmo tamanho\n");


return 0;
}
