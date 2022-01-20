<?php

//get a new chat member
function getnewuser() {

    $input = file_get_contents('php://input');
    $token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
    $input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=-1");
    $output = json_decode($input);

    //welcome person to the group
    $new_user_id = $output->result[0]->message->chat->id;
    $username = $output->result[0]->message->new_chat_member->username;
    
    $send = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=$new_user_id&text=hello $username Welcome here");
    
} 



//offset the update
function offset() {
    
    $input = file_get_contents('php://input');
    $token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';

    if(isset($_SESSION['idd'])) {

    $updid = $_SESSION['idd'];
    $input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=$updid");
    $output = json_decode($input);

    unset($_SESSION['idd']);
        
    }
}

//get last post update id
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=-1");
$output = json_decode($input);

//check if offset is not empty and a new member is added
if(($output->result == true) && ($output->result[0]->message->new_chat_member ==  true)) {


    //welcome new member
    getnewuser();

    //set offset id
    $updatid = $output->result[0]->update_id;
    $newidd = $updatid + 1;
    $_SESSION['idd'] = $newidd; 

    offset();

    echo "Message sent to new user successfully <br/>";
    
 } else {

    echo "No new user seen";
 }