#include <stdio.h>
#include <stdlib.h>

int i,tam=0;

void menu()
{
    printf("[1] para inserir\n");
    printf("[2] para remover\n");
    printf("[3] para buscar\n");
    printf("[4] para exibir\n");
    printf("[5] para contar\n");
    printf("[6] para esvaziar\n\nOpcao :");
}

void inserir(int *vetor,int elemento)
{
	if(tam ==0)
	{
		vetor[0] = elemento;
		tam++;
	}
	else
	{
		i =0;
		
		while(vetor[i] != -1 && i < tam)
		{
			if(vetor[i] > elemento)
				break;
			
			
			i++;
		}
		
		if(vetor[i] < elemento)
			vetor[tam] = elemento;
		else
		{
			int j = i;
			
			for(i = tam; i > j; i--)
			{
				int aux = vetor[i-1];
				vetor[i-1] = vetor[i];
				vetor[i] = aux;
			}
			
			vetor[j] = elemento;
		}
		
		tam++;
	}
}

int buscar(int *vetor, int elemento)
{
	for(i=0; i<tam; i++)
	{
		if(vetor[i] == elemento)
			return 1;
	}
	
	return 0;
}

int excluir(int *vetor, int elemento)
{
	while(buscar(vetor,elemento))
	{
		for(i=0; i<tam; i++)
		{
			if(vetor[i] == elemento)
			{
				vetor[i] = -1;
				int j = i+1;
				
				for(; j < tam; j++)
				{
					int aux = vetor[j-1];
					vetor[j-1] = vetor[j];
					vetor[j] = aux;
				}
				tam--;
				
			}
		}
	}
	return elemento;
}

void exibir(int *vetor)
{
	for(i=0; i<tam; i++)
	{
		printf("%d ",vetor[i]);
	}
	printf("\n");
}

int main()
{
	int lista[10];
	
	for(i=0; i<10; i++)
		lista[i] = -1;

    while(1)
    {
        menu();
        char op;
        int c;
        scanf("%c",&op);
        getchar();

        switch(op)
        {
            case '1':
                system("CLS");
                printf("Digite o elemento que deseja inserir :");
                scanf("%d",&c);
                getchar();

                system("CLS");
                
                inserir(lista,c);


                break;

            case '2':
                system("CLS");
                printf("Digite o(s) elemento(s) que deseja excluir :");
                scanf("%d",&c);
                getchar();
                system("CLS");
                
                if(buscar(lista,c))
					excluir(lista,c);
				else
					printf("Elemento nao encontrado!\n\n");
				
				break;

            case '3':
                system("CLS");
                printf("Digite o elemento que deseja buscar:");
                scanf("%d",&c);
                getchar();
                system("CLS");
                
                if(buscar(lista,c))
					printf("Elemento  encontrado!\n\n");
				else
					printf("Elemento nao encontrado!\n\n");

                
                
                

                break;

            case '4':
                system("CLS");
                
                exibir(lista);


                break;

            case '5':
                system("CLS");
                
                printf("A lista esta com %d elementos!\n\n",tam);

                break;

            case '6':
                system("CLS");
                
                for(i=0; i<10; i++){
					lista[i] = -1;
					tam--;
				}
                printf("Lista esvaziada com sucesso!\n\n");

        }
    }

    return 0;
}

/*

1
3
1
5
1
2
1
7
1
1
1
3



*/
