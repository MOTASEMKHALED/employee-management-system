<?php 

$getDtaa = file_get_contents("php://input");
$data = json_decode($getDtaa, true);

include_once('./connection.php');
include_once('./JsonData.php');
include_once('./selectAll.php');

function update_database($new_data){
  // Connect to the database
  $conn = connect_with_database();
  if (!$conn) {
      die('Error connecting to database');
  }
  $userName = $new_data['userName'];
  $F_name = $new_data['F_name'];
  $L_name = $new_data['L_name'];
  $salry = $new_data['salry'];

  $query = "UPDATE emploinfo SET F_name = :Fname, L_name = :Lname, salry = :salry WHERE userName = :userName ";

  $stmt = $conn->prepare($query);

  $stmt->bindParam(':userName', $userName);
  $stmt->bindParam(':Fname', $F_name);
  $stmt->bindParam(':Lname', $L_name);
  $stmt->bindParam(':salry', $salry);


  if($stmt->execute()){
    $response = [
      "massage" => "the value has been updated"
    ];

    send_to_json('../updateMsg.json', json_encode($response));
    remove_Json('../employesData.json');
    send_to_json('../employesData.json' , selectAll_from_database('emploinfo'));
  }else{
    $response = [
      "message" => "Data not inserted successfully",
      "error" => $stmt->errorInfo(),
    ];

    send_to_json('../updateMsg.json', json_encode($response));
  }




  // $arr1 = (array) getEmploy($new_data['userName']);

  
      
  //   foreach($arr1 as $ArrIndex => $value){
  //     if($ArrIndex != "userName"){
  //       if($value != $new_data[$ArrIndex]){
  //         $query = 'UPDATE $table_name SET $ArrIndex = :$new_data[$ArrIndex] WHERE userName = $new_data[\'userName\']' ;

  //         $stmt = $conn->prepare($query);

  //         $stmt->bindParam(':$new_data[$ArrIndex]', $value);
  //       }
  //     }
  //   }
}

// function getEmploy($userName){
//   $conn = connect_with_database();

//   if(!$conn){
//     die('err in conection');
//   }

//   $query = "SELECT * FROM admininfo WHERE userName = :user_name ";


//   $stmt = $conn->prepare($query);


//   $stmt->bindParam(':user_name' , $userName);

//   $stmt->execute();


//   $result = $stmt->fetch(PDO::FETCH_ASSOC);

//   return $result;
// }

// function checkValue($first_arr , $second_Arr){
//   if(count($first_arr) != count($second_Arr)){
//     die('the array length  should be equal');
//   }

//   foreach($first_arr as $key => $value){
//     if($value == $second_Arr[$key]){
//       return  true;
//     }else{
//       return false;
//     }
//   }
// }
  
  
if(isset($data)){
  update_database($data);
}


?>