<?php 

include_once("./connection.php");

function selectAll_from_database($database) {
    $conn = connect_with_database();

    $query = "SELECT * FROM $database";

    $stmt = $conn->prepare($query);



    $stmt->execute();


    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}



?>