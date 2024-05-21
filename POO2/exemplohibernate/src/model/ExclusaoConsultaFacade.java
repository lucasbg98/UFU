/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import View.Consultas;

/**
 *
 * @author pc
 */
public class ExclusaoConsultaFacade {
    
    Consulta p;
    Consultas c;
    
    public ExclusaoConsultaFacade(){
       this.p=new Consulta();
       this.c=new Consultas();
    }
    
    
    public void Exclusao(int id){
        //this.p=AgendamentoDAO.getById(id);
        //AgendamentoDAO.excluir(p);
        this.c.zerartabela();
        
    }
    
    
}
