<?php
try {
  $bdd = new PDO("mysql:host=localhost;dbname=site_quiz;charset=utf8",
  "test","test",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));;}
catch (Exception $e)
{
  die('Erreur fatale:'.$e->getMessage());
}
?>
