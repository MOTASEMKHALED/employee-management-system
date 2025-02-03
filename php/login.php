<?php
$getDtaa = file_get_contents("php://input");
$data = json_decode($getDtaa, true);

include_once('./select.php');
include_once('./selectAll.php');
include_once('./JsonData.php');


if(isset($data)){
    if($data['userName'][0] == 'a'){
        send_to_json('../Data.json' , select_from_database($data['userName'] , md5($data['password']) , 'admininfo'));

        send_to_json('../employesData.json' , selectAll_from_database('emploinfo'));
    }

    if($data['userName'][0] == 'e'){
        send_to_json('../EmploData.json' , select_from_database($data['userName'] , md5($data['password']) , 'emploinfo'));
    }


    if($data['remove_Json']){
        remove_Json($data['file']);
    }
}

?>



