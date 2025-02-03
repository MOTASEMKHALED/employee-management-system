<?php 
$getDtaa = file_get_contents("php://input");
$data = json_decode($getDtaa, true);

include_once('./connection.php');
include_once('./JsonData.php');
include_once('./selectAll.php');

function delete_from_database($table_name, $column_name) {
    // Connect to the database
    $conn = connect_with_database();
    if (!$conn) {
      die('Error connecting to database');
    }
  
 
    $query = "DELETE FROM $table_name WHERE userName = :column_name";
    $stmt = $conn->prepare($query);
  

    $stmt->bindParam(":column_name", $column_name, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $response = [
        "message" => "Record deleted successfully",
        "deleted_count" => $stmt->rowCount(),
      ];
      send_to_json("../DeleteMsg.json", json_encode($response));
      remove_Json('../employesData.json');
      send_to_json('../employesData.json' , selectAll_from_database('emploinfo'));
    } else {
      $response = [
        "message" => "Error deleting record",
        "error" => $stmt->errorInfo(),
      ];
      echo send_to_json("../DeleteMsg.json", json_encode($response));
    }


  }
  
  
if(isset($data['userName'])){
    delete_from_database("emploinfo" , $data['userName']);
}


?>