/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import Interfaces.Agenda;

/**
 *
 * @author pc
 */
public class Maquina_Agenda implements Agenda {

    @Override
    public Consulta criaagenda() {
       Consulta ag=new Consulta();
       return ag;
    }

     

    

    
}
