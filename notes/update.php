<?php

// "boostrap" the application
require '../bootstrap.php';

if(!isset($_GET['id'])){
    http_response_code(400);
    die();
}

if(!(isset($_POST['title']) && isset($_POST['text']))){
    http_response_code(400);
    die();
}

// retrieve all notes from database
$note = Note::find($_GET['id']);

$note->title = $_POST['title'];
$note->text = $_POST['text'];
$note->save();

echo json_encode($note);

die();