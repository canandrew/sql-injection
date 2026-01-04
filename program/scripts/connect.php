<?php
/*
SQL Injection by Andrew Myrden

connect.php PURPOSE:
PHP file to establish a connection to the MySQL database using PDO.

****NOTE****: If your setup uses a different username, password, or host, please
edit the values below accordingly.

Created 2026-01-04
*/



try {
    $dbh = new PDO("mysql:host=localhost;dbname=sql-injection", "root", "");
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}