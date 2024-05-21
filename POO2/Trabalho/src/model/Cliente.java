
package model;


public class Cliente {
    
        private int Codigo;
        private String Nome;
        private String DataNasc;
        private String Endereco;
        
        public void CadastroCliente(int Codigo,String Nome,String DataNasc,String Endereco){
           
             this.setCodigo(Codigo);
             this.setDataNasc(DataNasc);
             this.setEndereco(Endereco);
             this.setNome(Nome);
            
        }
        

        public int getCodigo() {
            return Codigo;
        }

        public void setCodigo(int Codigo) {
            this.Codigo = Codigo;
        }

        public String getNome() {
            return Nome;
        }

        public void setNome(String Nome) {
            this.Nome = Nome;
        }

        public String getDataNasc() {
            return DataNasc;
        }

        public void setDataNasc(String DataNasc) {
            this.DataNasc = DataNasc;
        }

        public String getEndereco() {
            return Endereco;
        }

        public void setEndereco(String Endereco) {
            this.Endereco = Endereco;
        }

        
    
}
