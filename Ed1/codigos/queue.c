#include <stdio.h>
#include <string.h>

int main()
{

    char str1[10],str2[10];
    int num1,num2;

    fgets(str1,10,stdin);
    fgets(str2,10,stdin);

    printf("%d\n",strlen(str1));

    num1 = atoi(str1);
    num2 = atoi(str2);

    printf("%d\n",num1+num2);

    return 0;
}
