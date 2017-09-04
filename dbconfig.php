<?php

/* Database Configuration file */

$DB_host = "localhost";
$DB_user = "root"; // database_username
$DB_pass = "root"; // database_password
$DB_name = "php_crud"; // database_name

define('SITE_NAME', 'PHP-CRUD-DEMO');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . SITE_NAME . '/');


try {
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once 'class.crud.php';

$crud = new crud($DB_con);
?>