<?php
/**
* This file contains the ProductCategoriesTable Class Template
* 
*/

/**
 * 
 * ProductCategoriesTable entity class implements the table entity class for the 'ProductCategoriesTable' table in the database. 
 * 
 * 
 * 
 * 
 * @author Gerry Guinane
 * 
 */

class ProductCategoriesTable extends TableEntity {

    /**
     * Constructor for the ProductCategoriesTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'ProductCategories');  //the name of the table is passed to the parent constructor
    }
    //END METHOD: Construct
   
 
    
}
