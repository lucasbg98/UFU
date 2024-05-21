
package model;
import Interfaces.StrategyProduto;




public class Produto {
    
       private int  CodigoP;
       private String DescricaoP;
       private int qtdEstoque;
       private float ValorUnitario;
       private String tipo;
       private StrategyProduto s;
       private int fornecedor;
       
       
       public void cadastro(int Codigop,String DescricaoP,int qtdEstoque,float ValorUnitario,int Fornecedor){
           
           this.setCodigoP(Codigop);
           this.setDescricaoP(DescricaoP);
           this.setQtdEstoque(qtdEstoque);
           this.setValorUnitario(ValorUnitario);
           this.setFornecedor(fornecedor);
           
           
       }

        public int getFornecedor() {
        return fornecedor;
        }

        public void setFornecedor(int fornecedor) {
        this.fornecedor = fornecedor;
        }
      
        public int getCodigoP() {
            return CodigoP;
        }

        public void setCodigoP(int CodigoP) {
            this.CodigoP = CodigoP;
        }

        public String getDescricaoP() {
            return DescricaoP;
        }

        public void setDescricaoP(String DescricaoP) {
            this.DescricaoP = DescricaoP;
        }

        public int getQtdEstoque() {
            return qtdEstoque;
        }

        public void setQtdEstoque(int qtdEstoque) {
            this.qtdEstoque = qtdEstoque;
        }

        public float getValorUnitario() {
            return ValorUnitario;
        }

        public void setValorUnitario(float ValorUnitario) {
            this.ValorUnitario = ValorUnitario;
        }
        
        public void setTipo(String tipo){
            if(tipo == "Alimenticio"){
                this.s = new StrategyAlimenticio();
                this.tipo = s.setTipo();
            }
            else if(tipo == "Limpeza"){
                this.s = new StrategyLimpeza();
                this.tipo = s.setTipo();
            }
            else if(tipo == "Eletronico"){
                this.s = new StrategyEletronico();
                this.tipo = s.setTipo();
            }
        }
        
        public String getTipo(){
            return tipo;
        }
               
        
        
       
       
    
}
