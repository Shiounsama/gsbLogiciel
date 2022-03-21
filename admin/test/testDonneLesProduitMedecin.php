<?php

require_once ("../include/class.pdogsb.inc.php");

$pdo= PdoGsb::getPdoGsb();




try{
var_dump($pdo->donneLesProduitsMedecin(7));
}
catch (Exception $e)
{
    var_dump($e->getMessage());
}