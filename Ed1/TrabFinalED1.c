#include <stdio.h>
#include <stdlib.h>
#include <string.h>
struct Data {
    int dia;
    int mes;
    int ano;
};
typedef struct Data Data;
 
struct Endereco {
    int numero;
    char rua[256];
    char cidade[256];
    char estado[256];
};
typedef struct Endereco Endereco;
 
struct Cliente {
    char cpf[256];
    char nome[256];
    char telefone[256];
    Endereco endereco;
    Data nascimento;
    struct Cliente* ant;
    struct Cliente* prox;
};
typedef struct Cliente Cliente;
 
struct Produto {
    char codigo[256];
    char descricao[256];
    int estoque;
    double preco_unitario;
    struct Produto* ant;
    struct Produto* prox;
};
typedef struct Produto Produto;
 
struct Venda {
    Cliente cliente;
    Produto produto;
    int qtde;
    struct Venda* ant;
    struct Venda* prox;
};
typedef struct Venda Venda;
 
Cliente* inicioCliente = NULL;
Produto* inicioProduto = NULL;
Venda* inicioVenda = NULL;
 
void pushCliente(Cliente* novoCliente){
    if(inicioCliente == NULL) {
        inicioCliente = (Cliente*) malloc(sizeof(Cliente));
        inicioCliente = novoCliente;
        return;
    }
    Cliente* iterator = inicioCliente;
    while(iterator->prox != NULL){
        iterator = iterator->prox;
    }
    iterator->prox = novoCliente;
    novoCliente->ant = iterator;
    return;
}
 
void apagarCliente(){
    printf("digite o cpf: ");
    char  cpf[256];
    int x = 0;
    //digitar nome do cliente
    fgets(cpf, 256, stdin);
    Cliente* iterator = inicioCliente;
    Venda *procurar = inicioVenda;
    while(procurar != NULL){
        if(strcmp(cpf, procurar->cliente.cpf)== 0){
            x = 1;
        }
        procurar = procurar->prox;
    }
    if(x == 1){
        while(iterator != NULL){
            if(strcmp(cpf, iterator->cpf) == 0){
                if(iterator->ant == NULL && iterator->prox == NULL) {
                    free(iterator);
                    inicioCliente = NULL;
                }   else if(iterator->ant == NULL) {
                    inicioCliente = iterator->prox;
                    iterator->prox->ant = NULL;
                    free(iterator);
                }   else if(iterator->prox == NULL) {
                    iterator->ant->prox = NULL;
                    free(iterator);
                }   else {
                    iterator->ant->prox = iterator->prox;
                    iterator->prox->ant = iterator->ant;
                    free(iterator);
                }
            }
            iterator = iterator->prox;
        }
    }
    printf("apagado com sucesso\n");
}
void editarCliente(){
    char username[256];
    //digitar nome do cliente
    fgets(username, 256, stdin);
    Cliente* iterator = inicioCliente;
    while(iterator != NULL){
        if(strcmp(username, iterator->nome) == 0){
                fgets(iterator->nome, 256, stdin);
                fgets(iterator->cpf, 256, stdin);
                fgets(iterator->telefone, 256, stdin);
                fgets(iterator->endereco.rua, 256, stdin);
                scanf("%d", &iterator->endereco.numero);
                getchar();
                fgets(iterator->endereco.cidade, 256, stdin);
                fgets(iterator->endereco.estado, 256, stdin);
                scanf("%d/%d/%d", &iterator->nascimento.dia, &iterator->nascimento.mes, &iterator->nascimento.ano);
                getchar();
        }
        iterator = iterator->prox;
    }
}
 
void mostrarClientes(){
    Cliente* iterator = inicioCliente;
    while(iterator != NULL){
        printf("---------------------------\n");
        printf("Nome: %s", iterator->nome);
        printf("CPF: %s", iterator->cpf);
        printf("Telefone: %s", iterator->telefone);
        printf("Rua: %sNúmero %d\n%s%s", iterator->endereco.rua, iterator->endereco.numero, iterator->endereco.cidade, iterator->endereco.estado);
        printf("Nascimento: %d/%d/%d\n", iterator->nascimento.dia, iterator->nascimento.mes, iterator->nascimento.ano);
        iterator = iterator->prox;
    }
}
 
void pushProduto(Produto* novoProduto){
    if(inicioProduto == NULL) {
        inicioProduto = (Produto*) malloc(sizeof(Produto));
        inicioProduto = novoProduto;
        return;
    }
    Produto* iterator = inicioProduto;
    while(iterator->prox != NULL){
        iterator = iterator->prox;
    }
    iterator->prox = novoProduto;
    novoProduto->ant = iterator;
    return;
}
 
void apagarProduto(){
    printf("digite o codigo: ");
    char codigoProduto[256];
    int x = 0;
    //digitar nome do cliente
    fgets(codigoProduto, 256, stdin);
    Produto* iterator = inicioProduto;
    Venda *procurar = inicioVenda;
    while(procurar !=NULL){
        if(strcmp(codigoProduto, procurar->produto.codigo)== 0){
            x = 1;
        }
        procurar = procurar->prox;
    }
    if(x == 0){
       while(iterator != NULL){
           if(strcmp(codigoProduto, iterator->codigo) == 0){
                if(iterator->ant == NULL && iterator->prox == NULL) {
                    free(iterator);
                    inicioProduto = NULL;
                }   else if(iterator->ant == NULL) {
                    inicioProduto = iterator->prox;
                    iterator->prox->ant = NULL;
                    free(iterator);
                }   else if(iterator->prox == NULL) {
                    iterator->ant->prox = NULL;
                    free(iterator);
                }   else {
                    iterator->ant->prox = iterator->prox;
                    iterator->prox->ant = iterator->ant;
                    free(iterator);
                }
            }
            iterator = iterator->prox;
        }
    }
}
void editarProduto(){
    char codigoProduto[256];
    fgets(codigoProduto, 256, stdin);
    Produto* iterator = inicioProduto;
    while(iterator != NULL){
        if(strcmp(codigoProduto, iterator->codigo) == 0){
            fgets(iterator->codigo, 256, stdin);
            fgets(iterator->descricao, 256, stdin);
            scanf("%lf", &iterator->preco_unitario);
            scanf("%d", &iterator->estoque);
            getchar();
        }
        iterator = iterator->prox;
    }
}
 
void mostrarProdutos(){
    Produto* iterator = inicioProduto;
    while(iterator != NULL){
        printf("---------------------------\n");
        printf("Codigo: %s", iterator->codigo);
        printf("Descricao: %s", iterator->descricao);
        printf("Preco unitario: %.2lf\n", iterator->preco_unitario);
        printf("Quantidade em estoque: %d\n", iterator->estoque);
        iterator = iterator->prox;
    }
}
void pushVenda(Venda* novoVenda){
    if(inicioVenda == NULL) {
        inicioVenda = (Venda*) malloc(sizeof(Venda));
        inicioVenda = novoVenda;
        return;
    }
    Venda* iterator = inicioVenda;
    while(iterator->prox != NULL){
        iterator = iterator->prox;
    }
    iterator->prox = novoVenda;
    novoVenda->ant = iterator;
    return;
}
int procura(Cliente *novoCliente, Produto *novoProduto){
    int x = 0;
    char codigo[256],cpf[256];
    printf("digite o cpf: ");
    fgets(cpf, 256, stdin);
    printf("digite o codigo: ");
    fgets(codigo, 256, stdin);
    Cliente *aux = inicioCliente;
    Produto *aux2 = inicioProduto;
    while(aux != NULL){
        if(strcmp(cpf , aux->cpf)== 0)
            x++;
        aux = aux->prox;
    }
    while(aux2 !=NULL){
        if(strcmp(codigo ,aux2->codigo) == 0){
            x++;
        }
    }
    return x;
 
}
void apagarVenda(){
    char codigoVenda[256];
    //digitar nome do cliente
    fgets(codigoVenda, 256, stdin);
    Venda* iterator = inicioVenda;
    while(iterator != NULL){
        if(strcmp(codigoVenda, iterator->produto.codigo) == 0){
            if(iterator->ant == NULL && iterator->prox == NULL) {
                free(iterator);
                inicioVenda = NULL;
            }   else if(iterator->ant == NULL) {
                inicioVenda = iterator->prox;
                iterator->prox->ant = NULL;
                free(iterator);
            }   else if(iterator->prox == NULL) {
                iterator->ant->prox = NULL;
                free(iterator);
            }   else {
                iterator->ant->prox = iterator->prox;
                iterator->prox->ant = iterator->ant;
                free(iterator);
            }
        }
        iterator = iterator->prox;
    }
}
void editarVenda(){
    char codigoProduto[256];
    fgets(codigoProduto, 256, stdin);
    Venda* iterator = inicioVenda;
    while(iterator != NULL){
        if(strcmp(codigoProduto, iterator->produto.codigo) == 0){
            fgets(iterator->produto.codigo, 256, stdin);
            fgets(iterator->cliente.cpf, 256, stdin);
            scanf("%d", &iterator->qtde);
            getchar();
        }
        iterator = iterator->prox;
    }
}
void mostrarVendas(){
    Venda* iterator = inicioVenda;
    while(iterator != NULL){
        printf("---------------------------\n");
        printf("Quantidade: %d", iterator->qtde);
        printf("Cpf do cliente: %s", iterator->cliente.cpf);
        printf("Codigo: %s\n", iterator->produto.codigo);
        iterator = iterator->prox;
    }
}
 
int main(){
    int opc;
    do {
        printf("1.Adicionar Cliente\n2.Mostrar Cliente\n3.Apagar Cliente\n4.Editar Cliente\n5.Adicionar Produto\n6.Mostrar Produto\n7.Apagar Produto\n8.Editar Produto\n9.Adicionar Venda\n10.Mostrar Venda\n11.Apagar Venda\n12.Editar Venda\n0.Sair\n ");
        scanf("%d", &opc);
        getchar();
        switch(opc){
            //insere
            case 1: {
                Cliente* novoCliente = (Cliente*) malloc(sizeof(Cliente));
                novoCliente->prox = novoCliente->ant = NULL;
                printf("Digite o nome: ");
                fgets(novoCliente->nome, 256, stdin);
                printf("digite o cpf: ");
                fgets(novoCliente->cpf, 256, stdin);
                printf("Digite o telefone: ");
                fgets(novoCliente->telefone, 256, stdin);
                printf("Digite a rua: ");
                fgets(novoCliente->endereco.rua, 256, stdin);
                printf("Digite o numero: ");
                scanf("%d", &novoCliente->endereco.numero);
                getchar();
                printf("Digite a cidade: ");
                fgets(novoCliente->endereco.cidade, 256, stdin);
                printf("Digite o estado: ");
                fgets(novoCliente->endereco.estado, 256, stdin);
                printf("Digite a data de aniversario dd/mm/aaaa: ");
                scanf("%d/%d/%d", &novoCliente->nascimento.dia, &novoCliente->nascimento.mes, &novoCliente->nascimento.ano);
                getchar();
                pushCliente(novoCliente);
                break;
            //mostra
            } case 2: {
                mostrarClientes();
                break;
            //apaga
            } case 3: {
                apagarCliente();
            //edita
            } case 4: {
                editarCliente();
            } case 5: {
                Produto* novoProduto = (Produto*) malloc(sizeof(Produto));
                novoProduto->prox = novoProduto->ant = NULL;
                printf("Digite o codigo: ");
                fgets(novoProduto->codigo, 256, stdin);
                printf("Digite a descricao: ");
                fgets(novoProduto->descricao, 256, stdin);
                printf("Digite o preco unitario: ");
                scanf("%lf", &novoProduto->preco_unitario);
                printf("Digite a quantidade de estoque: ");
                scanf("%d", &novoProduto->estoque);
                getchar();
                pushProduto(novoProduto);
                break;
            //mostra
            } case 6: {
                mostrarProdutos();
                break;
            //apaga
            } case 7: {
                apagarProduto();
                break;
            //edita
            } case 8: {
                editarProduto();
                break;
            } case 9: {
                int t;
                t = procura(inicioCliente, inicioProduto);
                if(t == 2){
                Venda* novoVenda = (Venda*) malloc(sizeof(Venda));
                novoVenda->prox = novoVenda->ant = NULL;
                printf("Digite o codigo: ");
                fgets(novoVenda->produto.codigo,256 ,stdin);
                printf("Digite a quantidade: ");
                scanf("%d", &novoVenda->qtde);
                printf("Digite o CPF: ");
                fgets(novoVenda->cliente.cpf, 256, stdin);
 
                getchar();
                pushVenda(novoVenda);
                }
                else
                    printf("codigo ou cpf invalido\n");
                break;
            } case 10: {
                mostrarVendas();
                break;
            } case 11: {
                apagarVenda();
                break;
 
            } case 12: {
                editarVenda();
                break;
            }
 
        }
    }   while(opc != 0);
 
}

