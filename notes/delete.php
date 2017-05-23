<?php

// "boostrap" the application
require '../bootstrap.php';

if(!isset($_GET['id'])){
    http_response_code(400);
    die();
}

// retrieve all notes from database
note::delete($_GET['id']);

die();