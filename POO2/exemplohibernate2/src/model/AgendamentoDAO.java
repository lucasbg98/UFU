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
 * @author pc
 */
public class AgendamentoDAO {
    
    
  
    public static void salvar(Consulta p) {
		
		Session session = null;
		
		try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                System.out.println("Salvando os dados da Consulta");
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
        
        public static void excluir(Consulta p) {
		
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
        
        public static void getPessoasByNomeCriteria() {
		
		Session session = null;
		try {
        	SessionFactory sessionFactory = new org.hibernate.cfg.Configuration().configure().buildSessionFactory();
        	session = sessionFactory.openSession();
                session.beginTransaction();
                
                List<Consulta> listaConsulta = session.createCriteria(Consulta.class).list();
                for(Consulta c : listaConsulta){
                    System.out.println(c.getId());
                    System.out.println(c.getMedicocpf());
                    System.out.println(c.getPacientecpf());
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
