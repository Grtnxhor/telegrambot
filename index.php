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
    $group = $output->result[0]->message->chat->title;
    $msgnw = "https://t.me/$username";

    $txt = urlencode("Hello sir, \n $username just joined the $group group today.\n");
    
    //$send = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=$new_user_id&text=$txt Click here to message this user: $msgnw");

    $send = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=1944107618&text=$txt Click here to message this user: $msgnw");
    $snd = file_get_contents("https://api.telegram.org/bot$token/sendmessage?chat_id=1625430745&text=$txt Click here to message this user: $msgnw");
    
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

function sendmessage() {
//get last post update id
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates?offset=-1");
$output = json_decode($input);

//check if offset is not empty and a new member is added
if(($output->result == true) && isset($output->result[0]->message->new_chat_member) && ($output->result[0]->message->new_chat_member ==  true)) {


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
}
sendmessage();
echo '

<script>
setInterval(function() {
    parent.location.reload();
}, 1000);
</script>';

?>