/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package praticaestruturais;

/**
 *
 * @author Lucas
 */
public class PraticaEstruturais {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        Personagem p1 = new Voador(new Inimigo());
        p1.getDescricao();
        
        Personagem p2 = new Gigante(new deGelo(new Aliado()));
        p2.getDescricao();
        
        Personagem p3 = new Gigante(new deFogo(new Voador(new Inimigo())));
        p3.getDescricao();
    }
    
}
