#include <stdio.h>
#include <stdlib.h>
#include <math.h>

#define min(a,b) a < b ? a : b

const int RUN = 32;


void insertionSort(int arr[], int left, int right)
{
    for (int i = left + 1; i <= right; i++)
    {
        int temp = arr[i];
        int j = i - 1;
        while (arr[j] > temp && j >= left)
        {
            arr[j+1] = arr[j];
            j--;
        }
        arr[j+1] = temp;
    }
}

void merge(int arr[], int l, int m, int r)
{
    
    int len1 = m - l + 1, len2 = r - m;
    int left[len1], right[len2];
    for (int i = 0; i < len1; i++)
        left[i] = arr[l + i];
    for (int i = 0; i < len2; i++)
        right[i] = arr[m + 1 + i];

    int i = 0;
    int j = 0;
    int k = l;
    while (i < len1 && j < len2)
    {
        if (left[i] <= right[j])
        {
            arr[k] = left[i];
            i++;
        }
        else
        {
            arr[k] = right[j];
            j++;
        }
        k++;
    }
    while (i < len1)
    {
        arr[k] = left[i];
        k++;
        i++;
    }
    while (j < len2)
    {
        arr[k] = right[j];
        k++;
        j++;
    }
}


void timSort(int arr[], int n)
{
    //Classificar subconjuntos individuais de tamanho a executar
    for (int i = 0; i < n; i+=RUN)
        insertionSort(arr, i, min((i+31), (n-1)));

    // Comece a Mesclar a partir do tamanho Run (ou 32). Ele irá mesclar
    // para formar o tamanho 64, então 128, 256 e assim por diante 
    for (int size = RUN; size < n; size = 2*size)
    {
        // escolher ponto de partida da matriz sub esquerda. Nós
        //Vão mesclar arr [Left.. esquerda + tamanho-1]
        //e arr [esquerda + tamanho, esquerda + 2 * Tamanho-1]
        //Após cada fusão, nós aumentamos deixado por 2 * Size
        for (int left = 0; left < n; left += 2*size)
        {
            // encontrar ponto final da matriz sub esquerda
            //Mid + 1 é ponto de partida da matriz sub direita
            int mid = left + size - 1;
            int right = min((left + 2*size - 1), (n-1));

            // Merge sub array arr [esquerda..... mid] &
            //arr [mid + 1.... direita]
            merge(arr, left, mid, right);
        }
    }
}
void printArray(int arr[], int n)
{
    for (int i = 0; i < n; i++)
        printf("%d  ", arr[i]);
    printf("\n");
}

int main()
{
    int arr[] = {5, 21, 7, 23, 19};
    int n = sizeof(arr)/sizeof(arr[0]);
    printf("Vetor: ");
    printArray(arr, n);

    timSort(arr, n);

    printf("Vetor ordenado: ");
    printArray(arr, n);
    return 0;
}
