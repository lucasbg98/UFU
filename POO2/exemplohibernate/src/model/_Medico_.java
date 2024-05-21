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
 * @author pc
 */

//@Entity

public class _Medico_ {
            
            public String nome;
            public String sexo;
            public String cargo;
            //@Id
            public String cpf;
            public String telefone;
            public String endereco;
            public String data;
//            
            //@Transient
            public valorconsulta valor;
            public _Medico_(valorconsulta valor){
                this.valor=valor;
               
            }
            public _Medico_(){
            
            }
            
           
          
 
          public void cadastrar(String nome,String sexo,String cargo,String cpf,String telefone,String endereco,String data){
           this.nome=nome;
           this.sexo=sexo;
           this.cargo=cargo;
           this.cpf=cpf;
           this.telefone=telefone;
           this.endereco=endereco;
           this.data=data;
           
        
           }
          
          
        

            public String getNome() {
                return nome;
            }

            public void setNome(String nome) {
                this.nome = nome;
            }

            

            public String getSexo() {
                return sexo;
            }

            public void setSexo(String sexo) {
                this.sexo = sexo;
            }

            public String getCargo() {
                return cargo;
            }

            public void setCargo(String cargo) {
                this.cargo = cargo;
            }

            public String getCpf() {
                return cpf;
            }

            public void setCpf(String cpf) {
                this.cpf = cpf;
            }

            public String getTelefone() {
                return telefone;
            }

            public void setTelefone(String telefone) {
                this.telefone = telefone;
            }

            public String getEndereco() {
                return endereco;
            }

            public void setEndereco(String endereco) {
                this.endereco = endereco;
            }

            public String getData() {
                return data;
            }

            public void setData(String data) {
                this.data = data;
            }
            
          
           @Override
           public String toString(){
               return this.nome;
           }
              

       

        

           
        
}
