<?php
namespace Controllers\Manager;
use PDO;

class ConnectDb

{

     /**
     * pdo
     *
     * @var object
     */
    protected $pdo;

    public function __construct()
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

    }

    public function prep($sql)
    {
       return $this->pdo->prepare($sql);

    }
}