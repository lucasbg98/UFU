/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import util.hibernateutil;

/**
 *
 * @author pc
 */
public class _Medico_DAO {
       
      
            
    public static void salvar(_Medico_ p) {
		
		Session session = null;
		
	try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                System.out.println("Salvando os dados do Medico");
                session.save(p);
                session.getTransaction().commit();
                System.out.println("Dados Salvos!");
                
            
            } catch (Throwable e) {
        	System.out.println("Erro ao salvar o medico. Mensagem: " + e.getMessage());
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
    
        
        public static void excluir(_Medico_ p) {
		
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
        
       // https://www.baeldung.com/hibernate-criteria-queries
	public static void getPessoasByNomeCriteria() {
		
		Session session = null;
		try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                List<_Medico_> listaMedicos = session.createCriteria(_Medico_.class).list();
                for(_Medico_ m : listaMedicos){
                    System.out.println(m.getNome());
                    System.out.println(m.getCargo());
                }
        	
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
	

	
	}
	
	
        
        
    
}
