<?php

// "boostrap" the application
require '../bootstrap.php';

if(!isset($_GET['id'])){
    http_response_code(400);
    die();
}

$note = Note::find($_GET['id']);

echo json_encode($note);

die();