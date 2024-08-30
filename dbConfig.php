<?php

use PhpParser\Node\Stmt\TryCatch;

$dbName = 'mysql:host=localhost;dbname=php-foto;charset=utf8';
$userName = 'root';

Try {
    $db =new PDO($dbName,$userName);
    
}Catch (\Throwable $th) {
    exit();
}