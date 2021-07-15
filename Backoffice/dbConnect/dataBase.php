<?php
    
try 
{
    $dbh = new PDO('mysql:host=localhost;dbname=leceperecords', "root", "");
    $dbh->exec('SET NAMES UTF8');
    $dbh->exec("SET lc_time_names = 'fr_FR'");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} 
catch (Exception $e) 
{
  die("Impossible de se connecter : " . $e->getMessage());
}
?> 