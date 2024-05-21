package views;


import javax.swing.JMenu;
import javax.swing.JOptionPane;
import model.Cliente;
import model.ClienteDAO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Pc
 */
public class Cadastro extends javax.swing.JFrame {

    //getter e setter do principal// 
 

    int cad;
    Principal p;
    
    RemoverCadastro rmc = new RemoverCadastro();
    public Principal getP() {
        return p;
    }

    public void setP(Principal p) {
        this.p = p;
    }
    
    public Cadastro() {
        initComponents();
        setLocationRelativeTo( null );
        
        
        BSalvar.setEnabled(false);
        BAlterar.setEnabled(false);
        BRemover.setEnabled(false);
        BProx.setEnabled(false);
        BAnt.setEnabled(false);
        
        CampoNome.setEnabled(false);
        CampoData.setEnabled(false);
        CampoCodigo.setEnabled(false);
        CampoEndereco.setEnabled(false);        
        
 
    }
    
    public void Exibir(int cad){
        
        try{
            
            CampoNome.setText(p.cliente[cad].getNome());
            CampoCodigo.setText(Integer.toString(p.cliente[cad].getCodigo()));
            CampoData.setText(p.cliente[cad].getDataNasc());
            CampoEndereco.setText(p.cliente[cad].getEndereco());
           
        }catch(ArrayIndexOutOfBoundsException e){
            
            JOptionPane.showMessageDialog(null,"Sem informacoes para tras!");
        
            
        }catch(NullPointerException e){
            
            
            JOptionPane.showMessageDialog(null, "Sem informacoes para frente!");   
                
                
        }
        
        
        
    }
    
    
    
    
    
    
    public int Buscacod(int codigo){
        
        for(int i=0;i<=p.cont;i++){
           if(p.cliente[i].getCodigo()==codigo) return 1;  
        }
        return 0;
        
        
    }
    
    

    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel4 = new javax.swing.JLabel();
        CampoNome = new javax.swing.JTextField();
        CampoCodigo = new javax.swing.JTextField();
        CampoData = new javax.swing.JTextField();
        CampoEndereco = new javax.swing.JTextField();
        jSeparator1 = new javax.swing.JSeparator();
        jSeparator2 = new javax.swing.JSeparator();
        BSalvar = new javax.swing.JButton();
        BNovo = new javax.swing.JButton();
        BAlterar = new javax.swing.JButton();
        BRemover = new javax.swing.JButton();
        BProx = new javax.swing.JButton();
        BAnt = new javax.swing.JButton();
        jSeparator3 = new javax.swing.JSeparator();
        jSeparator4 = new javax.swing.JSeparator();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        setTitle("Clientes");

        jLabel1.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jLabel1.setText("Nome");

        jLabel2.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jLabel2.setText("Código");

        jLabel3.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jLabel3.setText("Data de Nascimento");

        jLabel4.setFont(new java.awt.Font("Tahoma", 0, 12)); // NOI18N
        jLabel4.setText("Endereço");

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

        BProx.setText("Proximo");
        BProx.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BProxActionPerformed(evt);
            }
        });

        BAnt.setText("Anterior");
        BAnt.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                BAntActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(22, 22, 22)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                .addComponent(BRemover, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addGap(18, 18, 18)
                                .addComponent(BAlterar)
                                .addGap(72, 72, 72)
                                .addComponent(BNovo, javax.swing.GroupLayout.PREFERRED_SIZE, 72, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(18, 18, 18)
                                .addComponent(BSalvar, javax.swing.GroupLayout.PREFERRED_SIZE, 67, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                .addComponent(BAnt)
                                .addGap(18, 18, 18)
                                .addComponent(BProx)
                                .addGap(113, 113, 113))))
                    .addGroup(javax.swing.GroupLayout.Alignment.LEADING, layout.createSequentialGroup()
                        .addGap(19, 19, 19)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 44, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(jLabel2)
                            .addComponent(jLabel3)
                            .addComponent(jLabel4))
                        .addGap(22, 22, 22)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                .addComponent(CampoNome)
                                .addComponent(CampoEndereco, javax.swing.GroupLayout.DEFAULT_SIZE, 224, Short.MAX_VALUE))
                            .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                                .addComponent(CampoCodigo, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.DEFAULT_SIZE, 117, Short.MAX_VALUE)
                                .addComponent(CampoData, javax.swing.GroupLayout.Alignment.LEADING)))
                        .addGap(0, 0, Short.MAX_VALUE)))
                .addContainerGap())
            .addComponent(jSeparator1, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator2, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator3, javax.swing.GroupLayout.Alignment.TRAILING)
            .addComponent(jSeparator4)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jSeparator3, javax.swing.GroupLayout.PREFERRED_SIZE, 7, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel1)
                    .addComponent(CampoNome, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(29, 29, 29)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel2)
                    .addComponent(CampoCodigo, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(38, 38, 38)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel3)
                    .addComponent(CampoData, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(41, 41, 41)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel4)
                    .addComponent(CampoEndereco, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(41, 41, 41)
                .addComponent(jSeparator4, javax.swing.GroupLayout.PREFERRED_SIZE, 2, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jSeparator1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(BRemover, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.PREFERRED_SIZE, 23, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                        .addComponent(BSalvar, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(BNovo, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(BAlterar, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)))
                .addGap(34, 34, 34)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(BProx)
                    .addComponent(BAnt))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jSeparator2, javax.swing.GroupLayout.PREFERRED_SIZE, 2, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addContainerGap())
        );

        pack();
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void BAntActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BAntActionPerformed
        if(cad ==0){
            Exibir(cad-1);
            
            
        }else{
            
            cad--;
            Exibir(cad);
        }
    }//GEN-LAST:event_BAntActionPerformed

    private void BSalvarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BSalvarActionPerformed
        
        
     
     
        if(p.cont==9){
             
             JOptionPane.showMessageDialog(null,"Limite maximo de cadastro atingido!!"+"\n"+"Cadastrados:(10)");
         }else{
             
             if(Buscacod(Integer.parseInt(CampoCodigo.getText()))==1){
                 
                 JOptionPane.showMessageDialog(null,"O codigo já está sendo utilizado,informe novamente!");
                 
             }else{
                 
                 p.cont++; 
                 
                         
                 p.cliente[p.cont]=new Cliente();   
                 p.cliente[p.cont].CadastroCliente(Integer.parseInt(CampoCodigo.getText()),CampoNome.getText(),CampoData.getText(),CampoEndereco.getText());
                 ClienteDAO.salvar(p.cliente[p.cont]);
                 
                    
                 BSalvar.setEnabled(false);
                 BAnt.setEnabled(true);
                 BProx.setEnabled(true);
                 BNovo.setEnabled(true);
                 
                 CampoNome.setEnabled(false);
                 CampoData.setEnabled(false);
                 CampoCodigo.setEnabled(false);
                 CampoEndereco.setEnabled(false); 
                 
                 cad=p.cont;
                 
                }
             
                
               
        }
    }//GEN-LAST:event_BSalvarActionPerformed

    private void BNovoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BNovoActionPerformed
        
   
        BSalvar.setEnabled(true);
        BAlterar.setEnabled(true);
        BRemover.setEnabled(true);
        BProx.setEnabled(true);
        BAnt.setEnabled(true);
        BNovo.setEnabled(false);
        
        
        
        CampoNome.setEnabled(true);
        CampoCodigo.setEnabled(true);
        CampoData.setEnabled(true);
        CampoEndereco.setEnabled(true);
        
        CampoNome.setText("");
        CampoCodigo.setText("");
        CampoData.setText("");
        CampoEndereco.setText("");
        
        
       
    }//GEN-LAST:event_BNovoActionPerformed

    private void BRemoverActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BRemoverActionPerformed
       
        if(p.cont==-1){
            JOptionPane.showMessageDialog(null,"Não há clientes cadastrados!");
            
        }else{
        
            rmc.setVisible(true);
            rmc.setP(p);
            
            
            
        }   

        
       
            
        
        
    }//GEN-LAST:event_BRemoverActionPerformed

    private void BProxActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BProxActionPerformed
        if(cad == p.cont){
            Exibir(cad+1);
            
        }else{
        
            cad++;
            Exibir(cad);
        }
    }//GEN-LAST:event_BProxActionPerformed

    private void BAlterarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_BAlterarActionPerformed
        
        if(p.cont==-1){
            JOptionPane.showMessageDialog(null,"Não há clientes cadastrados!");
            
        }else{
        
        
        
        if(BAlterar.getText().equals("Alterar")){
            CampoNome.setEnabled(true);
            CampoCodigo.setEnabled(true);
            CampoData.setEnabled(true);
            CampoEndereco.setEnabled(true);

            BAlterar.setText("Salvar");

            BSalvar.setEnabled(false);
            BProx.setEnabled(false);
            BAnt.setEnabled(false);
            BRemover.setEnabled(false);
            BNovo.setEnabled(false);
        }else{
            int opcao;
            opcao=JOptionPane.showConfirmDialog(null,"Realmente deseja alterar os dados?","Alterando...",JOptionPane.OK_CANCEL_OPTION);
         
             if(opcao==0){
            
            p.cliente[cad].CadastroCliente(Integer.parseInt(CampoCodigo.getText()),CampoNome.getText(),CampoData.getText(),CampoEndereco.getText());

            BSalvar.setEnabled(false);
            BProx.setEnabled(true);
            BAnt.setEnabled(true);
            BRemover.setEnabled(true);
            BNovo.setEnabled(true);

            CampoNome.setEnabled(false);
            CampoCodigo.setEnabled(false);
            CampoData.setEnabled(false);
            CampoEndereco.setEnabled(false);

            BAlterar.setText("Alterar");
           }

        }
    }
        
        
    }//GEN-LAST:event_BAlterarActionPerformed

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
            java.util.logging.Logger.getLogger(Cadastro.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Cadastro.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Cadastro.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Cadastro.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Cadastro().setVisible(true);
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
    private javax.swing.JTextField CampoData;
    private javax.swing.JTextField CampoEndereco;
    private javax.swing.JTextField CampoNome;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JSeparator jSeparator1;
    private javax.swing.JSeparator jSeparator2;
    private javax.swing.JSeparator jSeparator3;
    private javax.swing.JSeparator jSeparator4;
    // End of variables declaration//GEN-END:variables

    
}
