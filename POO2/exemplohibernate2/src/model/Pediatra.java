/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;


import Interfaces.valorconsulta;
/*
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.Transient;
*/


/**
 *
 * @author Marlon
**/

//@Entity
public class Pediatra extends _Medico_ implements valorconsulta{
     
    public Pediatra(){
        
    }
    
    //@Transient
    @Override
    public float getValor() {
        return (float) 300.00;
    }
}
