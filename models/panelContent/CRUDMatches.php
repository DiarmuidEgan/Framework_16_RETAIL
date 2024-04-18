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



class CRUDMatch extends PanelModel
{


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
    function __construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID)
    {
        $this->modelType = 'AccountAdminCustomer';
        parent::__construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID);
    }


    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1()
    {

        switch ($this->pageID) {
            case "createMatch":
                $this->panelHead_1 = "<h3>Make a match</h3>";
                break;
            case "viewMatch":
                $this->panelHead_1 = "<h3>View all matches</h3>";
                break;
            case "deleteMatch":
                $this->panelHead_1 = "<h3>Delete a match</h3>";
                break;
            case "updateMatch":
                $this->panelHead_1 = "<h3>Update a match</h3>";
                break;
        }
    }


    public function viewMatches()
    {
        $matchTable = new MatchTable($this->db);
        $rs = $matchTable->ReadMatch();
        $this->panelContent_1 = HelperHTML::generateTABLE($rs);
    }

    function getSelectInput($resultsSet, $selectName, $selectedValue)
    {
        $select = "<select name='$selectName' class='form-control'>";
        while ($row = $resultsSet->fetch_assoc()) {
            $value = $row["team_id"];
            $text = $row["team_name"];
            $select .= "<option value='$value'";
            if ($value == $selectedValue) {
                $select .= " selected";
            }
            $select .= ">$text</option>";
        }
        $select .= "</select>";
        return $select;
    }
    public function getTeams()
    {
        $sql="SELECT * FROM teams;";
        return $this->db->query($sql);

    }
    
    public function createMatch()
    {
        $teamsRs1 =$this->getTeams();
        $selectTeam1=$this->getSelectInput($teamsRs1, "match-team1", "");
        $teamsRs2 =$this->getTeams();
        $selectTeam2=$this->getSelectInput($teamsRs2, "match-team2", "");

        $this->panelContent_1 = Form::form_select_match($this->pageID, $selectTeam1, $selectTeam2);
        
    }

    /**
     * Set the Panel 1 text content 
     */
    public function setPanelContent_1()
    {
        switch ($this->pageID) {
            case "createMatch":
                $this->createMatch();
                 break;

            case "viewMatch":
                $this->viewMatches();
                break;

            case "deleteMatch":
                $this->panelContent_1 = Form::form_select_id($this->pageID);
                break;

            case "updateMatch":
                $this->panelContent_1 = Form::form_update_match($this->pageID);
                $this->panelContent_2 = "<h1>new match</h1>";
                break;
        }
    }

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2()
    {
        switch ($this->pageID) {
            case "createMatch":
                $this->panelHead_2 .= "<h3>Result</h3>";
                break;
        }
    }

    /**
     * Set the Panel 2 text content 
     */
    public function setPanelContent_2()
    {
        switch ($this->pageID) {

            case "createMatch":
                if (isset($_POST["match-team1"])) {
                    $matchTable = new MatchTable($this->db);
                    if ($matchTable->CreateMatch($_POST["match-team1"], $_POST["match-team2"], $_POST["match-date"], $_POST["match-result"])) {
                        $this->panelContent_2 = "<p>New entry added</p>";
                    } else {
                        $this->panelContent_2 = "<p>That didnt work ...</p>";
                    }
                }
                break;


            case "updateMatch":
                if (isset($_POST["m_code"])) {
                    $matchTable = new MatchTable($this->db);
                    if ($matchTable->UpdateMatch($_POST["m_code"], $_POST["t1_code"], $_POST["t2_code"], $_POST["date_code"])) {
                        $this->panelContent_2 = "<p>New entry added</p>";
                    } else {
                        $this->panelContent_2 = "<p>That didnt work ...</p>";
                    }
                }
                break;
        }
    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3()
    {
    }

    /**
     * Set the Panel 3 text content 
     */
    public function setPanelContent_3()
    {
    }
}
