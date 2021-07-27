<?php
namespace Controllers\Manager;
use Controllers\Entity\Product;
use PDO;

class ProductManager
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


    public function create(Product &$entity)
    {
        $this->query = $this->pdo->prepare('INSERT INTO ' .$this->getTable() . ' (image,imageAlt, title, dateSortie,type, price, dispo, description, iframeBandcamp, linkBandcamp, slug, id_band) 
        Values (:image,:imageAlt, :title, :dateSortie,:type, :price, :dispo, :description, :iframeBandcamp, :linkBandcamp, :slug, :id_band)');
        
        $this->query->bindValue(':image',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':imageAlt',$entity->getImageAlt(), PDO::PARAM_STR);
        $this->query->bindValue(':title',$entity->getTitle(), PDO::PARAM_STR);
        $this->query->bindValue(':dateSortie',$entity->getDate(), PDO::PARAM_STR);
        $this->query->bindValue(':type',$entity->getType(), PDO::PARAM_STR);
        $this->query->bindValue(':price',$entity->getPrice(), PDO::PARAM_STR);
        $this->query->bindValue(':dispo',$entity->getDispo(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
        $this->query->bindValue(':id_band',$entity->getIdBand(), PDO::PARAM_INT);

        $this->query->execute();
    }

    public function updateImage(Product &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET image = :image, title = :title, 
        dateSortie = :dateSortie, type = :type, price = :price, dispo = :dispo, description = :description, iframeBandcamp = :iframeBandcamp, linkBandcamp = :linkBandcamp, slug = :slug, id_band = :id_band WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':image',$entity->getImage(), PDO::PARAM_STR);
        $this->query->bindValue(':title',$entity->getTitle(), PDO::PARAM_STR);
        $this->query->bindValue(':dateSortie',$entity->getDate(), PDO::PARAM_STR);
        $this->query->bindValue(':type',$entity->getType(), PDO::PARAM_STR);
        $this->query->bindValue(':price',$entity->getPrice(), PDO::PARAM_STR);
        $this->query->bindValue(':dispo',$entity->getDispo(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
        $this->query->bindValue(':id_band',$entity->getIdBand(), PDO::PARAM_INT);

        $this->query->execute();
      
    }
    public function updateImageAlt(Product &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET imageAlt = :imageAlt, title = :title, 
        dateSortie = :dateSortie, type = :type, price = :price, dispo = :dispo, description = :description, iframeBandcamp = :iframeBandcamp,linkBandcamp = :linkBandcamp, slug = :slug, id_band = :id_band WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':imageAlt',$entity->getImageAlt(), PDO::PARAM_STR);
        $this->query->bindValue(':title',$entity->getTitle(), PDO::PARAM_STR);
        $this->query->bindValue(':dateSortie',$entity->getDate(), PDO::PARAM_STR);
        $this->query->bindValue(':type',$entity->getType(), PDO::PARAM_STR);
        $this->query->bindValue(':price',$entity->getPrice(), PDO::PARAM_STR);
        $this->query->bindValue(':dispo',$entity->getDispo(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
        $this->query->bindValue(':id_band',$entity->getIdBand(), PDO::PARAM_INT);

        $this->query->execute();
      
    }

    public function updateNoPhoto(Product &$entity)
    {
        $this->query = $this->pdo->prepare('UPDATE ' .$this->getTable(). ' SET title = :title, 
        dateSortie = :dateSortie, type = :type, price = :price, dispo = :dispo, description = :description, iframeBandcamp = :iframeBandcamp, linkBandcamp = :linkBandcamp, slug = :slug, id_band = :id_band WHERE id = :id');

        $this->query->bindValue(':id',$entity->getId(), PDO::PARAM_INT);
        $this->query->bindValue(':title',$entity->getTitle(), PDO::PARAM_STR);
        $this->query->bindValue(':dateSortie',$entity->getDate(), PDO::PARAM_STR);
        $this->query->bindValue(':type',$entity->getType(), PDO::PARAM_STR);
        $this->query->bindValue(':price',$entity->getPrice(), PDO::PARAM_STR);
        $this->query->bindValue(':dispo',$entity->getDispo(), PDO::PARAM_STR);
        $this->query->bindValue(':description',$entity->getDescription(), PDO::PARAM_STR);
        $this->query->bindValue(':iframeBandcamp',$entity->getIframeBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':linkBandcamp',$entity->getLinkBandcamp(), PDO::PARAM_STR);
        $this->query->bindValue(':slug',$entity->getSlug(), PDO::PARAM_STR);
        $this->query->bindValue(':id_band',$entity->getIdBand(), PDO::PARAM_INT);

        $this->query->execute();
      
    }
}