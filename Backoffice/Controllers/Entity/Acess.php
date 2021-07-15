<?php
namespace Controllers\Entity;

class Acess
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * acess
     *
     * @var string
     */
    private $acess;

    /**
     * dbHost
     *
     * @var string
     */
    private $dbHost;

    /**
     * dbUser
     *
     * @var string
     */
    private $dbUser;

    /**
     * dbPass
     *
     * @var string
     */
    private $dbPass;

    /**
     * dbPort
     *
     * @var int
     */
    private $dbPort;

    /**
     * dataName
     *
     * @var string
     */
    private $dataName;

    /**
     * secure
     *
     * @var string
     */
    private $secure;
    
    /**
     * auth
     *
     * @var string
     */
    private $auth;

    /**
     * setId
     *
     * @param  int
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getId
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * setAcess
     *
     * @param  string $acess
     * @return void
     */
    public function setAcess($acess)
    {
        $this->acess = $acess;
    }
    
    /**
     * getAcess
     *
     * @return string
     */
    public function getAcess()
    {
        return $this->acess;
    }
    
    /**
     * setDbHost
     *
     * @param  string $dbHost
     * @return void
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }
    
    /**
     * getDbHost
     *
     * @return string
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }
    
    /**
     * setDbUser
     *
     * @param  string $dbUser
     * @return void
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }
    
    /**
     * getDbUser
     *
     * @return string
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }
    
    /**
     * setDbPass
     *
     * @param  string $dbPass
     * @return void
     */
    public function setDbPass($dbPass)
    {
        $this->dbPass = $dbPass;
    }
    
    /**
     * getDbPass
     *
     * @return string
     */
    public function getDbPass()
    {
        return $this->dbPass;
    }
    
    /**
     * setDbPort
     *
     * @param int $dbPort
     * @return void
     */
    public function setDbPort($dbPort)
    {
        $this->dbPort = $dbPort;
    }
    
    /**
     * getDbPort
     *
     * @return int
     */
    public function getDbPort()
    {
        return $this->dbPort;
    }
    
    /**
     * setDataName
     *
     * @param  string $dataName
     * @return void
     */
    public function setDataName($dataName)
    {
        $this->dataName = $dataName;
    }
    
    /**
     * getDataName
     *
     * @return string
     */
    public function getDataName()
    {
        return $this->dataName;
    }

     /**
     * setAuth
     *
     * @param  string $auth
     * @return void
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
    
    /**
     * getAuth
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    } 
      
    /**
     * setSecure
     *
     * @param  string $secure
     * @return void
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }
    
    /**
     * getSecure
     *
     * @return string
     */
    public function getSecure()
    {
        return $this->secure;
    }
               
}