/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

//import org.hibernate.Session;
//import util.hibernateutil;

/**
 *
 * @author pc
 */
public class PacienteDAO {
    
   
    public static void salvar(Paciente p) {
		
		Session session = null;
		
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	session.beginTransaction();
            session.save(p);
            session.getTransaction().commit();
            
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
    
        public static Paciente getById(String cpf) {
		Paciente p = null;
		Session session = null;
		
        try {
        	session = hibernateutil.getSessionFactory().openSession();
            p = session.get(Paciente.class,cpf);
        } catch (Throwable e) {
        	System.out.println("Erro ao recuperar a pessoa. Mensagem: " + e.getMessage());
        } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
        }
        	
        return p;
	}
        
        public static void excluir(Paciente p) {
		
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
    
    
}
