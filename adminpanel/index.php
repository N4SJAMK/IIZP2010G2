<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$mongo = new MongoClient();
$db = $mongo->selectDB('teamboard-dev');


$collection = $db->selectCollection('users');
$users = $collection->find();

echo '<ul>';
foreach ($users as $user) {
    echo '<li>'.$user['email'].'</li>';
}
echo '</ul>';


