<?php

/**
 * Provides database access and executing queries.
 * @package Database
 **/
class Database extends DatabaseManager
{
    protected $config;
    protected $dbconn;
    protected $dbname;
    protected $data = array();
    
    public function __construct()
    {
        $this->setConfig();
    }
    
    public function setConfig($cfg = 'default')
    {
        $this->config = $this->dbconfig[$cfg];
    }

    /**
     * Connect to the server
     * 
     * @param array $dbconfig            
     *
     */
    public function dbConnect()
    {
        $this->dbconn = mysql_connect(
            $this->config['host'], 
            $this->config['user'], 
            $this->config['password']
        );
        if (empty($this->dbconn)) {
            die(mysql_error());
        }
    }

    /**
     * Close the connection to the server
     */
    public function dbClose()
    {
        mysql_close($this->dbconn);
    }

    /**
     * Set the database to use
     * 
     * @param string $dbname            
     *
     */
    public function setDb($dbname)
    {
        if (! $this->dbconn) {
            echo "Geen database connectie!";
            exit();
        }
        if (! mysql_select_db($dbname)) {
            echo "Kon geen verbinding maken met database: " . $dbname;
            exit();
        }
        $this->dbname = $dbname;
    }

    /**
     * Fetch data from the specified table
     * 
     * @param string $dbtable            
     * @param array $fields
     *            specifies fields to fetch (optional)
     * @param string $condition
     *            specifies rows to fetch (optional, use SQL syntax)
     * @param array $order
     *            specifies order of the returned rows. Array has
     *            2 elements: fieldname and 'ASC' or 'DESC'.
     * @return array $data array of table rows
     *        
     */
    public function fetch($dbtable, array $fields = null, $condition = null, array $order = null)
    {
        mysql_select_db($dbtable);
        if ($fields == null) {
            $query = "SELECT * FROM " . $dbtable;
        } else {
            $fieldlist = implode(",", $fields);
            $query = "SELECT " . $fieldlist . " FROM " . $dbtable;
        }
        if ($condition !== null) {
            $query = $query . " WHERE " . $condition;
        }
        if ($order !== null) {
            $query = $query . " ORDER BY " . $order[0] . " " . $order[1];
        }
        $result = mysql_query($query) or die(mysql_error());
        $counter = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $this->data[$counter] = $row;
            $counter += 1;
        }
        return $this->data;
    }

    /**
     * Insert a new row into the specified table.
     * 
     * @param string $dbtable            
     * @param array $data
     *            The data to insert, like this: array('field' => 'value')
     */
    public function newRow($dbtable, array $data)
    {
        $setstring = getFieldValues($data);
        mysql_select_db($dbtable);
        $query = "INSERT INTO " . $dbtable . " SET " . $setstring;
        $result = mysql_query($query) or die(mysql_error());
    }

    /**
     * Update values of fields in a row
     * 
     * @param string $dbtable            
     * @param array $data
     *            The new field values
     * @param $condition Optional.
     *            Limit the update to specific rows
     */
    public function updateRow($dbtable, array $data, $condition = null)
    {
        $setstring = $this->getFieldValues($data);
        mysql_select_db($dbtable);
        $query = "UPDATE " . $dbtable . " SET " . $setstring;
        if ($condition !== null) {
            $query = $query . " WHERE " . $condition;
        }
        $result = mysql_query($query) or die(mysql_error());
    }

    /**
     * Delete rows from a table
     * 
     * @param string $dbtable            
     * @param string $condition            
     */
    public function deleteRow($dbtable, $condition = null)
    {
        $query = "DELETE FROM " . $dbtable;
        if ($condition !== null) {
            $query = $query . " WHERE " . $condition;
        }
        $result = mysql_query($query) or die(mysql_error());
    }

    /**
     * Execute a custom SQL query on a table
     * 
     * @param string $dbtable            
     * @param string $query
     *            The SQL query to execute.
     */
    public function execQuery($dbtable, $query)
    {
        mysql_select_db($dbtable);
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }

    /**
     *
     * @internal Used by fetchRow and updateRow
     * @ignore
     *
     */
    private function getFieldValues($data)
    {
        $fieldnames = array_keys($data);
        $values = array_values($data);
        for ($i = 0; $i < count($data); $i ++) {
            $setvalue[$i] = $fieldnames[$i] . "=" . "'" . $values[$i] . "'";
        }
        $setstring = implode(",", $setvalue);
        return $setstring;
    }
}
