<?php
// index.php
require_once 'functions.php';
 
$users = buildArrayUsersFromFile('db.txt');
 
setAverageValues($users);
 
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : '1';
sortUsers($users, $sortBy);
 
echo buildFormSortHtml();
echo buildUserTableHtml($users);