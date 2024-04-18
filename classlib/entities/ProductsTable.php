<?php
/**
* This file contains the ProductsTable Class Template
* 
*/

/**
 * 
 * ChatMsgTable entity class implements the table entity class for the 'ProductsTable' table in the database. 
 * 
 * 
 * To use this TEMPLATE - change 'XXX' to the required tablename everywhere it appears 
 * 
 * eg: if you want to define a table  'SUPPLIER'
 * Rename this file - replace the 'XXX' with 'SUPPLIER' in the file name 
 * Then edit this file to REPLACE ALL 'XXX' in this file with 'SUPPLIER' 
 * Move this file to its correct folder in the project eg /classlib/entities/ 
 * Finally include this file in the index.php 
 * 
 * 
 * 
 * @author Gerry Guinane
 * 
 */

class ProductsTable extends TableEntity {

    /**
     * Constructor for the ProductsTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'products');  //the name of the table is passed to the parent constructor
    }
/**
     * 
     * Updates a product record in database table - products.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @return boolean
     */
    public function updateProduct($postArray){
        
        // use extract() toget the values entered in the registration form contained in the $postArray argument
        extract($postArray);

        //prepare the form values      
        $productCode= addslashes($productCode);//
        $productDescription= addslashes($productDescription);
        $productCategoriesID=(integer)$productCategoriesID;
        $productSellPrice=(float) $productSellPrice; 
        $productPurchasePrice=(float)$productPurchasePrice; 
        $quantityInStock=(integer) $quantityInStock;  
        
        //construct the INSERT SQL
        $this->SQL="UPDATE products
                    SET
                    ProductDescription='$productDescription',
                    ProductSellPrice=$productSellPrice,
                    ProductPurchasePrice=$productPurchasePrice,
                    QuantityInStock=$quantityInStock,
                    ProductCategoriesID=$productCategoriesID
                    WHERE
                    ProductCode='$productCode'
                    ";   
  
        //execute the query
        try {
            $rs=$this->db->query($this->SQL);
            return true;
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $this->MySQLiErrorNr=$e->getCode();
            $this->MySQLiErrorMsg=$e->getMessage();
            return false;
        }

    }
    public function getRecordByProductCode($code)
    {
          //construct the SQL query        
    $this->SQL="SELECT *
    FROM
          products p
    WHERE
           p.ProductCode = '".$code."';";

    //echo $this->SQL;

    //execute the query
    try {
        $rs=$this->db->query($this->SQL);
        if($rs->num_rows){
        return $rs; //return the recordset
    }
    else{
        return false;  //no records found
    }  
    } catch (mysqli_sql_exception $e) { //catch the exception 
        $this->MySQLiErrorNr=$e->getCode();
        $this->MySQLiErrorMsg=$e->getMessage();

        
        return false;  //the query failed for some reason
    }         
    }
    public function getAllRecords(){
        
        //construct the SQL query        
        $this->SQL="SELECT 
                           p.ProductCode,
                           p.ProductDescription,
                           ProductCategoriesDescription AS ProductCategory
                     FROM
                           products p,
                           productcategories pc
                     WHERE
                            p.ProductCategoriesID = pc.ProductCategoriesID;";
        
        
       //execute the query
       try {
               $rs=$this->db->query($this->SQL);
               if($rs->num_rows){
                   return $rs; //return the recordset
               }
               else{
                   return false;  //no records found
               }  
       } catch (mysqli_sql_exception $e) { //catch the exception 
               $this->MySQLiErrorNr=$e->getCode();
               $this->MySQLiErrorMsg=$e->getMessage();
               return false;  //the query failed for some reason
           }        

   }  

    /**
     * 
     * Adds a new record to the database table - products.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @param string $userType The current user type 
     * @return boolean
     */
    public function addProduct($postArray){
        
        // use extract() toget the values entered in the registration form contained in the $postArray argument
        extract($postArray);

        //prepare the form values      
        $productCode= addslashes($productCode);//
        $productDescription= addslashes($productDescription);
        $productCategoriesID=(integer)$productCategoriesID;
        $productSellPrice=(float) $productSellPrice; 
        $productPurchasePrice=(float)$productPurchasePrice; 
        $quantityInStock=(integer) $quantityInStock;  
        
        //construct the INSERT SQL
        
        //construct the INSERT SQL
        $this->SQL="INSERT INTO products
                    (
                    ProductCode,
                    ProductDescription,
                    ProductSellPrice,
                    ProductPurchasePrice,
                    QuantityInStock,
                    ProductCategoriesID)
                    VALUES
                    (
                    '$productCode',
                    '$productDescription',
                    $productSellPrice,
                    $productPurchasePrice,
                    $quantityInStock,
                    $productCategoriesID
                    )";   
  
        //execute the insert query
        try {
            $rs=$this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $this->MySQLiErrorNr=$e->getCode();
            $this->MySQLiErrorMsg=$e->getMessage();
            return false;
        }
        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;}
    } 
/**
     * Returns a MySQLi resultset record for the selected product code if it exists. False if it does not exist. 
     * 
     * @param string $productCode The product code to be searched for
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object
     */ 
    public function getRecordByID($productCode){ 
        
        //construct the SQL query        
        $this->SQL="SELECT 
                           p.*,
                           ProductCategoriesDescription AS ProductCategory
                     FROM
                           products p,
                           productcategories pc
                     WHERE
                            p.ProductCategoriesID = pc.ProductCategoriesID 
                            AND p.ProductCode='$productCode'";
        
       try {
               $rs=$this->db->query($this->SQL);
               if($rs->num_rows===1){ //check that only one record is returned
                   return $rs; //return the requested recordset
               }
               else{
                   return false;  //no records found
               }  
       } catch (mysqli_sql_exception $e) { //catch the exception 
               $this->MySQLiErrorNr=$e->getCode();
               $this->MySQLiErrorMsg=$e->getMessage();
               return false;  //the query failed for some reason
           }        
            
       
   }



    //END METHOD: Construct
   
    
   
    
}

