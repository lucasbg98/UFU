/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package testethread;

import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Lucas
 */
public class MeuContador implements Runnable {

    private int s;
    String threadName = Thread.currentThread().getName();
    
    
    public MeuContador(int s){
        this.s = s;
    }
    
    @Override
    public void run() {
       for(int i =0 ; i < s ; i++){
           System.out.printf("%s: %d \n", threadName , (i+1));
           try {
               Thread.sleep(1000);
           } catch (InterruptedException ex) {
               Logger.getLogger(MeuContador.class.getName()).log(Level.SEVERE, null, ex);
           }
       }
    }
    
}
