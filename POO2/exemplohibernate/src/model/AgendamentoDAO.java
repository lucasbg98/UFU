/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import View.Consultas;
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
public class AgendamentoDAO {
    
    
  
    public static void salvar(Consulta p) {
		
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
    
        public static Consulta getById(int id) {
		Consulta p = null;
		Session session = null;
		
        try {
        	session = hibernateutil.getSessionFactory().openSession();
            p = session.get(Consulta.class,id);
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
        
        public static List<Consulta> getPessoasByNomeCriteria(String cargo) {
		List<Consulta> listaPessoas = new ArrayList<Consulta>();
		
		Session session = null;
		try {
        	session = hibernateutil.getSessionFactory().openSession();
        	//CriteriaBuilder é uma fábrica para definir critérios de consulta (seleção, ordenação, expressões e subconsultas)
        	CriteriaBuilder builder = session.getCriteriaBuilder();
        	//CriteriaQuery cria uma consulta baseada em critérios
        	CriteriaQuery<Consulta> criteria = builder.createQuery(Consulta.class);
			//Root define o tipo raíz da cláusula FROM
        	Root<Consulta> root = criteria.from(Consulta.class);
        	//Os critérios são aplicados à consulta
        	criteria.select(root).where(builder.like(root.get("cargo"), '%'+cargo+'%'));
        	//Uma consulta fortemente tipada é criada baseada na consulta por critérios
        	TypedQuery<Consulta> query = session.createQuery(criteria);
        	//Uma lista de Pessoas é retornada com base nos critérios definidos 
        	listaPessoas = query.getResultList();
        	
		} catch (Throwable e) {
        	System.out.println("Erro ao recuperar a pessoa " + cargo + ". Mensagem: " + e.getMessage());
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
        
    
}
