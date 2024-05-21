/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.util.List;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import util.hibernateutil;

/**
 *
 * @author Lucas
 */
public class FornecedorDAO {
     public static void salvar(Fornecedor p) {
		
		Session session = null;
                System.out.println(p.getNomeF());
                System.out.println(p.getCodigoF());
                
                
		
	try {
        	session = hibernateutil.getSessionFactory().openSession();
        	session.beginTransaction();
           
                
                System.out.println("Cadastrando o Fornecedor");
                session.save(p);
                session.getTransaction().commit();
                System.out.println("Dados Salvos!");
                
            
            } catch (Throwable e) {
        	System.out.println("Erro ao salvar o fornecedor. Mensagem: " + e.getMessage());
            } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
        }
	}
    
        
        public static void excluir(Fornecedor p) {
		
		Session session = null;
		
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	session.beginTransaction();
                session.delete(p);
                session.getTransaction().commit();
            
        } catch (Throwable e) {
        	System.out.println("Erro ao excluir a pessoa. Mensagem: " + e.getMessage());
        } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
        }
	}
        
        public static List<Fornecedor> listFornecedores() {
		
		Session session = null;
		try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                List<Fornecedor> listaFornecedor = session.createCriteria(Fornecedor.class).list();
                return listaFornecedor;
        	
		} catch (Exception e) {
        	System.out.println(e.getMessage());
        } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
         }
                return null;
}
}
