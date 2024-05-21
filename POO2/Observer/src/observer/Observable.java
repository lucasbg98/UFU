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
public interface Observable {
    
    public void registrarObservador(telaObserver obeservador);
    public void removerObservador(telaObserver observador);
    public void notificar();
    
}
