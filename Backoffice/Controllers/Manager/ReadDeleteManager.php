<?php
namespace Controllers\Manager;
use PDO;

class ReadDeleteManager
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

    public function read($column)
    {
        $column = $this->setColumn($column);
        $this->query=  $this->pdo->prepare('SELECT ' . $this->getColumn() . ' from ' . $this->getTable());
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
}