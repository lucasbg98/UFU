/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import Interfaces.StrategyProduto;

/**
 *
 * @author Lucas
 */
public class StrategyEletronico implements StrategyProduto {

    @Override
    public String setTipo() {
        return "Eletronico";
    }
    
}
