#include <stdio.h>

int maior(int x, int y){
	
	if(x > y)
		return x;
	else 
		return y;
}

int main(){
	
	int x, y, m;
	
	printf("Digite um primeiro valor: \n");
	scanf("%d", &x);
	
	printf("Digite um segundo valor: \n");
	scanf("%d", &y);
	
	m = maior(x,y);
	
	printf("O valor maior eh: %d\n", m);
	
}
