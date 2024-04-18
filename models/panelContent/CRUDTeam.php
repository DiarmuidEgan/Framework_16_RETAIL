<?php
/**
* This file contains the AccountAdminCustomer Class
* 
*/


/**
 * AccountAdminCustomer is an extended PanelModel Class
 * 
 * 
 * The purpose of this class is to generate HTML view panel headings and template content
 * for a <em><b>CUSTOMER user account administration</b></em>  page.  The content generated is intended for 3 panel
 * view layouts. 
 *
 * @author gerry.guinane
 * 
 */



class CRUDTeam extends PanelModel {
    

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
    */ 
    function __construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID){  
        $this->modelType='AccountAdminCustomer';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 


    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        
        switch($this->pageID)
        {
            case "createTeam":
                $this->panelHead_1 = "<h3>Make a team</h3>";
                break;
            case "viewTeam":
                $this->panelHead_1 = "<h3>View all teams</h3>";
                break;
            case "deleteTeam":
                $this->panelHead_1 = "<h3>Delete ateams</h3>";
                break;
            case "updateTeam":
                $this->panelHead_1 = "<h3>Update ateams</h3>";
                break;        
        }
    }
    
     /**
     * Set the Panel 1 text content 
     */   
    public function setPanelContent_1(){
        switch($this->pageID)
        {
            case "createTeam":
                $this->panelContent_1 = Form::form_select_team($this->pageID);
                break;
            case "viewTeam":

                $teamTable = new TeamTable($this->db);
                $rs = $teamTable->ReadTeam();
                $this->panelContent_1 = HelperHTML::generateTABLE($rs);
                break;
            case "deleteTeam":
                $this->panelContent_1 = Form::form_select_id($this->pageID);
                break;
            case "updateTeam":
                $this->panelContent_1 = Form::form_update_id($this->pageID);
                break;  

        } 
    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        switch($this->pageID)
        {
            case "createTeam":
                $this->panelHead_2 = "<h3>Result</h3>";
                break;
            
        } 
    }  
    
     /**
     * Set the Panel 2 text content 
     */   
    public function setPanelContent_2(){
        switch($this->pageID)
        {
            case "createTeam":
                if(isset($_POST["t_code"]))
                {
                    $teamTable = new TeamTable($this->db);
                    if($teamTable->CreateTeam($_POST["t_code"]))
                    {
                        $this->panelContent_2 = "<p>New entry added</p>";

                    }
                    else{
                        $this->panelContent_2 = "<p>That didnt work ...</p>";

                    }
                }
                break;
                
                
                
            case "deleteTeam":
                if(isset($_POST["t_code"]))
                {
                    $teamTable = new TeamTable($this->db);
                    if($teamTable->DeleteTeam($_POST["t_code"]))
                    {
                        $this->panelContent_2 = "<p>Entry deleted</p>";

                    }
                    else{
                        $this->panelContent_2 = "<p>That didnt work ...</p>";

                    }
                }
                break;

            case "updateTeam":
                if(isset($_POST["t_code"]))
                {
                    $teamTable = new TeamTable($this->db);
                    if($teamTable->UpdateTeam($_POST["t_code"], $_POST["t_content"]))
                    {
                        $this->panelContent_2 = "<p>Entry updated</p>";

                    }
                    else{
                        $this->panelContent_2 = "<p>That didnt work ...</p>";

                    }
                }
                break;
          
            
        }  
    } 

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){      
    }
    
     /**
     * Set the Panel 3 text content 
     */   
    public function setPanelContent_3(){      
    }        


        
}
        