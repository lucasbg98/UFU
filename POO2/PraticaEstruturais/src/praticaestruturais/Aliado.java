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
public class Aliado implements Personagem {

    @Override
    public int power() {
        return 10;
    }

    @Override
    public void getDescricao() {
       System.out.println(this.type()+"com poder "+this.power());
    }

    @Override
    public String type() {
        return "Aliado ";
    }
    
    
    
}
