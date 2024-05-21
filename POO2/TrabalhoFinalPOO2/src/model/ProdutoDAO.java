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
public class ProdutoDAO {
    public static void salvar(Produto p) {
		
		Session session = null;
		
	try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                System.out.println("Cadastrando o Produto");
                session.save(p);
                session.getTransaction().commit();
                System.out.println("Dados Salvos!");
                
            
            } catch (Throwable e) {
        	System.out.println("Erro ao salvar a pessoa. Mensagem: " + e.getMessage());
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
    
        
        public static void excluir(Produto p) {
		
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
        
        public static List<Produto> listProdutos() {
		
		Session session = null;
		try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                List<Produto> listaProdutos = session.createCriteria(Produto.class).list();
                return listaProdutos;
                
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
