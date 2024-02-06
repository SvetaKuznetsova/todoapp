<?php

/*
try{
    $dbh = new pdo( "mysql:host=backofficedb.d4;port=3306';dbname=sys", 'developer', 'developer',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => "test")));
}*/

$servername = 'mysql';//"127.0.0.1";
$username = "root";
$password = "root";
$port =3306;
try{
    $dbh = new pdo( "mysql:host=$servername;port='$port';dbname=mysql", $username, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => $ex)));
}
