<?php
include_once("./connection.php");

function select_from_database($userName, $password, $database) {
    $conn = connect_with_database();

    $query = "SELECT * FROM $database WHERE userName = :userName AND passwrd = :passwrd";

    $stmt = $conn->prepare($query);

    // Bind the parameters to the prepared statement
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':passwrd', $password);

    $stmt->execute();

    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $result['passwrd'] = true;
    }
    return $result;
}


?>
