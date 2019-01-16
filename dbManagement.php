<?php
namespace Management;

use PDO;
use PDOException;

/**
 * Database management class
 * @author Tim
 *        
 */
class dbManagement
{    
    /**
     * function to get dbconnection
     */
    public function dbConnect($file)
    {
        // pull connection info from .ini file
        $db = parse_ini_file($file);
        
        // create variables for the info in that file
        $UserName = $db['UserName'];
        $UserPassword = $db['UserPassword'];
        $ServerHost = $db['ServerHost'];
        $UserPort = $db['UserPort'];
        $UserDatabase = $db['UserDatabase'];
        
        //set DB connection with PDO
        try
        {
            $conn = new PDO("mysql:host=$ServerHost;dbname=$UserDatabase", $UserName, $UserPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection Successful";
            return TRUE;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            return FALSE;
        }        
    }
    
    /**
     * function to close db connection
     */
    public function dbClose()
    {
        $this->connection = null;
    }
    
    /**
     * Process queries such as selects, deletes, inserts
     */
    public function dbQuery($query)
    {
        $result=$this->dbConnect()->setAttribute($query);
        $this->dbClose();
        return $result;
    }
}

