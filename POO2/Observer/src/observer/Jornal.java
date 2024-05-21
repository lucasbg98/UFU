/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package observer;

/**
 *
 * @author Lucas
 */
public class Jornal implements telaObserver{
    
    private Observable dados;
    
    public Jornal(Observable estacao){
        
        this.dados = estacao;
        this.dados.registrarObservador(this);
    }
    
    @Override
    public void atualizar(float temperatura, float umidade){
        
        System.out.println("Jornal- \n Temperatura:" +temperatura +"\n Umidade:" +umidade);
    }
    
}
