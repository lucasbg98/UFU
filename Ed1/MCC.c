#include <stdio.h>
#include <stdlib.h>

int main(){
	
	int v1[5], v2[5], r[5][5], x=0, y=0;
	
	printf("Valores do conjunto A: ");
	for(int i=0; i<5; i++){
		scanf("%d", &v1[i]);
	}
	printf("\n");
	
	printf("Valores do conjunto B: ");
	for(int i=0; i<5; i++){
		scanf("%d", &v2[i]);
	}
	printf("\n");
	printf("  ");
	for(int i=0; i<5; i++){
		printf("%d ", v2[i]);
	}
	printf("\n");
	printf("--------------\n");
	for(int i=0; i<5; i++){
		printf("%d|\n", v1[i]);
	}
	
	
	printf("\n");
	printf("Digite 1 se ha relacao e 0 para nao: ");
	printf("\n");
	for(int i=0; i<5; i++){
		for(int j=0; j<5; j++){
			printf("linha [%d], coluna [%d]\n", i, j);
			scanf("%d", &r[i][j]);
		}
	}
	
	printf("RELACAO MATRICIAL\n");
	for(int i=0; i<5; i++){
		printf("%d ", v2[i]);
	}
	for(int i=0; i<5; i++){
		printf("%d|\n", v1[i]);
	}
	for(int i=0; i<5; i++){
		printf("\n");
		for(int j=0; j<5; j++){
			printf("%d ", r[i][j]);
		}
	}
	
	for(int i=0; i<5; i++){
		for(int j=0; j<5; j++){
			if(r[i][j]==1){
				x++;
			}
			if(r[i][j]==1){
				
			}
		}
	}
	
	if(x==5){
		printf("RELACAO TOTAL\n");
		printf("RELACAO SOBREJETORA\n");
	}
	if(y){
		printf("RELACAO FUNCIONAL\n");
		printf("RELACAO INJETORA\n");
	}

	
	 
	return 0;
}
