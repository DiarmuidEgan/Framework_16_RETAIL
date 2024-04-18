<?php
/**
* This file contains the ManagerManageProducts Class
* 
*/


/**
 * ManagerManageProducts is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for an <em><b>UNDER CONSTRUCTION</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 * 
 * This class is intended as a TEMPLATE - to be copied and modified to provide
 * specific panel content.  
 *
 * @author gerry.guinane
 * 
 */

class ManagerManageProducts extends PanelModel {
  
    /**
    * Constructor Method
    * 
    * The constructor for the PanelModel class. The ManageSystems class provides the 
    * panel content for up to 3 page panels.
    * 
    * @param User $user  The current user
    * @param MySQLi $db The database connection handle
    * @param Array $postArray Copy of the $_POST array
    * @param String $pageTitle The page Title
    * @param String $pageHead The Page Heading
    * @param String $pageID The currently selected Page ID
    * 
    */  
    function __construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID){  
        $this->modelType='ManagerManageProducts';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 

    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        switch ($this->pageID) {
            case "manageProducts":
                $this->panelHead_1='<h3>Manage Products</h3>';
                break;
            case "viewProducts":
                $this->panelHead_1='<h3>View Products</h3>';
                break;
            case "editProduct": 
	    $this->panelHead_1='<h3>Edit Product</h3>';
                break;
            case "addProduct": 
	    $this->panelHead_1='<h3>Add Product</h3>';
                break;
            default:  //DEFAULT menu item handler
                $this->panelHead_1='<h3>Manage Products</h3>';
                break;
            }//end switch   
    }
    
    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_1(){
        switch ($this->pageID) {
            case "manageProducts":  // menu item handler
                $this->panelContent_1="Panel 1 content for \$pageID <b>$this->pageID</b> menu item is under construction.";
                break;
            case "viewProducts":  //sample menu item handler
                //create a new table entity object
                $productsTable=new ProductsTable($this->db); 
                
                //query all records
                $rs=$productsTable->getAllRecords();
                
                //construct the content based on the query result
                if ($rs){
                    $this->panelContent_1= HelperHTML::generateTABLE($rs); //use the helper class to generate the table
                }
                else{
                    $this->panelContent_1='No product records found'; //table may be empty
                }
                break;

            case "editProduct":  // menu item handler
                $this->panelContent_1=Form::form_select_product($this->pageID);
                break;
            case "addProduct":  // menu item handler
                $productCategoriesTable= new ProductCategoriesTable($this->db);
                $this->panelContent_1=Form::form_add_product($productCategoriesTable, $this->pageID);
                break;
            default:  // DEFAULT menu item handler
                $this->panelContent_1="Panel 1 content for \$pageID <b>DEFAULT</b> menu item is under construction.";
                break;
            }//end switch   
    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        
        switch ($this->pageID) {
            case "manageProducts":  // menu item handler
                $this->panelHead_2='<h3>Manage Products</h3>';
                break;
            case "viewProducts":  // menu item handler
                $this->panelHead_2='<h3>View Products</h3>';
                break;
            case "editProduct":  // menu item handler
                $this->panelHead_2='<h3>Edit Product</h3>';
                break;
            case "addProduct":  // menu item handler
                $this->panelHead_2='<h3>Add Product</h3>';
                break;
            default:  // DEFAULT menu item handler
                $this->panelHead_2='<h3>Manage Products</h3>';
                break;
            }//end switch   
    }  
    
    /**
    * Set the Panel 2 text content 
    */ 
    public function setPanelContent_2(){
        switch ($this->pageID) {
            case "manageProducts":  // menu item handler
                $this->panelContent_2="Panel 1 content for \$pageID <b>$this->pageID</b> menu item is under construction.";
                break;
            case "viewProducts":  // menu item handler
                $this->panelContent_2="Panel 1 content for \$pageID <b>$this->pageID</b> menu item is under construction.";
                break;
            case "editProduct":  // menu item handler
                if(isset($this->postArray['btnProductSelect'])){  //check if the Panel 1 Product select button is pressed
                    $productCategoriesTable=new ProductCategoriesTable($this->db);
                    $productsTable= new ProductsTable($this->db);      
                    $rs=$productsTable->getRecordByProductCode($this->postArray['productCode']);
                    
                    if($rs){ //if the record exists display it in an edit form
                        $this->panelContent_2= Form::form_edit_product($productCategoriesTable, $rs, $this->pageID);
                    }
                    else{ //record doesn’t exist
                        $this->panelContent_2="No product found for code entered: ".$this->postArray['productCode']." -                              			please check and try again";
                    } 
                }
                elseif(isset($this->postArray['btnUpdateProduct'])){  //check if the update (save) button is pressed
                    $productsTable= new ProductsTable($this->db);     
                    if($productsTable->updateProduct($this->postArray)){ //try to update the record
                        $this->panelContent_2="Product record update successful";
                    }
                    else{  //update is not successful
                        $this->panelContent_2="Unable to update product record";
                    }    
                }
                else{  //no button has been pressed yet
                    $this->panelContent_2="Enter a valid product code in form";
                }
                break;
            case "addProduct":  // menu item handler
                if($_POST["btnAddProduct"])
                {
                    $tableEnt = new ProductsTable($this->db);
                    if($tableEnt->addProduct($_POST))
                    {
                        $this->panelContent_2="Success Added";
    
                    }
                    else
                    {
                        $this->panelContent_2="Failure";


                    }
                }
                else
                {
                    $this->panelContent_2="Enter";

                }
                break;
            default:  // DEFAULT menu item handler
                $this->panelContent_2="Panel 1 content for \$pageID <b>DEFAULT</b> menu item is under construction.";
                break;
            }//    }
        }
    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){ 
        switch ($this->pageID) {
            case "manageProducts":  // menu item handler
                $this->panelHead_3='<h3>Manage Products</h3>';
                break;
            case "viewProducts":  // menu item handler
                $this->panelHead_3='<h3>View Products</h3>';
                break;
            case "editProduct":  // menu item handler
                $this->panelHead_3='<h3>Edit Product</h3>';
                break;
            case "addProduct":  // menu item handler
                $this->panelHead_3='<h3>Add Product</h3>';
                break;
            default:  // DEFAULT menu item handler
                $this->panelHead_3='<h3>Manage Products</h3>';
                break;
            }//end switch   
    } 
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){
        $this->panelContent_3= "Panel 3 content for <b>$this->pageHeading</b> menu item is under construction.";
    }        

        
        
}
        