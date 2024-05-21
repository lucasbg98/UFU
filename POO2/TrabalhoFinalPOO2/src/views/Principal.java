package views;


import javax.swing.JOptionPane;
import model.Cliente;
import model.Fornecedor;
import model.Movimento;
import model.Produto;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Pc
 */
public class Principal extends javax.swing.JFrame {

    /**
     * Creates new form Principal
     */
    public Principal() {
        initComponents();
    }
    
    
    
     int cont=-1;
     int contp=-1;
     int contf=-1;
     int contm=-1;
     
    Cliente[] cliente=new Cliente[10];
    Fornecedor[] fornecedor = new Fornecedor[10];
    Produto[] produto = new Produto[10];
    Movimento[] movimento = new Movimento[10];
    
    
    CadastroFornecedor janela0 =new CadastroFornecedor();
    Cadastro janela1 = new Cadastro();
    CadastroProduto janela2 = new CadastroProduto();
    CadastroMovimento janela3 = new CadastroMovimento();
    RelatorioCliente janela4= new RelatorioCliente();
    RelatorioProduto janela5=new RelatorioProduto();
    RelatorioFornecedor janela6 =new RelatorioFornecedor();
    
    
    
    
    
    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jMenuBar1 = new javax.swing.JMenuBar();
        Cadastro = new javax.swing.JMenu();
        Clientes = new javax.swing.JMenuItem();
        Fornecedor = new javax.swing.JMenuItem();
        Produtos = new javax.swing.JMenuItem();
        Movimento = new javax.swing.JMenuItem();
        Relatorios = new javax.swing.JMenu();
        jMenuItem2 = new javax.swing.JMenuItem();
        Fornecedores = new javax.swing.JMenuItem();
        RProduto = new javax.swing.JMenuItem();
        jMenuItem4 = new javax.swing.JMenuItem();
        Sobre = new javax.swing.JMenu();
        jMenuItem1 = new javax.swing.JMenuItem();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        jLabel1.setLabelFor(Clientes);

        Cadastro.setText("Cadastro");

        Clientes.setText("Clientes");
        Clientes.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                ClientesActionPerformed(evt);
            }
        });
        Cadastro.add(Clientes);

        Fornecedor.setText("Fornecedor");
        Fornecedor.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                FornecedorActionPerformed(evt);
            }
        });
        Cadastro.add(Fornecedor);

        Produtos.setText("Produtos");
        Produtos.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                ProdutosActionPerformed(evt);
            }
        });
        Cadastro.add(Produtos);

        Movimento.setText("Movimentos");
        Movimento.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                MovimentoActionPerformed(evt);
            }
        });
        Cadastro.add(Movimento);

        jMenuBar1.add(Cadastro);

        Relatorios.setText("Relatorios");

        jMenuItem2.setText("Clientes");
        jMenuItem2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jMenuItem2ActionPerformed(evt);
            }
        });
        Relatorios.add(jMenuItem2);

        Fornecedores.setText("Fornecedores");
        Fornecedores.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                FornecedoresActionPerformed(evt);
            }
        });
        Relatorios.add(Fornecedores);

        RProduto.setText("Produtos");
        RProduto.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                RProdutoActionPerformed(evt);
            }
        });
        Relatorios.add(RProduto);

        jMenuItem4.setText("Movimentos");
        Relatorios.add(jMenuItem4);

        jMenuBar1.add(Relatorios);

        Sobre.setText("Sobre");
        Sobre.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                SobreActionPerformed(evt);
            }
        });

        jMenuItem1.setText("Info");
        jMenuItem1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jMenuItem1ActionPerformed(evt);
            }
        });
        Sobre.add(jMenuItem1);

        jMenuBar1.add(Sobre);

        setJMenuBar(jMenuBar1);

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 845, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(0, 0, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 565, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(0, 0, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void SobreActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_SobreActionPerformed
         
    }//GEN-LAST:event_SobreActionPerformed

    private void jMenuItem1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jMenuItem1ActionPerformed
        JOptionPane.showMessageDialog(null,"Funcionalidades:Cadastrar,Remover,Alterar,Consultar, dados de clientes,fornecedores,produtos e movimentos" + "\n"
         +"Padores utilizados: Utilização do padrão strategy, para os diferentes tipos de produtos na hora da categorização, Utilização do padrão Abstract Factory para criação dos objetos relatorio para cada tipo de classe contida no programa"+ "\n" 
                +"Relatórios:Gera um relatório de dados de todas compras realizadas"+"\n\n"
         + "Software desenvolvido pelo aluno Lucas Braganca"+
           "\n\n\t"+"-Universidade Federal de Uberlandia"+"\n\t"+"-Campus:Monte Carmelo(UFU - MC)"
         +"\n\t"+"-Data:DD/MM/AA");
    }//GEN-LAST:event_jMenuItem1ActionPerformed

    private void ClientesActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_ClientesActionPerformed
        janela1.setVisible(true);
        janela1.setP(this);
       
     
       
        
    }//GEN-LAST:event_ClientesActionPerformed

    private void ProdutosActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_ProdutosActionPerformed
        janela2.setVisible(true);
        janela2.setP(this);
        
        
        
        
    }//GEN-LAST:event_ProdutosActionPerformed

    private void MovimentoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_MovimentoActionPerformed
        janela3.setVisible(true);
        janela3.setP(this);
        
    }//GEN-LAST:event_MovimentoActionPerformed

    private void jMenuItem2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jMenuItem2ActionPerformed
           janela4.setVisible(true);
           janela4.setP(this);
          
           
    }//GEN-LAST:event_jMenuItem2ActionPerformed

    private void RProdutoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_RProdutoActionPerformed
            janela5.setVisible(true);
            janela5.setP(this);
    }//GEN-LAST:event_RProdutoActionPerformed

    private void FornecedorActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_FornecedorActionPerformed
            janela0.setVisible(true);
            janela0.setP(this);
           
            
    }//GEN-LAST:event_FornecedorActionPerformed

    private void FornecedoresActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_FornecedoresActionPerformed
            janela6.setVisible(true);
            janela6.setP(this);
    }//GEN-LAST:event_FornecedoresActionPerformed

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
            java.util.logging.Logger.getLogger(Principal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Principal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Principal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Principal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Principal().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JMenu Cadastro;
    private javax.swing.JMenuItem Clientes;
    private javax.swing.JMenuItem Fornecedor;
    private javax.swing.JMenuItem Fornecedores;
    private javax.swing.JMenuItem Movimento;
    private javax.swing.JMenuItem Produtos;
    private javax.swing.JMenuItem RProduto;
    private javax.swing.JMenu Relatorios;
    private javax.swing.JMenu Sobre;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JMenuBar jMenuBar1;
    private javax.swing.JMenuItem jMenuItem1;
    private javax.swing.JMenuItem jMenuItem2;
    private javax.swing.JMenuItem jMenuItem4;
    // End of variables declaration//GEN-END:variables
}
