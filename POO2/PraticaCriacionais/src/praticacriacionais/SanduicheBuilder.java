/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package praticacriacionais;

/**
 *
 * @author Lucas
 */
public class SanduicheBuilder implements Builder{
    Sanduiche s = new Sanduiche();
    
    private SanduicheBuilder(){}
    
    private static SanduicheBuilder instance = null;

    @Override
    public void fazPao(String p) {
        s.setPao(p);
    }

    @Override
    public void fazCarne(String c) {
        s.setCarne(c);
    }

    @Override
    public void fazQueijo(String q) {
        s.setQueijo(q);
    }
    
    public static SanduicheBuilder getInstance(){
        if (instance != null){
            return instance;
        }
        else{
            instance = new SanduicheBuilder();
            return instance;
        }
    }
    public void getResult(){
        System.out.printf("Pão: %s\nCarne: %s\nQueijo: %s\n\n",s.getPao(), s.getCarne(), s.getQueijo());
        
    }
    
}
