/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package observer;

import java.util.ArrayList;

/**
 *
 * @author Lucas
 */
public class PrevisaoTempo implements Observable{
    
    private float temperatura;
    private float umidade;
    private ArrayList<telaObserver> observadores;
    
    public PrevisaoTempo(){
        
        observadores = new ArrayList<telaObserver>();
    }
    
    @Override
    public void registrarObservador(telaObserver observador){
        
        observadores.add(observador);
    }
    
    @Override
    public void removerObservador(telaObserver observador){
        
        int i = observadores.indexOf(observador);
        if(i > 0)
            observadores.remove(i);
    }
    
    @Override
    public void notificar(){
        
        for(telaObserver obs : observadores)
            obs.atualizar(temperatura, umidade);
    }
    
    public void atualizarMedicoes(float temperatura, float umidade){
        
        this.temperatura = temperatura;
        this.umidade = umidade;
        
        notificar();
    }
    
    
}
