<?php

/**
 * This file contains the CountyTable Class
 * 
 */

/**
 * 
 * ChatMsgTable entity class implements the table entity class for the 'CountyTable' table in the database. 
 * 
 * @author Gerry Guinane
 * 
 */

class MatchTable extends TableEntity
{

    /**
     *
     * 
     * @param MySQLi  
     */
    function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection, 'county');
    }





    public function CreateMatch($team1, $team2, $dateAndTime, $Result)
    {


        $this->SQL = "INSERT INTO `matches`
                        (
                        `team1_id`,
                        `team2_id`,
                        `scheduled_date`,
                        `result`)
                        VALUES
                        (
                        " . $team1 . ",
                        " . $team2 . ",
                        '" . $dateAndTime . "',
                        '" . $Result . "'
                             );
                        ";

        try {
            $rs = $this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) {
            $this->MySQLiErrorNr = $e->getCode();
            $this->MySQLiErrorMsg = $e->getMessage();
            $rs = FALSE;
            return false;
        }
        return true;
    }
    public function ReadMatch()
    {
        $this->SQL = "SELECT 
        m.match_id AS 'Id',
        m.scheduled_date AS 'Date',
        m.result as 'Result',
        t1.team_name AS 'Team 1',
        t2.team_name AS 'Team 2'
    FROM 
        matches m
    JOIN 
        teams t1 ON m.team1_id = t1.team_id
    JOIN 
        teams t2 ON m.team2_id = t2.team_id;
    ";

        return $this->db->query($this->SQL);
    }

    public function UpdateMatch($UpdateID, $t1, $t2, $d)
    {


        $this->SQL = "UPDATE `k00283736_framework_16`.`matches`
                    SET
                    `team1_id` = " . $t1 . ",
                    `team2_id` = " . $t2 . ",
                    `scheduled_date` = '" . $d . "'
                    WHERE `match_id` = " . $UpdateID . ";
                    ";


        try {
            $rs = $this->db->query($this->SQL);
            return $rs;
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $this->MySQLiErrorNr = $e->getCode();
            $this->MySQLiErrorMsg = $e->getMessage();
            $rs = FALSE;
            return false;
        }
    }

    public function DeleteMatch($DeleteID)
    {


        $this->SQL = "DELETE FROM `k00283736_framework_16`.`teams`
    WHERE `team_id` = '" . $DeleteID . "'";

        try {
            $rs = $this->db->query($this->SQL);
            return $rs;
        } catch (mysqli_sql_exception $e) {
            $this->MySQLiErrorNr = $e->getCode();
            $this->MySQLiErrorMsg = $e->getMessage();
            $rs = FALSE;
            return false;
        }
    }


    /**
     * Returns a partial record (countyName only by ID)
     * 
     * @param string $matchId
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */
    public function getRecordByID($matchId)
    {
        $sql = "SELECT * FROM matches WHERE match_id=$matchId;";

        $rs = $this->db->query($sql);
        if ($rs) {
            $one =  $rs->fetch_assoc();
            return $one;
        } else {
            return null; // or handle the error as needed
        }
    }

    public function getTeamById($teamId)
    {
        $sql = "SELECT * FROM teams where team_id=$teamId;";
        return $this->db->query($sql);

        $rs = $this->db->query($sql);
        if ($rs) {
            $one =  $rs->fetch_assoc();
            return $one["team_name"];
        } else {
            return null; // or handle the error as needed
        }
    }






    /**
     * Performs a DELETE query for a single record ($idcounty).  Verifies the
     * record exists before attempting to delete
     * 
     * @param $idcounty  String containing ID of county record to be deleted
     * 
     * @return boolean Returns FALSE on failure. For successful DELETE returns TRUE
     */
    public function deleteRecordbyID($idcounty)
    {

        if ($this->getRecordByID($idcounty)) { //confirm the record exists before deletig

            $this->SQL = "DELETE FROM county WHERE ID='$idcounty'"; //construct the SQL

            //execute the  query
            try {
                $rs = $this->db->query($this->SQL);
            } catch (mysqli_sql_exception $e) { //catch the exception 
                $this->MySQLiErrorNr = $e->getCode();
                $this->MySQLiErrorMsg = $e->getMessage();
                $rs = FALSE;
            }
        } else {
            return false;  //invalid ID
        }
    }



    /**
     * Performs a SELECT query to returns all records from the table. 
     * idcounty,countyName columns only.
     *
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */
    public function getAllRecords()
    {

        $this->SQL = 'SELECT idcounty,countyName FROM county';  //construct the SQL

        //execute the  query
        try {
            $rs = $this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $this->MySQLiErrorNr = $e->getCode();
            $this->MySQLiErrorMsg = $e->getMessage();
            $rs = FALSE;
        }



        if ($rs->num_rows) {
            return $rs;
        } else {
            return false;
        }
    }



    /**
     * Inserts a new record in the table. 
     * 
     * @param array $postArray containing data to be inserted
     * $postArray['county'] string County Name
     * 
     * @return boolean
     * 
     * 
     */
    public function addRecord($postArray)
    {

        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);

        //add escape to special characters
        $countyName = addslashes($county);


        //construct the INSERT SQL
        $this->SQL = "INSERT INTO county (countyName) VALUES ('$countyName')";


        //execute the  query
        try {
            $rs = $this->db->query($this->SQL);
        } catch (mysqli_sql_exception $e) { //catch the exception 
            $this->MySQLiErrorNr = $e->getCode();
            $this->MySQLiErrorMsg = $e->getMessage();
            $rs = FALSE;
        }


        //check the insert query worked
        if ($rs) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
