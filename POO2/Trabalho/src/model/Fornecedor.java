
package model;

public class Fornecedor {
    
       private int CodigoF;
       private String NomeF;
       
       
       
       public void CadastrarF(int Codigof,String Nomef){
           
           this.setCodigoF(Codigof);
           this.setNomeF(Nomef);
           
       }
       
       

       public int getCodigoF() {
            return CodigoF;
       }

       public void setCodigoF(int CodigoF) {
            this.CodigoF = CodigoF;
       }

       public String getNomeF() {
            return NomeF;
       }

       public void setNomeF(String NomeF) {
            this.NomeF = NomeF;
       }
       
       
       
    
}
