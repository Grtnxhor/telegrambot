<?php
$input = file_get_contents('php://input');
$token = '5040140768:AAETyGZKm6yKSWNsgGeCHF7zhVBY9vLeyMY';
$input = file_get_contents("https://api.telegram.org/bot$token/getUpdates");
$output = json_decode($input);

print_r($output->result[0]);