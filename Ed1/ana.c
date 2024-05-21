#include <stdio.h>

void matriz(){
	int m[100][100], x, count = 0, linha = 0, z = 0;
	
	while(x != -1){
		scanf("%d", &x);
		m[0][count] = x;
		count++;
	}
	count--;
	
	for(int i=1 ; i < 100 ; i++){
		linha++;
		for(int j= 0 ; j <= count; j++){
			scanf("%d", &x);
			if(x == -1 && j < count -1){
				printf("Numero de valores invalidos na linha, insira novamente a quantidade correta de valores\n");
				j = -1;
				continue;
			}
			else if(x != -1 && x != -2 && j == count){
				printf("numero maximo de valores excedido na linha, digite -1 para pular para a proxima linha\n");
				j--;
				continue;
			}
			
			if(x == -2){
				z = 1;
				break;
			}
			else
				m[i][j] = x;
		}
		if(z == 1)
			break;
	}
	printf("Numero de linhas: %d\n", linha);
	printf("Numero de colunas: %d\n", count);
	
	for(int i = 0 ; i < linha ; i++){
		for(int j = 0; j < count ; j++){
			printf("%d ", m[i][j]);
		}
		printf("\n");
	}
}

		
int main(){
	
	matriz();
	
return 0;
}
	

