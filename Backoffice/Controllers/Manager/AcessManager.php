<?php
namespace Controllers\Manager;

use Controllers\Entity\Acess;
use PDO;

class AcessManager
{
    /**
     * pdo
     *
     * @var object
     */
    private $pdo;
    
    /**
     * query
     *
     * @var mixed
     */
    private $query;    
    
    /**
     * table
     *
     * @var string
     */
    private $table;

    /**
     * column
     *
     * @var string
     */
    private $column;
      
    public function __construct($table)
    {
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=leceperecords', "root", "");
            $this->pdo->exec('SET NAMES UTF8');
            $this->pdo->exec("SET lc_time_names = 'fr_FR'");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            die("Impossible de se connecter : " . $e->getMessage());
        }

        $this->setTable($table);
    }

    /**
     * setTable
     *
     * @param  string $table
     * @return void
     */
    public function setTable($table)
    {
        $this->table= $table;
    }
    
    /**
     * getTable
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

     /**
     * setColumn
     *
     * @param  string $column
     * @return void
     */
    public function setColumn($column)
    {
        $this->column= $column;
    }

    /**
     * getColumn
     *
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    public function readAll()
    {
        $this->query=  $this->pdo->prepare('SELECT * from ' . $this->getTable());
        $this->query->execute();
        return  $this->query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function readById($column, $id)
    {
        $column = $this->setColumn($column);
        
        $this->query=  $this->pdo->prepare('SELECT '. $this->getColumn() . ' from ' .$this->getTable() . ' WHERE id = :id');
        
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        
        $this->query->execute();

        return  $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById()
    {
        $this->query=  $this->pdo->prepare('DELETE from ' .$this->getTable() . ' WHERE id = :id');
       
        $this->query->bindValue(':id',$_GET["id"], PDO::PARAM_INT);
        
        $this->query->execute();
    }

    public function create(Acess &$entity)
    {
        $this->query = $this->pdo->prepare('INSERT INTO ' .$this->getTable() . ' (Acess,DB_Host, DB_User, DB_Pass, DB_Port, DataName, Auth, Secure) 
        Values (:Acess,:DB_Host,:DB_User,:DB_Pass,:DB_Port,:DataName,:Auth,:Secure)');
        
        $this->query->bindValue(':Acess',$entity->getAcess(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Host',$entity->getDbHost(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_User',$entity->getDbUser(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Pass',$entity->getDbPass(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Port',$entity->getDbPort(), PDO::PARAM_INT);
        $this->query->bindValue(':DataName',$entity->getDataName(), PDO::PARAM_STR);
        $this->query->bindValue(':Auth',$entity->getAuth(), PDO::PARAM_STR);
        $this->query->bindValue(':Secure',$entity->getSecure(), PDO::PARAM_STR);

        $this->query->execute();
    }

    public function update(Acess &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET Acess = :Acess, DB_Host = :DB_Host, DB_User = :DB_User, 
        DB_Pass = :DB_Pass, DB_Port = :DB_Port, DataName = :DataName, Auth = :Auth, Secure = :Secure WHERE id = :id');

        $this->query->bindValue(':Acess',$entity->getAcess(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Host',$entity->getDbHost(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_User',$entity->getDbUser(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Pass',$entity->getDbPass(), PDO::PARAM_STR);
        $this->query->bindValue(':DB_Port',$entity->getDbPort(), PDO::PARAM_INT);
        $this->query->bindValue(':DataName',$entity->getDataName(), PDO::PARAM_STR);
        $this->query->bindValue(':Auth',$entity->getAuth(), PDO::PARAM_STR);
        $this->query->bindValue(':Secure',$entity->getSecure(), PDO::PARAM_STR);
        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);                                        
        
        $this->query->execute();
    }
}