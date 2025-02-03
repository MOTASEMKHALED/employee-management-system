<?php

function connect_with_database()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webproject";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username , $password);

        if($conn){
            echo 'true';
        }else{
            echo 'false';
        }

        
        return $conn;

    }catch (PDOException $e){
        die("error in connection:");
    }

}


