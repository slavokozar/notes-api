<?php

// "boostrap" the application
require '../bootstrap.php';

// retrieve all notes from database
$limit = null;
$offset = null;
$order_by = 'created_at';
$order_type = 'asc';

if(isset($_GET['limit'])){
    $limit = $_GET['limit'];
}

if(isset($_GET['offset'])){
    $offset = $_GET['offset'];
}

if(isset($_GET['order_by'])){
    $order_by = $_GET['order_by'];
}

if(isset($_GET['order_type'])){
    $order_type = $_GET['order_type'];
}


$notes = Note::all($limit, $offset, $order_by, $order_type);

echo json_encode($notes);

die();