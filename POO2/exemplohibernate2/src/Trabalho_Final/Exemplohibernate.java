/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Trabalho_Final;

import java.util.List;
import model.Dermatologista;

import model.PessoaHibernate;
import model._Medico_;

/**
 *
 * @author pc
 */
public class Exemplohibernate {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        /*
        Dermatologista d=new Dermatologista();
        _Medico_ med1=new _Medico_(d);
        float val=med1.valor.getValor();
        System.out.println(val);
        
        //Pessoa p1=PessoaHibernate.getById(123);
        //System.out.println(p1.getCpf()+"-"+p1.getNome());
        /*
        Pessoa p2=new Pessoa();
        p2.cpf=567;
        p2.nome="teste";
        PessoaHibernate.salvar(p2);
        
        //p2=PessoaHibernate.getBycpf(456);
        //p2.nome="TESTE";
        //PessoaHibernate.Atualizar(p2);
        //PessoaHibernate.excluir(p2);
        
        /*
        List<Pessoa>lista=PessoaHibernate.getPessoasByNomeCriteria("Marlon");
        for(Pessoa p:lista){
            System.out.println(p.getCpf()+"-"+p.getNome());
            
        }
        */
        
        /*
        List<Pessoa>lista2=PessoaHibernate.getPessoasSQLNativo();
        for(Pessoa p:lista2){
            System.out.println(p.getCpf()+"-"+p.getNome());
            
        }
       */ 
        
        
        
    }
    
}
