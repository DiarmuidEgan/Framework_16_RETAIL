<?php
/**
* This file contains the Form Class
* 
*/

/**
 * 
 * Form class - is a helper class that generates HTML forms  
 * 
 *  
 * @author Gerry Guinane
 * 
 */

class Form {

/**
 * Generates a HTML product select form 
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form. 
 * @return string String containing the generated form.
 */    
public static function form_select_product($pageID){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    $form.='<label for="productCode">Product Code</label><input required type="text" class="form-control" id="productCode" name="productCode" pattern="[a-zA-Z0-9\-]{1,11}" title="Alphanumeric Product Code with dashes eg 99999999-X">';
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnProductSelect">Select</button>';
    $form.='</form>';
    return $form;
} 

public static function form_select_team($pageID){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    $form.='<label for="productCode">Enter a team name</label><input type="text" class="form-control" id="t_code" name="t_code">';
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnTeamSelect">Select</button>';
    $form.='</form>';
    return $form;
} 

/**
 * get form for match
 * @param $pageID the page to post the form to
 */
public static function form_select_match($pageID, $selectTeam1, $selectTeam2){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    
    $form.='<label for="match-id">Enter a match id</label><input type="text" class="form-control"  name="match-id">';
    $form.='<label for="match-date">Enter a match date</label><input type="date" class="form-control"  name="match-date">';
    $form.='<label for="match-result">Enter result</label><input type="text" class="form-control"  name="match-result">';
    $form.='<label for="match-team1">Enter team1</label>'.$selectTeam1;
    $form.='<label for="match-team2">Enter team2</label>'.$selectTeam2;

    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnTeamSelect">Select</button>';
    $form.='</form>';
    return $form;
} 


public static function form_update_match($pageID, $t1="", $t2="", $date=""){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    $form.='<label >Enter match id</label><input type="text" class="form-control" id="t_code" name="m_code" value="'.$t1.'">';
    $form.='<label >Enter team id 1</label><input type="text" class="form-control" id="t_code" name="t1_code" value="'.$t1.'">';
    $form.='<label >Enter team id 2</label><input type="text" class="form-control" id="t_code" name="t2_code" value="'.$t2.'">';
    $form.='<label >Enter a date and time</label><input type="text" class="form-control" id="t_code" name="date_code" value="'.$date.'">';

    
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnTeamSelect">Select</button>';
    $form.='</form>';
    return $form;
} 


public static function form_select_id($pageID){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    $form.='<label for="productCode">Enter a teamid</label><input type="text" class="form-control" id="t_code" name="t_code">';
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnTeamSelect">Select</button>';
    $form.='</form>';
    return $form;
}

public static function form_update_id($pageID){
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    $form.='<label>Enter a teamid</label><input type="text" class="form-control" id="t_code" name="t_code">';
    $form.='<label>Enter a new team name</label><input type="text" class="form-control" id="t_content" name="t_content">';
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnTeamSelect">Select</button>';
    $form.='</form>';
    return $form;
}
/**
 * 
 * Generates a HTML form for editing account details. 
 * 
 * The form generated will display but does not permit editing of the users ID.  
 * 
 * @param ProductCategoriesTable $productCategoriesTable A county table entity object.
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @param mysqli_result $productRecord Resultset containing a single selected product record 
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_edit_product($productCategoriesTable,$productRecord, $pageID){

    //prepare an array of product categories for the drop down list
    $productCategoriesList=array();
    if($rs=$productCategoriesTable->select_all()){
        while ($row = $rs->fetch_assoc()){
            $productCategoriesList[$row['ProductCategoriesID']]=$row['ProductCategoriesDescription'];   //build an array of county names $countyList
        }
    } 

    //prepare the selected product record
    $productRecord->data_seek(0);
    $productRecordArray=$productRecord->fetch_assoc();
    
    extract($productRecordArray); //makes constructing the form a little easier
    
    //construct the form
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    
    //form input fields for product code and description
    $form.='<label for="productCode">Product Code [Read Only]</label><input required readonly type="text" class="form-control" value="'.$ProductCode.'" id="productCode" name="productCode" pattern="[a-zA-Z0-9\-]{1,11}" title="Alphanumeric Product Code with dashes eg 99999999-X">';
    $form.='<label for="productDescription">Product Description</label><input required type="text" class="form-control" value="'.$ProductDescription.'" id="productDescription" name="productDescription" pattern="[a-zA-Z0-9óáéí\'()\- ]{1,45}" title="Product Description">';

    //form input drop down list (Select) for categories
    $form.='<label for="productCategoriesID">Product Category (default category : UNCLASSIFIED)</label>';
    $form.='<select class="form-control" id="productCategoriesID" name="productCategoriesID">';
          $form.= '<option value="'.$ProductCategoriesID.'" selected>'.$ProductCategory.'</option>';
      foreach($productCategoriesList as $key=>$value){
          $form.= '<option value="'.$key.'">'.$value.'</option>';  
      }
    $form.='</select>';
    
    //form input fields for product selling price, purchase price and quantity in stock
    $form.='<label for="productSellPrice">Product Retail Selling Price</label><input required type="text" class="form-control" value="'.$ProductSellPrice.'" id="productSellPrice" name="productSellPrice" pattern="^(\d{1,5}|\d{0,5}\.\d{1,2})$" title="Product Sell Price - [2 Places Decimal]">';
    $form.='<label for="productPurchasePrice">Product Purchase Price</label><input required type="text" class="form-control" value="'.$ProductPurchasePrice.'" id="productPurchasePrice" name="productPurchasePrice" pattern="^(\d{1,5}|\d{0,5}\.\d{1,2})$" title="Product Purchase Price - [2 places Decimal]">';
    $form.='<label for="quantityInStock">Quantity In Stock [Default 0]</label><input required type="text" class="form-control" value="'.$QuantityInStock.'" id="quantityInStock" name="quantityInStock" value="0" pattern="[0-9]{1,5}" title="Product Quantity [INTEGER VALUE] in Stock (default =0)">';
      
    //end of form element tags
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" name="btnUpdateProduct" value="TRUE">Update Product</button>';
    $form.='<button type="submit" class="btn btn-default" name="btnClearForm" value="TRUE">Cancel Update</button>';
    $form.='</form>';        

    
    return $form;
}

/**
 * Generates a HTML user select form 
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form. 
 * @return string String containing the generated form.
 */    
public static function form_select_user($pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="userID">User ID (email)</label><input required type="text" class="form-control" id="userID" name="userID" >';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnUserSelect">Select</button>';
        $form.='</form>';
        return $form;
}    
    
    
    
/**
 * Generates a HTML login form 
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form. 
 * @return string String containing the generated form.
 */    
public static function form_login($pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="userID">ID (email)</label><input required type="text" class="form-control" id="userID" name="userID" >';
        $form.='<label for="password">Password</label><input required type="password" class="form-control" id="password" name="password" >';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnLogin">Login</button>';
        $form.='</form>';
        return $form;
}  

/**
 * Generates a HTML form for adding a new product.  
 * 
 * The form generated will display a drop down list/chooser of product categories
 * 
 * @param ProductCategoriesTable $productCategoriesTable A county table entity object.
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_add_product($productCategoriesTable, $pageID){

    //prepare an array of product categories for the drop down list
    $productCategoriesList=array();
    if($rs=$productCategoriesTable->select_all()){
        while ($row = $rs->fetch_assoc()){
            $productCategoriesList[$row['ProductCategoriesID']]=$row['ProductCategoriesDescription'];   //build an array of county names $countyList
        }
    } 
    
    //construct the form
    $form='<form method="post" action="index.php?pageID='.$pageID.'">';
    $form.='<div class="form-group">';
    
    //form input fields for product code and description
    $form.='<label for="productCode">Product Code</label><input required type="text" class="form-control" id="productCode" name="productCode" pattern="[a-zA-Z0-9\-]{1,11}" title="Alphanumeric Product Code with dashes eg 99999999-X">';
    $form.='<label for="productDescription">Product Description</label><input required type="text" class="form-control" id="productDescription" name="productDescription" pattern="[a-zA-Z0-9óáéí\' ()\- ]{1,45}" title="Product Description">';

    //form input drop down list (Select) for categories
    $form.='<label for="productCategoriesID">Product Category (default category : UNCLASSIFIED)</label>';
    $form.='<select class="form-control" id="productCategoriesID" name="productCategoriesID">';
          $form.= '<option value="1" selected>Select a Product Category</option>';
      foreach($productCategoriesList as $key=>$value){
          $form.= '<option value="'.$key.'">'.$value.'</option>';  
      }
    $form.='</select>';
    
    //form input fields for product selling price, purchase price and quantity in stock
    $form.='<label for="productSellPrice">Product Retail Selling Price</label><input required type="text" class="form-control" id="productSellPrice" name="productSellPrice" pattern="^(\d{1,5}|\d{0,5}\.\d{1,2})$" title="Product Sell Price - [2 Places Decimal]">';
    $form.='<label for="productPurchasePrice">Product Purchase Price</label><input required type="text" class="form-control" id="productPurchasePrice" name="productPurchasePrice" pattern="^(\d{1,5}|\d{0,5}\.\d{1,2})$" title="Product Purchase Price - [2 places Decimal]">';
    $form.='<label for="quantityInStock">Quantity In Stock [Default 0]</label><input required type="text" class="form-control" id="quantityInStock" name="quantityInStock" value="0" pattern="[0-9]{1,5}" title="Product Quantity [INTEGER VALUE] in Stock (default =0)">';
      
    //end of form element tags
    $form.='</div> ';
    $form.='<button type="submit" class="btn btn-default" name="btnAddProduct" value="TRUE">Add Product</button>';
    $form.='<button type="submit" class="btn btn-default" name="btnClearForm" value="TRUE">Cancel/Clear Form</button>';
    $form.='</form>';
    
    //return the form as a string
    return $form;
}


/**
 * Generates a HTML password change form
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_password_change($pageID){
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="pass1">Enter New Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
        $form.='<label for="pass2">Re-enter New Password</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
        $form.='<label for="password">Enter OLD Password</label><input required type="password" class="form-control" id="password" name="password" >';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnChangePW">Change Password</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnCancelUpdatePW" value="updatePWCancel">Cancel</button>';
        $form.='</form>';
        return $form;
} 

/**
 * 
 * Generates a HTML form for editing account details. 
 * 
 * The form generated will display but does not permit editing of the users ID.  
 * 
 * @param CountyTable $countyTable A county table entity object.
 * @param mysqli_result $userRecord Resultset containing the current user details from the database  user table 
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_edit_account($countyTable,$userRecord, $pageID){
        $countyList=array();
        $i=1;  //array index
        if($rs=$countyTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $countyList[$row['idcounty']]=$row['countyName'];   //build an array of county names $countyList
                $i++;
            }
        } 
        
        $userRecordArray=$userRecord->fetch_assoc();
        extract($userRecordArray); //makes constructing the form a little easier
        
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
       
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control"  value="'.$FirstName.'" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control"   value="'.$LastName.'" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';
        $form.='<label for="idCounty">county</label>';
        $form.='<select class="form-control" id="idCounty" name="idCounty">';
          $form.= '<option value="'.$idcounty.'">'.$countyList[$idcounty].'</option>'; //the displayed value should be the current value in database
          foreach($countyList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  //drop down list of all counties
          }
        $form.='</select>';
        
        //hidden DEFAULT input values for user type and login enabled
        $form.= '<input type="hidden" id="userTypeNr" name="userTypeNr" value="'.$userTypeNr.'">'; //default user type is customer
        $form.= '<input type="hidden" id="userEnabled" name="userEnabled" value="1">'; //default enabled to login is true        
        
        $form.='<label for="email">email (not editable)</label><input required readonly type="text" class="form-control" value="'.$email.'" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="mobile">mobile</label><input type="text" class="form-control" value="'.$mobile.'" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';

        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnUpdateAccount" value="update">Update</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnCancelUpdateAccount" value="update">Cancel Update</button>';
        $form.='</form>';
        
        return $form;
    }


/**
 * 
 * Generates a HTML form for editing account details. 
 * 
 * The form generated will display but does not permit editing of the users ID.  
 * 
 * @param CountyTable $countyTable A county table entity object.
 * @param UserTypeTable $userTypeTable A county table entity object.
 * @param mysqli_result $userRecord Resultset containing the current user details from the database  user table 
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_administrator_edit_account($countyTable,$userTypeTable,$userRecord, $pageID){
    
    
        $countyList=array();
        $i=1;  //array index
        if($rs=$countyTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $countyList[$row['idcounty']]=$row['countyName'];   //build an array of county names $countyList
                $i++;
            }
        } 
        
        $userTypeList=array();
        if($rs=$userTypeTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $userTypeList[$row['userTypeNr']]=$row['userTypeDescr'];   //build an array of county names $countyList
            }
        } 
        
        
        $userRecordArray=$userRecord->fetch_assoc();
        extract($userRecordArray); 
        
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="userID">User ID (not editable)</label><input required readonly type="text" class="form-control"   value="'.$userID.'" id="userID" name="userID" >';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control"  value="'.$FirstName.'" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control"   value="'.$LastName.'" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        $form.='<label for="idCounty">County</label>';
        $form.='<select class="form-control" id="idCounty" name="idCounty">';
          $form.= '<option value="'.$idcounty.'">'.$countyList[$idcounty].'</option>'; //the displayed value should be the current value in database
          foreach($countyList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  //drop down list of all counties
          }
        $form.='</select>';


        $form.='<label for="userTypeNr">Select Usertype</label>';
        $form.='<select class="form-control" id="userTypeNr" name="userTypeNr">';
              $form.= '<option value="'.$userTypeNr.'" selected>'.$userTypeDescr.'</option>';
          foreach($userTypeList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  
          }
        $form.='</select>';


        $form.='<label for="userEnabled">Enable/Disable User Access</label>';
        $form.='<select class="form-control" id="userEnabled" name="userEnabled">';
              if($userEnabled){
                  $form.= '<option value="1">LOGIN ENABLED</option>';  
                  $form.= '<option value="0">DISABLE LOGIN</option>'; 
              }
              else{
                  $form.= '<option value="0">LOGIN NOT ENABLED</option>';  
                  $form.= '<option value="1">ENABLE LOGIN</option>'; 
              }
        $form.='</select>';
        

        $form.='<label for="email">email (not editable)</label><input required readonly type="text" class="form-control" value="'.$email.'" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="mobile">mobile</label><input type="text" class="form-control" value="'.$mobile.'" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';

        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnUpdateAccount" value="update">Update</button>';
        $form.='<button type="submit" class="btn btn-default" name="btnCancelUpdateAccount" value="update">Cancel Update</button>';
        $form.='</form>';
        
        return $form;
    }

    
    
/**
 * Generates a HTML form for registering a new  account.  It is intended for administrator use
 * 
 * The form generated will display a drop down list/chooser of counties and user types.  
 * 
 * @param CountyTable $countyTable A county table entity object.
 * @param UserTypeTable $userTypeTable A county table entity object.
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_register($countyTable,$userTypeTable, $pageID){
        $countyList=array();
        if($rs=$countyTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $countyList[$row['idcounty']]=$row['countyName'];   //build an array of county names $countyList
            }
        } 
        
        $userTypeList=array();
        if($rs=$userTypeTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $userTypeList[$row['userTypeNr']]=$row['userTypeDescr'];   //build an array of county names $countyList
            }
        } 
        
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        $form.='<label for="idCounty">County (select your county)</label>';
        $form.='<select class="form-control" id="idCounty" name="idCounty">';
              $form.= '<option value="99" selected>Select a County</option>';
          foreach($countyList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  
          }
        $form.='</select>';

        $form.='<label for="userTypeNr">Select Usertype</label>';
        $form.='<select class="form-control" id="userTypeNr" name="userTypeNr">';
              $form.= '<option value="99" selected>Select a User Type</option>';
          foreach($userTypeList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  
          }
        $form.='</select>';

        $form.='<label for="userEnabled">Enable/Disable User Access</label>';
        $form.='<select class="form-control" id="userEnabled" name="userEnabled">';
                  $form.= '<option value="1" selected>LOGIN ENABLED(DEFAULT)</option>';  
                  $form.= '<option value="0">LOGIN NOT ENABLED </option>';  
                  $form.= '<option value="1">ENABLE LOGIN</option>'; 
        $form.='</select>';

        $form.='<label for="email">email (this will be your user ID) </label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="mobile">mobile</label><input type="text" class="form-control" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';
        $form.='<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
        $form.='<label for="pass2">Re-enterPassword</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnRegister" value="registerUser">Register</button>';
        $form.='</form>';
        
        return $form;
    }
    

  
/**
 * Generates a HTML form for registering a new  account.  It is intended for CUSTOMER use
 * 
 * The form generated will display a drop down list/chooser of counties and user types.  
 * 
 * @param CountyTable $countyTable A county table entity object.
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */
public static function form_register_customer($countyTable,$pageID){
        $countyList=array();
        if($rs=$countyTable->getAllRecords()){
            while ($row = $rs->fetch_assoc()){
                $countyList[$row['idcounty']]=$row['countyName'];   //build an array of county names $countyList
            }
        } 
        

        
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<div class="form-group">';
        $form.='<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
        $form.='<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';

        $form.='<label for="idCounty">County (select your county)</label>';
        $form.='<select class="form-control" id="idCounty" name="idCounty">';
              $form.= '<option value="99" selected>Select a County</option>';
          foreach($countyList as $key=>$value){
              $form.= '<option value="'.$key.'">'.$value.'</option>';  
          }
        $form.='</select>';

        //hidden DEFAULT input values for user type and login enabled
        $form.= '<input type="hidden" id="userTypeNr" name="userTypeNr" value="3">'; //default user type is customer
        $form.= '<input type="hidden" id="userEnabled" name="userEnabled" value="1">'; //default enabled to login is true


        $form.='<label for="email">email (this will be your user ID) </label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
        $form.='<label for="mobile">mobile</label><input type="text" class="form-control" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';
        $form.='<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
        $form.='<label for="pass2">Re-enterPassword</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" name="btnRegister" value="registerUser">Register</button>';
        $form.='</form>';
        
        return $form;
    }
        
    
    
/**
 * Generates a HTML form for entering a chat message and optionally specifying a recipient. 
 * 
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form.
 * @return string String containing the generated form.
 */    
public static function form_add_msg($pageID){
        $form='<div class="container-fluid">';
        $form.='<form method="post" action="index.php?pageID='.$pageID.'">';

        $form.='<div class="form-group">';
        
        $form.='<label for="message">Enter a Message</label><textarea class="form-control" id="message" name="message" rows="3" style="resize:vertical"></textarea> ';
                
        $form.='<label for="msgTo">Addressed To (enter ID or leave blank for ALL)</label><input type="text" class="form-control" id="msgTo" name="msgTo" >';
        $form.='</div> ';
        $form.='<button type="submit" class="btn btn-default" value="TRUE" name="btnAddMsg">Submit Message</button>';
        $form.='</form>';
        $form.='</div>';
        return $form;
}      

    
/**
 * Generates a HTML CONFIRM form (Button)
 * 
 * @param string $pageID The pageID of the page which will be used to process the login form. 
 * @param string $choice The value of the chosen variable to be confirmed. 
 * @param string $btnText The text to appear on the form button. 
 * @return string String containing the generated form.
 */    
public static function form_confirm($pageID,$btnText,$choice){
        $form='<form method="post" action="index.php?pageID='.$pageID.'">';
        $form.='<button type="submit" class="btn btn-default" value='.$choice.' name="btnConfirm">'.$btnText.'</button>';
        $form.='<button type="submit" class="btn btn-default" value='.FALSE.' name="btnConfirm">CANCEL</button>';
        $form.='</form>';
        return $form;
}    
   


}
