#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <math.h>
struct pilha
{
  float x;
  struct pilha *p;
};
typedef struct pilha pilha;
void empilha(float x,pilha **topo);
float desempilha(pilha **topo);
void eval(pilha **topo,float (*op)(),int arg);
float soma(float *v);
float sub(float *v);
float mult(float *v);
float divv(float *v);
float neg(float *v);
float pot(float *v);
float quad(float *v);
float expp(float *v);
float id(float *v);
float logg(float *v);
float logg10(float *v);
float seno(float *v);
float a_seno(float *v);
float coss(float *v);
float a_coss(float *v);
float tg(float *v);
float a_tg(float *v);
int main()
{
  char c,expr[200];
  int i,len,arg,flag;
  pilha *topo;
  float a,b,(*f)(),dez;
  topo=NULL;
  scanf("%[^\n]s",expr);
  len=strlen(expr);
  for(i=0;i<len;i++)
  {
    c=expr[i];
    flag=0;
    if(c>='0'&&c<='9')
    {
    a=(float)(c-'0');
    empilha(a,&topo);
    i++;
    c=expr[i];
      while(c!=' '&&flag==0)
      {
        if(c>='0'&&c<='9')
        {
          a=desempilha(&topo);
          a=10*a;
          b=(float)(c-'0');
          a+=b;
          empilha(a,&topo);
        }
        else if(c=='.'){flag=1;dez=1;}
        i++;
        c=expr[i];
      }
      while(c>='0'&&c<='9')
      {
        dez=dez/10;
        b=(float)(c-'0');
        b=b*dez;
        a=desempilha(&topo);
        a+=b;
        empilha(a,&topo);
        i++;
        c=expr[i];
      }
    }
    else
    {
      if(c!=' ')
      {
        switch(c)
        {
          case '+':
               f=soma;
               arg=2;
               break;
          case '-':
               f=sub;
               arg=2;
               break;
          case '*':
               f=mult;
               arg=2;
               break;
          case '/':
               f=divv;
               arg=2;
               break;
          case '_':
               f=neg;
               arg=1;
               break;
          case '^':
               f=pot;
               arg=2;
               break;
          case 'q':
               f=quad;
               arg=1;
               break;
          case 'e':
               f=expp;
               arg=1;
               break;
          case 'E':
               a=exp(1);
               empilha(a,&topo);
               f=id;
               arg=1;
               break;
          case 'p':
               a=acos(-1);
               empilha(a,&topo);
               f=id;
               arg=1;
               break;
          case 'l':
               f=logg;
               arg=1;
               break;
          case 'L':
               f=logg10;
               arg=1;
               break;
          case 's':
               f=seno;
               arg=1;
               break;
          case 'S':
               f=a_seno;
               arg=1;
               break;
          case 'c':
               f=coss;
               arg=1;
               break;
          case 'C':
               f=a_coss;
               arg=1;
               break;
          case 't':
               f=tg;
               arg=1;
               break;
          case 'T':
               f=a_tg;
               arg=1;
               break;
        }
        eval(&topo,f,arg);
      }
    }
  }
  a=desempilha(&topo);
  printf("%f\n",a);
  system("pause");
  return 0;
}
void empilha(float x,pilha **topo)
{
  pilha *aux;
  aux=(pilha*)malloc(sizeof(pilha));
  aux->x=x;
  aux->p=*topo;
  *topo=aux;
}
float desempilha(pilha **topo)
{
  pilha *aux;
  float x;
  x=(**topo).x;
  aux=(**topo).p;
  free(*topo);
  *topo=aux;
  return x;
}
void eval(pilha **topo,float (*op)(),int arg)
{
  int i;
  float *vet,res;
  vet=(float *)malloc(arg*sizeof(float));
  for(i=arg-1;i>=0;i--) vet[i]=desempilha(topo);
  res=(*op)(vet);
  empilha(res,topo);
  free(vet);
}
float soma(float *v)
{
  return (v[0]+v[1]);
}
float sub(float *v)
{
  return (v[0]-v[1]);
}
float mult(float *v)
{
  return (v[0]*v[1]);
}
float divv(float *v)
{
  return (v[0]/v[1]);
}
float neg(float *v)
{
  return ((-1)*v[0]);
}
float pot(float *v)
{
  float a;
  a=pow(v[0],v[1]);
  return a;
}
float quad(float *v)
{
  float a;
  a=sqrt(v[0]);
  return a;
}
float expp(float *v)
{
  float a;
  a=exp(v[0]);
  return a;
}
float id(float *v)
{
  return v[0];
}
float logg(float *v)
{
  float a;
  a=log(v[0]);
  return a;
}
float logg10(float *v)
{
  float a;
  a=log10(v[0]);
  return a;
}
float seno(float *v)
{
  float a;
  a=sin(v[0]);
  return a;
}
float a_seno(float *v)
{
  float a;
  a=asin(v[0]);
  return a;
}
float coss(float *v)
{
  float a;
  a=cos(v[0]);
  return a;
}
float a_coss(float *v)
{
  float a;
  a=acos(v[0]);
  return a;
}
float tg(float *v)
{
  float a;
  a=tan(v[0]);
  return a;
}
float a_tg(float *v)
{
  float a;
  a=atan(v[0]);
  return a;
  }
