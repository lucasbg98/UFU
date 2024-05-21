#include <stdio.h>

int main(){
	
	int m[6][4], x,v[24], y = 0;
	
	for(int i= 0; i< 6; i++){
		for(int j = 0; j < 4; j++){
			scanf("%d", &x);
			m[i][j] = x;
			if(x > 30){
				v[y] = x;
				y++;
			}
				
		}
	}
	if(y > 0){
	printf("Existem %d elementos maiores que 30, sao eles: ", y);
	for(int i = 0; i < y; i++){
		printf("%d ", v[i]);
	}
}
	else
		printf("nao existem elementos maiores que 30\n");
	printf("\n");
	 for(int i= 0; i< 6; i++){
		for(int j = 0; j < 4; j++){
			if(m[i][j] == 30){
				m[i][j] = 0;
			}
			printf("%d ", m[i][j]);
			}
			printf("\n");
		}
return 0;
	}
