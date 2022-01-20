<?php
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates");
$output = json_decode($input);
$update_id = $output->result[0]->update_id;

if(isset($output->result[0]->message->new_chat_member)) {

//tell us who the person is
print_r($output->result[0]->message->new_chat_member);
}