<?php
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates");
$output = json_decode($input);
$updatid = $output->result[0]->update_id;


//check if there is a new user
if(isset($output->result[0]->message->new_chat_member) && $output->result[0]->message->new_chat_member ==  true) {

//welcome person to the group
$new_user_id = $output->result[0]->message->chat->id;
$username = $output->result[0]->message->new_chat_member->username;

$send = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=$new_user_id&text=hello $username Welcome here");

//offset id
$offset = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=$updatid");
}