<?php
/**
* This file contains the NavigationManager Class
* 
*/

/**
 * 
 * NavigationManager class is a model class that implements the content generation for the
 * page navigation bar for a logged in ADMIN user.  
 * 
 * @author Gerry Guinane
 * 
 */

class NavigationManager implements NavigationInterface {
    
        /**
         *
         * @var boolean $loggedin User logged in state 
         */
        protected $loggedin; 

        /**
         *
         * @var String $modelType Identifues this navigation model type  
         */
        protected $modelType; 

        /**
         *
         * @var String $pageID The currently selected page
         */
        protected $pageID;   

        /**
         *
         * @var array $menuNav An array of menu items  
         */
        protected $menuNav;    

        /**
         *
         * @var User $user  The current user object. 
         */
        protected $user;     

        
	/**
         * Class constructor. 
         * 
         * @param User $user The current user object.
         * @param string $pageID The currently selected page
         */
	function __construct($user,$pageID) {               
            $this->loggedin=$user->getLoggedInState();
            $this->modelType='NavigationManager';
            $this->user=$user;
            $this->pageID=$pageID;
            $this->setmenuNav();
	}

      
        /**
         * Method to prepare the navigation menu depending on the currently selected page ID. 
         * 
         * This method implements handlers for each page ID.  It prepares a HTML list item string
         * containing the menu items that will appear in the view. This string may be returned using the 
         * getMenuNav() method of this class.
         * 
         * If a user is not properly logged in it force redirects to the website home page. 
         * 
         */
        public function setmenuNav(){//set the menu items depending on the users selected page ID
            
            //empty string for menu items
            $this->menuNav='';

            //dropdown menu items for MANAGE PRODUCTS
            $dropdownMenuManageProducts='<li class="dropdown">';
            $dropdownMenuManageProducts.='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Team Managment<span class="caret"></span></a>';
            $dropdownMenuManageProducts.='<ul class="dropdown-menu">';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=createTeam">Create Team</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=updateTeam">Update Team</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewTeam">View Team</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=deleteTeam">Delete Team</a></li>';

            $dropdownMenuManageProducts.='</ul></li>';

            
            $dropdownMenuManageProducts.='<li class="dropdown">';
            $dropdownMenuManageProducts.='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Match Managment<span class="caret"></span></a>';
            $dropdownMenuManageProducts.='<ul class="dropdown-menu">';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=createMatch">Create Match</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=updateMatch">Update Match</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewMatch">View Match</a></li>';
            $dropdownMenuManageProducts.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=deleteMatch">Delete Match</a></li>';

            $dropdownMenuManageProducts.='</ul></li>';


            if($this->loggedin){ 
                $this->menuNav.=$dropdownMenuManageProducts;  //the MANAGE PRODUCTS drop down menu
                // $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myAccount">My Account</a></li>';
                $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                /*
                //handlers for logged in user
                switch ($this->pageID) {
                    //home menu navigation
                    case "home":
                        $this->menuNav.=$dropdownMenuManageProducts;  //the MANAGE PRODUCTS drop down menu
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myAccount">My Account</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                     
                        break;

                    //example of under construction menu item
                    case "menuitem1":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myAccount">My Account</a></li>';
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=menuitem1">Menu Item 1</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;

                    case "manageProducts":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts">View Products</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editProduct">Edit Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addProduct">Add Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;

                    case "addProduct":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts">View Products</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editProduct">Edit Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                        
                    case "editProduct":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts">View Products</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addProduct">Add Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;

                    case "viewProducts":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editProduct">Edit Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addProduct">Add Product</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;                    
                    //my account navigation
                    case "myAccount":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editAccount">Edit Details</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=changePassword">Password Change</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    case "editAccount":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editAccount">Edit Details</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=changePassword">Password Change</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    case "changePassword":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=editAccount">Edit Details</a></li>';
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=changePassword">Password Change</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    
                    
                    default:
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=myAccount">My Account</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';
                        break;
                    }//end switch  
                    
                    */
            }
            else{
                //redirect to main index.php page
                header("Location:". $_SERVER['PHP_SELF']);
            }        
        } 

        /**
         * Getter to return the HTML menu string. 
         * 
         * @return string Containing  a HTML list item string containing the menu items that will appear in the view.
         */
        public function getMenuNav(){return $this->menuNav;}    

        /**
         * Dumps diagnostic information in HTML format relating to the class properties
         */
        public function getDiagnosticInfo(){

            echo '<!-- NAVIGATION MANAGER CLASS PROPERTY SECTION  -->';
                echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV
                    
                    echo '<h3>NAVIGATION MANAGER (CLASS) properties</h3>';
                    echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
                    echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';                        
                    echo "<tr><td>pageID</td>   <td>$this->pageID</td></tr>";
                    echo "<tr><td>menuNav</td>  <td>$this->menuNav      </td></tr>";
                    echo '</table>';
                    echo '<p><hr>';
                echo '</div>';            
            echo '<!-- END NAVIGATION CLASS PROPERTY SECTION  -->';
            
 }      

 
}
        