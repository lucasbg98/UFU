/* programa que simula uma calculadora em RPN */
#include <stdio.h>
#include <math.h>
#include <string.h>
#include <ctype.h>

#define MAXOP 100
#define NUMBER '0'
#define void int


int getop(char s[]); 
void push(double);
double pop();
int getch();
void ungetch();

double my_atof(char s[])
/* converte a 'string'   s em numero real (tipo double) */
{    double val, power;
     int i, sinal;
     for(i=0;isspace(s[i]); i++);
     sinal=(s[i]=='-') ? -1 :1;
     if (s[i] =='+' || s[i]== '-') i++;
     for(val=0.0; isdigit(s[i]);i++)
          val=  10.0*val + (s[i]-'0');
     if (s[i] =='.' )
          i++;
     for(power=1.0; isdigit(s[i]);i++){
          val= 10.0*val + (s[i]-'0');
          power *=10.0;
     }
     return sinal*val/power;
} 
#define BUFSIZE 100
/* dep¢sito de caracteres lidos para nao se perder o "próximo" caracter
 a ser    analizado */
char buf[BUFSIZE];
int bufp = 0;

int  getch()  
/* leirura dum caracter se o dep¢sito buf[] estiver vazio */
{
     return (bufp > 0) ? buf[--bufp]:getchar();
}

void ungetch(c){
/* coloca em buf[] o próximo caracter a ser analizado por getop() */

char c;

     if (bufp >= BUFSIZE)
          printf("ungetch: too many characters \n");
     else
          buf[bufp++]=c;
}

int getop(char s[])
/* determina o próximo operador ou operando analizando um ou mais caracteres
lidos:
- se for um operador o seu valor é retornado pela função
- se for um operando o valor NUMBER é retornado e os seus d¡gitos guardados 
em s[] 
*/

{
     int i, c;
     while((c = getch()) == ' ' || c == '\t');
     s[1]='\0';
     if(!isdigit(c) && c != '.')
          return c;
     i = 0;
     if(isdigit(c)) /* parte inteira */
          do {
               s[i++]=c;
               c=getch();
          }
          while(isdigit(c));     /* parte fraccionaria */
     if(c == '.')
          do {
          s[i++]=c;
          c = getch();
          } while(isdigit(c));
     s[i] = '\0';
     if(c !=EOF)
     ungetch(c);
     printf("%s operand\n",s);  
     return NUMBER;
}

#define MAXVAL 100

int sp = 0;    /* inicio da pilha */
double val[MAXVAL]; /* pilha de operandos */

void push(double f){
/* coloca um valor na pilha */

   
    if (sp < MAXVAL)
       { printf("%d val %g push \n",sp, f);
     val[sp++]=f;
    }
    else{
     printf("error: stack full, can't push %g \n", f);
}
}


double pop()
/* retira um valor da pilha */
{    double v;
    if (sp > 0)
     {v=val[--sp];
     printf("%d %g pop \n",sp,v);
     return v;
     }
    else {
     printf("error: stack empty \n");
     return 0.0;
    }
}

main()
{   int type;
    double op2,f;
    char s[MAXOP];
    while((type=getop(s)) != EOF) {
     switch(type) {
     case NUMBER:
         f=my_atof(s);
         push(f);
         break;
     case '+':
         op2=pop();
         printf("%g ++\n",op2);
         push(op2 + pop());
         break;
     case '-':
         op2=pop();
         push(pop() - op2);
         break;
     case '*':
           op2=pop();
           push(op2 * pop());
           break;
     case '/':
         op2=pop();
         if(op2 != 0)
          push(pop() / op2);
         else
          printf("Divisao por zero \n");

         break;
     case '\n':
         printf("\t%.8g \n", pop());
         break;
     default:
         printf("Operador desconhecido %s \n",s);
         break;
     }
    }
}
	
