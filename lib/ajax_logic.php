<?php
include_once 'Db/db_class.php';
if(!$_GET){
    return false;
}



if (!empty($_GET['action'])
    and !empty($_GET['parent_id'])
    and !empty($_GET['parent_type'])) {
    
    $action = trim($_GET['action']);
    $parentId = trim($_GET['parent_id']);
    $parentType = trim($_GET['parent_type']);
    $status = array('message' => 'error');
    $pdo = Database::connect();
    $likeResult = Database::setAction($action, $parentId, $parentType);
    if ($likeResult) {
        $status['message'] = 'ok';
    } 
    echo json_encode($status);
    exit;
}