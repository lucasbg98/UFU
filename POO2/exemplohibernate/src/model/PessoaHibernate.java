/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;


import java.util.ArrayList;
import java.util.List;
/*
import javax.persistence.TypedQuery;
import javax.persistence.criteria.CriteriaBuilder;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import org.hibernate.Session;
import util.hibernateutil;
*/


/**
 *
 * @author pc
 */


import java.util.ArrayList;
import java.util.List;
/*
import javax.persistence.Query;
import javax.persistence.TypedQuery;
import javax.persistence.criteria.CriteriaBuilder;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;

import org.hibernate.Session;
import org.hibernate.query.NativeQuery;
*/


public class PessoaHibernate{

        /*
	public static _Medico_ getById(int id) {
		_Medico_ p = null;
		Session session = null;
		
        try {
        	session = hibernateutil.getSessionFactory().openSession();
            p = session.get(_Medico_.class, id);
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
	
    /**
     *
     * @param <T>
     * @param <Paciente>
     * @param p
     
    public static void salvar(_Medico_ p) {
	
        
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
	
	public static void atualizar(_Medico_ p) {
		
		Session session = null;
		
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	session.beginTransaction();
            session.update(p);
            session.getTransaction().commit();
            
        } catch (Throwable e) {
        	System.out.println("Erro ao atualizar a pessoa. Mensagem: " + e.getMessage());
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
	public static List<_Medico_> getPessoasByNomeCriteria(String nomeVar) {
		List<_Medico_> listaPessoas = new ArrayList<_Medico_>();
		
		Session session = null;
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	//CriteriaBuilder é uma fábrica para definir critérios de consulta (seleção, ordenação, expressões e subconsultas)
        	CriteriaBuilder builder = session.getCriteriaBuilder();
        	//CriteriaQuery cria uma consulta baseada em critérios
        	CriteriaQuery<_Medico_> criteria = builder.createQuery(_Medico_.class);
			//Root define o tipo raíz da cláusula FROM
        	Root<_Medico_> root = criteria.from(_Medico_.class);
        	//Os critérios são aplicados à consulta
        	criteria.select(root).where(builder.like(root.get("nome"), '%'+nomeVar+'%'));
        	//Uma consulta fortemente tipada é criada baseada na consulta por critérios
        	TypedQuery<_Medico_> query = session.createQuery(criteria);
        	//Uma lista de Pessoas é retornada com base nos critérios definidos 
        	listaPessoas = query.getResultList();
        	
		} catch (Throwable e) {
        	System.out.println("Erro ao recuperar a pessoa " + nomeVar + ". Mensagem: " + e.getMessage());
        } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
         }
	
		return listaPessoas;
	
	}
	
	public static List<_Medico_> get_Medicos_() {
		List<_Medico_> listaPessoas = new ArrayList<_Medico_>();
		
		Session session = null;
		
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	
        	TypedQuery<_Medico_> query = session.createQuery("from _Medico_", _Medico_.class);
        	
        	listaPessoas = query.getResultList();
        	
		} catch (Throwable e) {
        	System.out.println("Erro ao recuperar as pessoas. Mensagem: " + e.getMessage());
        } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
        }
	
		return listaPessoas;
	}
	
	public static List<_Medico_> getPessoasSQLNativo() {
		List<_Medico_> listaPessoas = new ArrayList<_Medico_>();
		
		Session session = null;
		
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	
        	String sql = "select * from pessoa";
        	
        	NativeQuery<_Medico_> query = session.createNativeQuery(sql, _Medico_.class); //se não for possível mapear em uma Entity, usar List<Object[]>
        	listaPessoas = query.list();
        	
		} catch (Throwable e) {
        	System.out.println("Erro ao recuperar as pessoas. Mensagem: " + e.getMessage());
          } finally {
        	try {
        		if (session.isOpen()) {
        			session.close();
        		} 
        	} catch (Throwable e) {
            	System.out.println("Erro ao fechar a sessão. Mensagem: " + e.getMessage());
            }
        }
	
		return listaPessoas;
	
	}
        
        
        
       */
}
     
       
     
      

