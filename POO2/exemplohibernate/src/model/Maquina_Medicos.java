/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

;

import Interfaces.Maquina_Medico;



/**
 *
 * @author Tulio Araujo
 */
public class Maquina_Medicos  implements Maquina_Medico{

   
    @Override
    public Ortopedista criarOrto() {
        Ortopedista or = new Ortopedista();
        return or;
    }

    @Override
    public Dermatologista criarDerma() {
        Dermatologista der = new Dermatologista();
        return der;
    }

    @Override
    public Fisioterapeuta criarFisio() {
        Fisioterapeuta fi = new Fisioterapeuta();
        return fi;
    }

    @Override
    public Pediatra criarPedia() {
        Pediatra pe = new Pediatra();
        return pe;
    }
    
   
    
    
    
    
    
}
