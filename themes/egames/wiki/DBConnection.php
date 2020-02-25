<?php
class DBConnection
{    
    private $host = WIKIDB_HOST;
    private $port = WIKIDB_PORT;
    private $user = WIKIDB_USER;
    private $pass = WIKIDB_PASS;
    private $dbname = WIKIDB_NAME;
    
    private $dbh;
    private $error = "";

    public function __construct()
    {
        $dsn = "mysql:host=$this->WIKIDB_HOST;dbname=$this->dbname;port=$this->WIKIDB_PORT;charset=utf8;";
        $options = array
        (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch(PDOException $e)
        {
            $this->error = $e->getMessage();
            echo $this->error;
        }
        return $this->error;
    }

    public function getDbh()
    {
        return $this->dbh;
    }
    
    public function __toString()
    {
        return $this->error;
    }

    public function runQuery($sql)
    {
        try
        {
            $count = $this->dbh->exec($sql);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        return $count;
    }

    public function getQuery($sql)
    {
        $stmt = $this->dbh->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;  
    }
}
?>