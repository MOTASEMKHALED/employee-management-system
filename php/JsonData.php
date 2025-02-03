<?php 


function send_to_json($file_dir, $data)
{
    if(!empty($data)){
      $get_from_db = $data;

      $json_encoded = json_encode($get_from_db);

      file_put_contents($file_dir, $json_encoded);
    }
}


function get_from_json($file_dir){

    if(!file_exists($file_dir)){
      die("this file does not exists ");
    }


    return json_decode(file_get_contents($file_dir)); 

}


function remove_Json($file_dir){
  if(!file_exists($file_dir)){
    return ;
  }

  unlink($file_dir);

}


?>