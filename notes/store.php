<?php

// "boostrap" the application
require '../bootstrap.php';

if(!(isset($_POST['title']) && isset($_POST['text']))){
    http_response_code(400);
    die();
}

// retrieve all notes from database
$note = new Note($_POST);

echo json_encode($note);

die();