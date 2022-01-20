<?php

//get last post update id
function caller() {
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=-1");
$output = json_decode($input);

//check if offset is not empty
if($output->result == true) {

    $updatid = $output->result[0]->update_id;
    $newidd = $updatid + 1;
    
    $_SESSION['idd'] = $newidd; 
    
} else {

    echo "nope <br/>";
}
}

caller();


//get a new chat member
function getnewuser() {


    
}

//offset the update
function offset() {
    
    $input = file_get_contents('php://input');
    $token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';

    if(isset($_SESSION['idd'])) {

    $updid = $_SESSION['idd'];
    $input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=$updid");
    $output = json_decode($input);

    echo "done";
        
    } else {


        echo "Passing by";
    }
    
}

offset();