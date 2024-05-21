/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;


import Interfaces.valorconsulta;
//import javax.persistence.Entity;
//import javax.persistence.Transient;



//@Entity
public class Fisioterapeuta extends _Medico_ implements valorconsulta{
    
    
   
    public Fisioterapeuta(){
        
    }
    //@Transient
    @Override
    public float getValor() {
       return (float) 400.00;
    }
    

    
    
}
