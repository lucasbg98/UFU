/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import Interfaces.FactoryRelatorio;

/**
 *
 * @author Lucas
 */
public class FactoryRelatorioFornecedor implements FactoryRelatorio{
    
    
    @Override
    public void listar() {
        FornecedorDAO f = new FornecedorDAO();
        f.listFornecedores();
    }
}
