<?php
/*
SQL Injection by Andrew Myrden

check-login.php PURPOSE:
PHP file for the index (home) page of the demo. Displays a sample 'admin login' which
is vulnerable to SQL Injection, due to a lack of input sanitization.

Created 2026-01-04
*/

require 'connect.php'; 

// set header to return plain text for AJAX
header('Content-Type: text/plain'); 

// get username and password from POST request
// coalesce operator (??) ensures script doesn't crash if vars are missing
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// --- VULNERABILITY COMMENT ---
// VULNERABLE TO SQL INJECTION: The user input variables ($user and $pass)
// are concatenated directly into the SQL query string. An attacker can use
// input like ' OR '1'='1 to manipulate the query's logic.
// e.g., Username: admin' OR '1'='1
// This results in the query:
// SELECT * FROM `admin-logins` WHERE username='admin' OR '1'='1' AND password='...'
// which returns ALL rows, leading to a successful login without a password.
// ---

// Note: We use PDO's query() method here, which is vulnerable when parameters are concatenated.
// **PDO is being used in a vulnerable way for the demo.**
try {
    // IMPORTANT: Change 'admin-logins' to your actual table name if different (e.g., 'users')
    $sql = "SELECT password FROM `admin-logins` WHERE username = '$user'"; 
    
    // Execute the vulnerable query
    $stmt = $dbh->query($sql);
    $userRow = $stmt->fetch();

    if ($userRow) {
        // User found, now check the hashed password
        $hashedPassword = $userRow['password'];
        
        // This password check is correct (using password_verify), but the initial
        // query is bypassable, making the check irrelevant if SQLi is used.
        if (password_verify($pass, $hashedPassword)) {
            // Successful login
            echo 'SUCCESS';
        } else {
            // Incorrect password
            echo 'Incorrect username or password.';
        }
    } else {
        // User not found
        echo 'Incorrect username or password.';
    }
} catch (PDOException $e) {
    // In a real application, only log the error, not show it to the user.
    // For this demo, a generic error is fine.
    echo 'Login failed due to a database error.'; 
}
