<?php
namespace Controllers\Manager;
use Controllers\Entity\Band;
use PDO;

class BandManager
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

    public function create(Band &$entity)
    {
        $this->query = $this->pdo->prepare('INSERT INTO ' .$this->getTable() . ' (name,imageBand, description, linkFB,linkInsta,linkYoutube,linkBandcamp,iframeYoutube, slug) 
        Values (:name, :imageBand,:description, :linkFB, :linkInsta, :linkYoutube, :linkBandcamp, :iframeYoutube, :slug)');
        
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':imageBand',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
     
        $this->query->execute();
    }

    public function update(Band &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET name = :name, imageBand = :imageBand, description = :description, 
        linkFB = :linkFB, linkInsta = :linkInsta, linkInsta = :linkInsta, linkYoutube = :linkYoutube, linkBandcamp = :linkBandcamp, iframeYoutube = :iframeYoutube, slug = :slug WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':imageBand',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);

        $this->query->execute();
      
    }

    public function updateNoPhoto(Band &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET name = :name, description = :description, 
        linkFB = :linkFB, linkInsta = :linkInsta, linkInsta = :linkInsta, linkYoutube = :linkYoutube, linkBandcamp = :linkBandcamp, iframeYoutube = :iframeYoutube, slug = :slug WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);

        $this->query->execute();
      
    }
}