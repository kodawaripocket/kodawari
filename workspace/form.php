<?php

$dsn = 'mysql:dbname=uriage;host=localhost;port=8000';
$user = 'yuta';

try {
    $pdo = new PDO($dsn, $user);
}
catch(PDOException $e) {
    print ('Error:' . $e->getMessage());
    die();
}
?>