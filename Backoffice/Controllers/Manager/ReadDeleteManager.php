<?php
namespace Controllers\Manager;
use PDO;
require_once "ConnectDb.php";

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
        $this->pdo = new ConnectDb ();
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

        $this->query=  $this->pdo->prep('SELECT ' . $this->getColumn() . ' from ' . $this->getTable());

        $this->query->execute();

        return  $this->query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function readById($column, $id)
    {
        $column = $this->setColumn($column);
        
        $this->query=  $this->pdo->prep('SELECT '. $this->getColumn() . ' from ' .$this->getTable() . ' WHERE id = :id');
        
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        
        $this->query->execute();

        return  $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function readInnerJoin($column)
    {
        $column = $this->setColumn($column);
       
        $this->query=  $this->pdo->prep('SELECT ' . $this->getColumn() . ' from ' . $this->getTable(). ' INNER JOIN bands ON products.id_band = bands.id');
        
        $this->query->execute();
       
      
        return  $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readInnerJoinId($column, $id)
    {
        $column = $this->setColumn($column);
        $this->query=  $this->pdo->prep('SELECT ' . $this->getColumn() . ' from ' . $this->getTable(). ' INNER JOIN bands WHERE products.id_band = :id');
        
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);

        $this->query->execute();
       
      //SELECT *, bands.name FROM `products`INNER JOIN bands ON products.id_band = bands.id WHERE id_band = 19 
        return  $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function readInnerJoinWhereBandId($column, $idBand)
    {
        $column = $this->setColumn($column);
        $this->query=  $this->pdo->prep('SELECT ' . $this->getColumn() . ' from ' . $this->getTable(). ' INNER JOIN bands ON products.id_band = bands.id WHERE id_band = :idBand');
        
        $this->query->bindValue(':idBand',$idBand, PDO::PARAM_INT);

        $this->query->execute();
       
      //SELECT *, bands.name FROM `products`INNER JOIN bands ON products.id_band = bands.id WHERE id_band = 19 
        return  $this->query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function readInnerJoinWhereProductId($column, $id)
    {
        $column = $this->setColumn($column);
        $this->query=  $this->pdo->prep('SELECT ' . $this->getColumn() . ' from ' . $this->getTable(). ' INNER JOIN bands ON products.id_band = bands.id WHERE products.id = :id');
        
        
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);

        $this->query->execute();
       
      
        return  $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById($id)
    {
        $this->query=  $this->pdo->prep('DELETE from ' .$this->getTable() . ' WHERE id = :id');
       
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        
        $this->query->execute();
    }
}