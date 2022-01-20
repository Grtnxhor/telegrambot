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




//get a new chat member
function getnewuser() {

    $input = file_get_contents('php://input');
    $token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
    $input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=-1");
    $output = json_decode($input);
    
    //check if there is a new user
    if(isset($output->result[0]->message->new_chat_member) && $output->result[0]->message->new_chat_member ==  true) {
    
    //welcome person to the group
    $new_user_id = $output->result[0]->message->chat->id;
    $username = $output->result[0]->message->new_chat_member->username;
    
    $send = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=$new_user_id&text=hello $username Welcome here");
    
    echo "Message sent <br/>";
} else {

    echo "no new user found <br/>";
}
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

    unset($_SESSION['idd']);
        
    } else {


        echo "Passing by";
    }
    
}

caller();
getnewuser();
offset();