/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.io.Serializable;
import javax.annotation.Generated;
/*
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
*/

/**
 *
 * @author pc
 */
/*
@Entity
@Table(name="Consulta")
*/
public class Consulta {
    
    //@Id
    //@GeneratedValue(strategy = GenerationType.IDENTITY)
    public int id;
    public String hora;
   
    public String paciente_cpf;
   
    
    public String data_consulta;
    public String cargo;
    
    public String medico_cpf;
    
 
    //public float valor;
    
    public Consulta(){
        
        
    }
    
    public void cadastrar(String hora,String paciente_cpf,String data,String cargo,String medico_cpf){
        this.medico_cpf=medico_cpf;
        this.paciente_cpf=paciente_cpf;
        this.hora=hora;
        this.data_consulta=data;
        this.cargo=cargo;
        
      
    }
   
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    //@ManyToOne(targetEntity =Paciente.class)
    //@JoinColumn(name="paciente_cpf")
    public String getPacientecpf() {
        return paciente_cpf;
    }

    public void setPacientecpf(String pacientecpf) {
        this.paciente_cpf = pacientecpf;
    }
    //@ManyToOne(targetEntity = _Medico_.class )
    //@JoinColumn(name="medico_cpf")
    public String getMedicocpf() {
        return medico_cpf;
    }

    public void setMedicocpf(String medico_cpf) {
        this.medico_cpf = medico_cpf;
    }
    
   
    
   
    
    
    
    
    
    
}
