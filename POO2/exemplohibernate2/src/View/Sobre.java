/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package View;

/**
 *
 * @author pc
 */
public class Sobre extends javax.swing.JInternalFrame {

    /**
     * Creates new form Sobre
     */
    public Sobre() {
        initComponents();
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTextArea1 = new javax.swing.JTextArea();

        jLabel1.setFont(new java.awt.Font("Noto Sans", 0, 18)); // NOI18N
        jLabel1.setText("Sobre o Projeto");

        jTextArea1.setColumns(20);
        jTextArea1.setRows(5);
        jTextArea1.setText("O software em questão foi desenvolvido pensando em uma clinica onde possui uma atendente para realizar toda a interação com o sistema.O software foi \nimplementado utilizando a IDE NetBeans e o banco de dados MySql Workbench 6.3, para realizar a conexão com o banco de dados em questão foi utilizado o\n framework Hibernate.\n\nPadrões de Projeto utilizados: Foi utilizado o padrão de projeto fabrica abstrata para criação dos diferentes tipos de médicos visando diminuir a repetição de \ncódigo transformando a criação algo genérico para todos os médicos. Para a parte de marcar consultas, será permitido criar apenas uma isntância da classe\nconsulta, sendo assim é criada apenas uma agenda para todos os médicos e para tal foi utilizado o padrão Singleton. No cenário de informações cada medico\npossui um valor de consulta, mas isso poderia se tornar algo repetitivo caso implementado em cada medico, para tornar isso digamos, genérico o padrão de \nprojetos Strategy foi utilizado.O padrão de projetos fachada foi utilizado no contexto de deletar os dados no banco de dados com um id da linha em questão a\nser deletada o metodo excluir executa os passos de pegar o objeto do id e passa então para o metodo exclusao.\n\n\n\nAluno:Eduardo Borges,Tulio Araujo,Marlon Brendo \nUniversidade Federal de Uberlandia \n");
        jScrollPane1.setViewportView(jTextArea1);

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 896, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel1))
                .addContainerGap(28, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel1)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jScrollPane1, javax.swing.GroupLayout.DEFAULT_SIZE, 399, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel jLabel1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextArea jTextArea1;
    // End of variables declaration//GEN-END:variables
}