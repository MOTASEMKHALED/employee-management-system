<?php
// get data from php input stream
$getDtaa = file_get_contents("php://input");
$GLOBALS['jsonData'] = json_decode($getDtaa, true);

include_once('./connection.php');
include_once('./JsonData.php');
include_once('./selectAll.php');
function insert_to_database($database)
{
  $fname = $GLOBALS['jsonData']['F_name'];
  $lname = $GLOBALS['jsonData']['L_name'];
  $username = $GLOBALS['jsonData']['userName'];
  $passwrd = md5($GLOBALS['jsonData']['passwrd'] . 'lol');
  $img = $GLOBALS['jsonData']['img'];
  $rules = $GLOBALS['jsonData']['rules'];
  $email = $GLOBALS['jsonData']['email'];
  $PhoneNumber = $GLOBALS['jsonData']['PhoneNumber'];
  $section = $GLOBALS['jsonData']['section'];
  $userStatus = $GLOBALS['jsonData']['userStatus'];
  $gender = $GLOBALS['jsonData']['gender'];



  $conn = connect_with_database();

  $query = "INSERT INTO $database (`F_name`, `L_name`, `userName`, `passwrd`, `img`, `rules`, `email`, `PhoneNumber`, `section`, `userStatus` , `gender`)
  VALUES (:F_name, :L_name, :userName, :passwrd, :img, :rules, :email, :PhoneNumber, :section, :userStatus , :gender)";

  $stmt = $conn->prepare($query);


  $stmt->bindParam(':F_name', $fname);
  $stmt->bindParam(':L_name', $lname);
  $stmt->bindParam(':userName', $username);
  $stmt->bindParam(':passwrd', $passwrd);
  $stmt->bindParam(':img', $img);
  $stmt->bindParam(':rules', $rules);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':PhoneNumber', $PhoneNumber);
  $stmt->bindParam(':section', $section);
  $stmt->bindParam(':userStatus', $userStatus);
  $stmt->bindParam(':gender', $gender);



  if ($stmt->execute()) {
    $response = [
      "message" => "Data inserted successfully",
    ];
    send_to_json("../insertMsg.json", json_encode($response));
    remove_Json('../employesData.json');
    send_to_json('../employesData.json', selectAll_from_database('emploinfo'));
  } else {
    $response = [
      "message" => "Data not inserted successfully",
      "error" => $stmt->errorInfo(),
    ];
    send_to_json("../insertMsg.json", json_encode($response));
  }

}


if (isset($GLOBALS['jsonData'])) {
  if ($GLOBALS['jsonData']['userName'][0] == 'a') {
    insert_to_database("admininfo");
  }
  if ($GLOBALS['jsonData']['userName'][0] == 'e') {
    insert_to_database("emploinfo");
  }

}


?>