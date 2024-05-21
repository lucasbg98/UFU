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
public class deFogo implements personagemDecorator {
    
    Personagem p;

    deFogo(Personagem p){
        
        this.p = p;
    }
    
    @Override
    public int power() {
        return p.power() + 5;
    }

    @Override
    public void getDescricao() {
        System.out.println(this.type() +"com poder " +this.power());
    }
    
     @Override
    public String type() {
        return p.type() +"De Fogo ";
    }
    
}
