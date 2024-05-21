#include <stdio.h>
#include <string.h>

void troca(char vet[], char p1[], char p2[]){
	
	int x, count = 0;
	//char vet2[1000];
	
	/*for(int p = 0; p < strlen(vet); p++){
		vet2[p] = vet[p];
		} */
	
	for(int i = 0; i < strlen(vet); i++){
		
		if(vet[i] == p1[count]){
			if(count == 0)
				x = i;
			count++;
			if(count == strlen(p1)){
				int aux = 0;
				if(strlen(p1) - strlen(p2) == 0){
					for(int j = x; j < x+count; j++){
						vet[j] = p2[aux];
						aux++;
					}
				}
				else{
					/*int y, k, aux2 = 0, m, aux = 0, x1 = x, c = strlen(vet2);
					y = strcmp(p1,p2);
					if(y < 0){
						k = strlen(p1) - strlen(p2);
						m = strlen(p1);
					}
					else if(y > 0){
						k = strlen(p2) - strlen(p1);
						m = strlen(p2);
					}
					for(int o = 0; o < k ; o++){
						for(int l = 0; l < c; l++){
							vet[c - aux2] = vet[c - (aux2 - 1)];
							aux2++;
						}
					}
					for(int j = 0; j < m ; j++){
						vet[x1] = p2[aux];
						aux++;
						x1++;
				}
			}*/
			printf("Palavra Grande demais, poe a porra de uma palavra certa\n");
			}
	}
}
		else
			count = 0;
		}
} 

int main(){
	
	char f[1000], p1[20], p2[20];
	
	gets(f);
	gets(p1);
	gets(p2);
	
	troca(f,p1,p2);
	
	printf("%s\n", f);
	
return 0;
}
	
		
