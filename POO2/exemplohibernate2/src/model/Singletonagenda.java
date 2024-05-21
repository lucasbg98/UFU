/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import Interfaces.Agenda;
import View.Agendamento;

/**
 *
 * @author pc
 */
public class Singletonagenda {
    
    private static Maquina_Agenda INSTANCIA = null;
    
  
    public static Maquina_Agenda getInstancia(){
        
        if(INSTANCIA==null){
            System.out.println("Instancia criada!");
            INSTANCIA=new Maquina_Agenda();
        }
        
        return INSTANCIA;
        
    }
    
    
}
