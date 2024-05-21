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
public class Ortopedista extends _Medico_ implements valorconsulta{
    public Ortopedista(){
        
        
    }
    

    //@Transient
    @Override
    public float getValor() {
        return (float)250.00;
    }
}
