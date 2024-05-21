/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

//import javax.persistence.Entity;
//import javax.persistence.Id;

//@Entity
public class Paciente {
    
        
         public String nome;
         public String sexo;
         //@Id
         public String  cpf;
         public String telefone;
         public String endereco;
         public String data;
         
         
         
         
          public void cadastrar(String nome,String sexo,String cpf,String telefone,String endereco,String data){
           this.nome=nome;
           this.sexo=sexo;
           this.cpf=cpf;
           this.telefone=telefone;
           this.endereco=endereco;
           this.data=data;
        
    }
    
}
