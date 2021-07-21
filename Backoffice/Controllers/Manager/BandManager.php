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

    public function create(Band &$entity)
    {
        $this->query = $this->pdo->prepare('INSERT INTO ' .$this->getTable() . ' (name,imageBand, description, linkFB,linkInsta,linkYoutube,iframeBandcamp,iframeYoutube, bandSlug) 
        Values (:name, :imageBand,:description, :linkFB, :linkInsta, :linkYoutube, :iframeBandcamp, :iframeYoutube, :slug)');
        
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':imageBand',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
     
        $this->query->execute();
    }

    public function update(Band &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET name = :name, imageBand = :imageBand, description = :description, 
        linkFB = :linkFB, linkInsta = :linkInsta, linkInsta = :linkInsta, linkYoutube = :linkYoutube, iframeBandcamp = :iframeBandcamp, iframeYoutube = :iframeYoutube, bandSlug = :slug WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':imageBand',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);

        $this->query->execute();
      
    }

    public function updateNoPhoto(Band &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET name = :name, description = :description, 
        linkFB = :linkFB, linkInsta = :linkInsta, linkInsta = :linkInsta, linkYoutube = :linkYoutube, iframeBandcamp = :iframeBandcamp, iframeYoutube = :iframeYoutube, bandSlug = :slug WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':name',$entity->getName(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':linkFB',$entity->getLinkFB(), PDO::PARAM_STR);
        $this->query->bindValue(':linkInsta',$entity->getLinkInsta(), PDO::PARAM_STR);
        $this->query->bindValue(':linkYoutube',$entity->getLinkYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeYoutube',$entity->getIframeYoutube(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);

        $this->query->execute();
      
    }
}