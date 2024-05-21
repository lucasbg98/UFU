package views;


import javax.swing.JOptionPane;
import model.Produto;
import model.ProdutoDAO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Pc
 */
public class CadastroProduto extends javax.swing.JFrame {

    
    Principal p;
    
    RemoverProduto rmp =new RemoverProduto();
    int pro;
    public Principal getP() {
        return p;
    }

    public void setP(Principal p) {
        this.p = p;
    }
    

    
    
    
    
    public CadastroProduto() {
        initComponents();
        BNovo.setEnabled(true);
        BSalvar.setEnabled(false);
        BAlterar.setEnabled(false);
        BRemover.setEnabled(false);
        BAnt.setEnabled(false);
        BProx.setEnabled(false);
        
        
        CampoDescricao.setEnabled(false);
        CampoCodigo.setEnabled(false);
        Campoqtd.setEnabled(false);
        CampoValor.setEnabled(false);
        CampoForne.setEnabled(false);
    }
    
   public int Buscacod(int codigo){
       
        for(int i=0;i<=p.contp;i++){
            
            if(p.produto[i].getCodigoP()==codigo){
                return 1;
            }
            
        }
        
        return 0;
    
    
}
    
   
   
   
   
   public void Exibir(int cad){
        
        try{
            
            CampoDescricao.setText(p.produto[cad].getDescricaoP());
            CampoCodigo.setText(Integer.toString(p.produto[cad].getCodigoP()));
            //CampoForne.setText(Integer.toString(p.produto[cad].getFornecedor()));
            CampoValor.setText(Integer.toString((int) p.produto[cad].getValorUnitario()));
            Campoqtd.setText(Integer.toString(p.produto[cad].getQtdEstoque()));
            
            
           
           
        }catch(ArrayIndexOutOfBoundsException e){
            
            JOptionPane.showMessageDialog(null,"Sem informacoes para tras!");
        
            
        }catch(NullPointerException e){
            
            
            JOptionPane.showMessageDialog(null, "Sem informacoes para frente!");   
                
                
        }
        
        
        
    }
    
    

    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        Descricao = new javax.swing.JLabel();
        Código = new javax.swing.JLabel();
        qtdEstoque = new javax.swing.JLabel();
        ValorUnitario = new javax.swing.JLabel();
        CampoFornecedor = new javax.swing.JLabel();
        CampoDescricao = new javax.swing.JTextField();
        CampoCodigo = new javax.swing.JTextField();
        Campoqtd = new javax.swing.JTextField();
        CampoValor = new javax.swing.JTextField();
        CampoForne = new javax.swing.JTextField();
        jSeparator1 = new javax.swing.JSeparator();
        jSeparator2 = new javax.swing.JSeparator();
        BSalvar = new javax.swing.JButton();
        BNovo = new javax.swing.JButton();
        BAlterar = new javax.swing.JButton();
        BRemover = new javax.swing.JButton();
        BAnt = new javax.swing.JButton();
        BProx = new javax.swing.JButton();
        jSeparator3 = new javax.swing.JSeparator();
        jSeparator4 = new javax.swing.JSeparator();
        jComboBox1 = new javax.swing.JComboBox<>();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Produtos");
        setBackground(new java.awt.Color(153, 255, 0));

        Descricao.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        Descricao.setText("Descrição");

        Código.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        Código.setText("Código");

        qtdEstoque.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        qtdEstoque.setText("Quantidade Estoque");

        ValorUnitario.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        ValorUnitario.setText("Valor Unitário");

        CampoFornecedor.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        CampoFornecedor.setText("Código Fornecedor");

        CampoCodigo.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                CampoCodigoActionPerformed(evt);
            }
        });

        Campoqtd.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                CampoqtdActionPerformed(evt);
            }
        });

        CampoValor.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                CampoValorActionPerformed(evt);
            }
        });

        CampoForne.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                CampoForneActionPerformed(evt);
            }
        });

        BSalvar.setText("Salvar");
        BSalvar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BSalvarActionPerformed(evt);
            }
        });

        BNovo.setText("Novo");
        BNovo.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BNovoActionPerformed(evt);
            }
        });

        BAlterar.setText("Alterar");
        BAlterar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BAlterarActionPerformed(evt);
            }
        });

        BRemover.setText("Remover");
        BRemover.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BRemoverActionPerformed(evt);
            }
        });

        BAnt.setText("Anterior");
        BAnt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BAntActionPerformed(evt);
            }
        });

        BProx.setText("Próximo");
        BProx.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BProxActionPerformed(evt);
            }
        });

        jComboBox1.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Item 1", "Item 2", "Item 3", "Item 4" }));
        jComboBox1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jComboBox1ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(20, 20, 20)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(Descricao)
                            .addComponent(Código)
                            .addComponent(qtdEstoque)
                            .addComponent(ValorUnitario)
                            .addComponent(CampoFornecedor))
                        .addGap(25, 25, 25)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(CampoDescricao, javax.swing.GroupLayout.PREFERRED_SIZE, 200, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                                    .addComponent(CampoCodigo, javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(Campoqtd, javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(CampoValor, javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(CampoForne, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.DEFAULT_SIZE, 77, Short.MAX_VALUE))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 73, Short.MAX_VALUE)
                                .addComponent(jComboBox1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(121, 121, 121)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(BAlterar)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(BAnt)
                                .addGap(26, 26, 26)
                                .addComponent(BProx)))))
                .addGap(39, 39, 39))
            .addGroup(layout.createSequentialGroup()
                .addGap(20, 20, 20)
                .addComponent(BRemover)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addComponent(BNovo)
                .addGap(28, 28, 28)
                .addComponent(BSalvar)
                .addGap(24, 24, 24))
            .addComponent(jSeparator3, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator4, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator1, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator2, javax.swing.GroupLayout.Alignment.TRAILING)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jSeparator2, javax.swing.GroupLayout.PREFERRED_SIZE, 10, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(10, 10, 10)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(Descricao)
                    .addComponent(CampoDescricao, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(32, 32, 32)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(Código)
                    .addComponent(CampoCodigo, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jComboBox1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(36, 36, 36)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(qtdEstoque)
                    .addComponent(Campoqtd, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(27, 27, 27)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(ValorUnitario)
                    .addComponent(CampoValor, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(29, 29, 29)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(CampoFornecedor)
                    .addComponent(CampoForne, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addComponent(jSeparator4, javax.swing.GroupLayout.PREFERRED_SIZE, 10, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jSeparator1, javax.swing.GroupLayout.PREFERRED_SIZE, 10, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(BSalvar)
                    .addComponent(BNovo)
                    .addComponent(BAlterar)
                    .addComponent(BRemover))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 37, Short.MAX_VALUE)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(BAnt)
                    .addComponent(BProx))
                .addGap(11, 11, 11)
                .addComponent(jSeparator3, javax.swing.GroupLayout.PREFERRED_SIZE, 10, javax.swing.GroupLayout.PREFERRED_SIZE))
        );

        pack();
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void CampoValorActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_CampoValorActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_CampoValorActionPerformed

    private void CampoForneActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_CampoForneActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_CampoForneActionPerformed

    private void BSalvarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BSalvarActionPerformed
       
        if(p.contp==9){
             
             JOptionPane.showMessageDialog(null,"Limite maximo de produtos cadastrados!!"+"\n"+"Cadastrados:(10)");
        }else{
             
           if(Buscacod(Integer.parseInt(CampoCodigo.getText()))==1){
             JOptionPane.showMessageDialog(null,"O codigo já está sendo utilizado,informe novamente!");
                 
        }else{
                 
        
        
            p.contp++;
            pro=p.contp;
       
            p.produto[p.contp]=new Produto(); 
      
            p.produto[p.contp].cadastro(Integer.parseInt(CampoCodigo.getText()),CampoDescricao.getText(),Integer.parseInt(Campoqtd.getText()),Float.parseFloat(CampoValor.getText()),Integer.parseInt(CampoForne.getText()));
            
            
        
            CampoDescricao.setEnabled(false);
            CampoCodigo.setEnabled(false);
            Campoqtd.setEnabled(false);
            CampoValor.setEnabled(false);
            CampoForne.setEnabled(false);

            BAlterar.setEnabled(true);
            BNovo.setEnabled(true);
            BRemover.setEnabled(true);

            BSalvar.setEnabled(false);
       
            ProdutoDAO.salvar(p.produto[p.contp]);
       
       }
           
      }
        
        
        
        
    }//GEN-LAST:event_BSalvarActionPerformed

    private void BNovoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BNovoActionPerformed
        
        CampoCodigo.setText("");
        CampoDescricao.setText("");
        Campoqtd.setText("");
        CampoValor.setText("");
        CampoForne.setText("");
        
        CampoCodigo.setEnabled(true);
        CampoDescricao.setEnabled(true);
        Campoqtd.setEnabled(true);
        CampoValor.setEnabled(true);
        CampoForne.setEnabled(true);
        
        
        
        BNovo.setEnabled(false);
        BSalvar.setEnabled(true);
        BAlterar.setEnabled(true);
        BRemover.setEnabled(true);
        BAnt.setEnabled(true);
        BProx.setEnabled(true);
        
        
    }//GEN-LAST:event_BNovoActionPerformed

    private void BAlterarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BAlterarActionPerformed
        
        if(p.contp==-1){
            JOptionPane.showMessageDialog(null,"Não há produtos cadastrados!");
        }else{
        
         if(BAlterar.getText().equals("Alterar")){
             
             
             BAlterar.setText("Salvar");
             CampoCodigo.setEnabled(true);
             CampoDescricao.setEnabled(true);
             Campoqtd.setEnabled(true);
             CampoValor.setEnabled(true);
             CampoForne.setEnabled(true);
             
             BNovo.setEnabled(false);
             BSalvar.setEnabled(false);
             BAlterar.setEnabled(true);
             BRemover.setEnabled(false);
             BAnt.setEnabled(false);
             BProx.setEnabled(false);
             
             
         }else{
              int opcao;
              opcao=JOptionPane.showConfirmDialog(null,"Realmente deseja alterar os dados?","Alterando...",JOptionPane.OK_CANCEL_OPTION);
         
             if(opcao==0){
             p.produto[pro].cadastro(Integer.parseInt(CampoCodigo.getText()),CampoDescricao.getText(),Integer.parseInt(Campoqtd.getText()),Float.parseFloat(CampoValor.getText()),Integer.parseInt(CampoForne.getText()));
             
             CampoCodigo.setEnabled(false);
             CampoDescricao.setEnabled(false);
             Campoqtd.setEnabled(false);
             CampoValor.setEnabled(false);
             CampoForne.setEnabled(false);
             
             
             BSalvar.setEnabled(false);
             BProx.setEnabled(true);
             BAnt.setEnabled(true);
             BRemover.setEnabled(true);
             BNovo.setEnabled(true);
             
             BAlterar.setText("Alterar");
             
             
             }
          }
       } 
    }//GEN-LAST:event_BAlterarActionPerformed

    private void CampoCodigoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_CampoCodigoActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_CampoCodigoActionPerformed

    private void BRemoverActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BRemoverActionPerformed
        if(p.contp==-1){
            JOptionPane.showMessageDialog(null,"Não há produtos cadastrados!");
        }else{
            rmp.setVisible(true);
            rmp.setP(p);
            
            
        }
    }//GEN-LAST:event_BRemoverActionPerformed

    private void BAntActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BAntActionPerformed
        if(pro ==0){
            Exibir(pro-1);
            
            
        }else{
            
            pro--;
            Exibir(pro);
        }
    }//GEN-LAST:event_BAntActionPerformed

    private void BProxActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BProxActionPerformed
         if(pro == p.contf){
            Exibir(pro+1);
            
        }else{
        
            pro++;
            Exibir(pro);
        }
    }//GEN-LAST:event_BProxActionPerformed

    private void CampoqtdActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_CampoqtdActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_CampoqtdActionPerformed

    private void jComboBox1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jComboBox1ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_jComboBox1ActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(CadastroProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(CadastroProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(CadastroProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(CadastroProduto.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new CadastroProduto().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton BAlterar;
    private javax.swing.JButton BAnt;
    private javax.swing.JButton BNovo;
    private javax.swing.JButton BProx;
    private javax.swing.JButton BRemover;
    private javax.swing.JButton BSalvar;
    private javax.swing.JTextField CampoCodigo;
    private javax.swing.JTextField CampoDescricao;
    private javax.swing.JTextField CampoForne;
    private javax.swing.JLabel CampoFornecedor;
    private javax.swing.JTextField CampoValor;
    private javax.swing.JTextField Campoqtd;
    private javax.swing.JLabel Código;
    private javax.swing.JLabel Descricao;
    private javax.swing.JLabel ValorUnitario;
    private javax.swing.JComboBox<String> jComboBox1;
    private javax.swing.JSeparator jSeparator1;
    private javax.swing.JSeparator jSeparator2;
    private javax.swing.JSeparator jSeparator3;
    private javax.swing.JSeparator jSeparator4;
    private javax.swing.JLabel qtdEstoque;
    // End of variables declaration//GEN-END:variables
}
