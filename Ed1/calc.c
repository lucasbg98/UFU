#include <stdio.h> 
#include <stdlib.h> 

#define MAX 100 

int pilha[MAX]; /*minha pilha de valores*/
int cont=0; /* pilha inicia vazia */

/* põe um elemento na pilha. */ 
void push(int i) 
{ 
     if(cont==0)
     {
       cont++;
     }
     else if(cont == MAX) { 
       printf("Pilha cheia\n"); 
       exit(0);  
     } 
     pilha[cont] = i; 
     cont++;
} 

/*retira um elemento da pilha */
int pop(void) 
{ 
      cont--; 
      if(cont==0) { 
         printf("Pilha vazia\n"); 
         exit(0); 
      } 
      return pilha[cont--]; 
} 

/* função principal do programa*/

int main(void){ 
   int a,b; 
   char s[80]; 
    
   printf("Calculadora de 4 funcoes\n"); 
   printf("Digite 's' para sair\n"); 
    
   do{ 
       printf(": "); 
       gets(s); 
       switch(*s){ 
          case '+': 
          a=pop(); 
          b=pop(); 
             printf("%d\n",a+b); 
             push(a+b); 
             break; 
           case '-': 
             a=pop(); 
             b=pop(); 
             printf("%d\n",b-a); 
             push(b-a); 
             break; 
           case '*': 
             a=pop(); 
             b=pop(); 
             printf("%d\n",a*b); 
             push(a*b); 
             break; 
           case '/': 
             a=pop(); 
             b=pop(); 
             printf("%d\n",b/a); 
             push(b/a); 
             break; 
           default: 
            push(atoi(s));
            break;                     
        } 
                         
    }while(*s!='s'); 
} 