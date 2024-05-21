
package model;


public class Movimento {
    
        private int CodigoVenda;
        private String Nome;
        private int CodigoC;
        private String DataVenda;
        private float ValorTotalP;
        private float ValorTotal;
        private int qtdVendida;
        private String TipoPagamento;
        private float total;

        public float getTotal() {
            return total;
        }

        public void setTotal(float total) {
            this.total = total;
        }

        public int getCodigoC() {
            return CodigoC;
        }

        public void setCodigoC(int Codigo) {
            this.CodigoC = Codigo;
        }

        public int getCodigoVenda() {
            return CodigoVenda;
        }

        public void setCodigoVenda(int CodigoVenda) {
            this.CodigoVenda = CodigoVenda;
        }

        public String getNome() {
            return Nome;
        }

        public void setNome(String Nome) {
            this.Nome = Nome;
        }

        public String getDataVenda() {
            return DataVenda;
        }

        public void setDataVenda(String DataVenda) {
            this.DataVenda = DataVenda;
        }


        public float getValorTotalP() {
            return ValorTotalP;
        }

        public void setValorTotalP(float ValorTotalP) {
            this.ValorTotalP = ValorTotalP;
        }

        public float getValorTotal() {
            return ValorTotal;
        }

        public void setValorTotal(float ValorTotal) {
            this.ValorTotal = ValorTotal;
        }

        public int getQtdVendida() {
            return qtdVendida;
        }

        public void setQtdVendida(int qtdVendida) {
            this.qtdVendida = qtdVendida;
        }

        public String getTipoPagamento() {
            return TipoPagamento;
        }

        public void setTipoPagamento(String TipoPagamento) {
            this.TipoPagamento = TipoPagamento;
        }
        
        
        
        
        
        
    
}
