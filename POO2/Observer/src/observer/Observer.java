/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package observer;

import java.util.Scanner;

/**
 *
 * @author Lucas
 */
public class Observer {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        PrevisaoTempo dados = new PrevisaoTempo();
        
        Aeroporto a = new Aeroporto(dados);
        Agricultor a2 = new Agricultor(dados);
        Jornal j = new Jornal(dados);
        Scanner ler = new Scanner(System.in);
        int x = 1, op;
        float temperatura, umidade;
        
        while(x == 1){
            System.out.println("Digite 1 para entrar com valores para temperatura ou umidade\nDigite 0 para sair");
            op = ler.nextInt();
            switch(op){

                case 1:
                    System.out.println("Digite valores para temperatura e umidade: ");

                    temperatura = ler.nextFloat();
                    umidade = ler.nextFloat();

                    dados.atualizarMedicoes(temperatura, umidade);
                break;
                default:
                    x = 0;
                break;
            }
        }
        
    }
    
}
