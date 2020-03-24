<?php

/**
 * Для работы с базой данной
 */

namespace repository;

class Repository {
    
    /**
     * @var string
     */
    private $host;
    
    /**
     * @var string 
     */
    private $dbname;
    
    /**
     * @var string
     */
    private $dbuser;
    
    /**
     * @var string
     */
    private $password;
    
    /**
     * @param stirng $host
     * @param stirng $dbname
     * @param stirng $dbuser
     * @param stirng $password
     */
    public function __construct($host, $dbname, $dbuser, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->password = $password;
    }
    
    /**
     * @return array 
     */
    public function getSubscribtions() {
        return [
            []
        ];
    }

}