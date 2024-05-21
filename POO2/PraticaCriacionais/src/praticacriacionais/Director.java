package praticacriacionais;

import java.util.Scanner;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Lucas
 */
public class Director {
    
    Scanner ler = new Scanner(System.in);
    String carne, queijo, pao;

    
    
  public void criaSand(){
       while(true){
           System.out.printf("Digite o valor escolhido:\n 1 Para Criar o seu Sanduiche\n 0 Para sair.\n");
           int op = ler.nextInt();
           switch (op){
               case 1: 
                montaSand();
               break;
               case 0:
                   return;
               default:
                       System.out.println("Numero invalido!");
               break;
                       
               
           }
           
       }
   }
   
   public void montaSand(){
       while(true){
            System.out.printf("Enter your choice:\n 1 Para Escolher o Pão\n 2 Para Escolher a Carne\n 3 Para escolher o Queijo\n 0 Para finalizar o Sanduiche.\n");
  
            int op = ler.nextInt();
            switch(op){
                case 1:
                    System.out.printf(" 1 Italiano Branco\n 2 Parmesão com Orégano\n 3 4 Queijos\n");
                    int op2 = ler.nextInt();
                    switch(op2){
                        case 1:
                            pao = "Italiano Branco";
                        break;
                        case 2:
                            pao = "Parmesão com Orégano";
                        break;
                        case 3:
                            pao = "4 Queijos";
                        break;
                        default:
                            System.out.println("Valor inválido!");
                        break;
                    }
                    System.out.println("Pão escolhido com sucesso!");
                break;
                case 2:
                    System.out.printf(" 1 Bife de Frango\n 2 Picanha\n 3 Frango Empanado\n");
                    op2 = ler.nextInt();
                    switch(op2){
                        case 1:
                            carne = "Bife de Frango";
                        break;
                        case 2:
                            carne = "Picanha";
                        break;
                        case 3:
                            carne = "Frango Empanado";
                        break;
                        default:
                            System.out.println("Valor inválido!");
                        break;
                    }
                    System.out.println("Carne escolhida com sucesso!");
                break;
                case 3:
                    System.out.printf(" 1 Cheddar\n 2 Mussarela\n 3 Prato\n");
                    op2 = ler.nextInt();
                    switch(op2){
                        case 1:
                            queijo = "Cheddar";
                        break;
                        case 2:
                            queijo = "Mussarela";
                        break;
                        case 3:
                            queijo = "Prato";
                        break;
                        default:
                            System.out.println("Valor inválido!");
                        break;
                    }
                    System.out.println("Queijo escolhido com sucesso!");
                break;
                case 0:
                    System.out.println("Sanduiche Finalizado!");
                    finalizaSand();
                    return;
           
                    
                            
            }
       }        
   }
   
   
   public void finalizaSand(){
       SanduicheBuilder sb = SanduicheBuilder.getInstance();
       sb.fazCarne(carne);
       sb.fazPao(pao);
       sb.fazQueijo(queijo);
       sb.getResult();
       
       
   }
}

