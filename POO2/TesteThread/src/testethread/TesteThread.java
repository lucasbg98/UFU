/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package testethread;

/**
 *
 * @author Lucas
 */
public class TesteThread {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
         // Converting 'int' to 'Integer'
    int x = 123;
    Integer y = new Integer(x); // passing to constructor

    // Integer y = x;   //  or use simple assignment

    System.out.println("Before conversion: " + y.getClass().getName());

    System.out.println("After conversion: " + y.toString().getClass().getName());
    System.out.println("After conversion (using Static method): " + Integer.toString(x).getClass().getName());
  }
}
    

