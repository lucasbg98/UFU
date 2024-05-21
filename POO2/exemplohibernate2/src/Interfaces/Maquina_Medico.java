/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Interfaces;

import model.Dermatologista;
import model.Fisioterapeuta;
import model.Ortopedista;
import model.Pediatra;



/**
 *
 * @author Tulio Araujo
 */
public interface Maquina_Medico {
       public Ortopedista criarOrto();
       public Dermatologista criarDerma();
       public Fisioterapeuta criarFisio();
       public Pediatra criarPedia();
}
