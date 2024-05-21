#include <stdio.h>

int verif(int x){
	
	int z = 0;
	
	if(x != 4531)
		return z;
	else
		z = 1;

return z;
}

int main(){
	
	int x, z;
	
	printf("Digite a senha: \n");
	scanf("%d", &x);
	
	while(1){
		z = verif(x);
		
		if(z == 0){
			printf("Acesso negado, senha incorreta\n");
			scanf("%d", &x);
		}
		else if(z == 1){
			printf("Acesso permitido, senha correta\n");
			return 0;
		}
	}
}

