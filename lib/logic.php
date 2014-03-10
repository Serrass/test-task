<?php
// This file is generateasd by Composer
require_once './vendor/autoload.php';
$client = new \Github\Client();

$client->authenticate('sergio.semenyuk@gmail.com','roliks1roliks');
/******************index***********************/
if (!$_GET) {
    try {
        $repository = $client->api('repo')->show('yiisoft', 'yii');
        $contributors = $client->api('repo')->contributors('yiisoft', 'yii');
    } catch (Exception $e) {
        $repository = array();
        $contributors = array();
        //echo 'You can\'t use GitHub Api: ',  $e->getMessage(), "\n";
    } 
}
/****************repository profile*************************/
if(!empty($_GET['user']) and !empty($_GET['repo'])) {
    
    $sUser = $_GET['user'];
    $sRepo = $_GET['repo'];
  
    try {
        $repository = $client->api('repo')->show($sUser, $sRepo);
        $contributors = $client->api('repo')->contributors($sUser, $sRepo);
    } catch (Exception $e) {
        $repository = array();
        $contributors = array();
        //echo 'You can\'t use GitHub Api: ',  $e->getMessage(), "\n";
    } 
}
/***************user profile**************************/
if (!empty($_GET['user'])) {
    $userLogin = trim($_GET['user']);
    try {
       $user = $client->api('user')->show($userLogin);
    } catch (Exception $e) {
        $user = array();
        //echo 'You can\'t use GitHub Api: ',  $e->getMessage(), "\n";
    } 
}
/***************search**************************/
if (!empty($_GET['q'])) {
    $search = trim($_GET['q']);
    try {
        $searchRepos = $client->api('repo')->find($search);
    } catch (Exception $e) {
        $searchRepos = array();
        //echo 'You can\'t use GitHub Api: ',  $e->getMessage(), "\n";
    } 
}
