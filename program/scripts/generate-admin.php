<?php
/*
SQL Injection by Andrew Myrden

generate-admin.php PURPOSE:
Manual script to add an admin user to the admin-accounts table.
Run this ONCE each time you want to add a new admin by opening `sql-injection/scripts/generate-admin.php`.

****NOTE****: Obviously, in a real production environment this script would never be published.
It is simply here so that the reader is able to make their own account for demo purposes.

Created 2026-01-04
*/

require 'connect.php';

// ============================
// EDIT THESE VALUES BELOW
// ============================
$username = 'john'; // MAX 16 CHARS 
$plainPassword = 'pass1234'; 
// ============================

// hash the password
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// insert into database
try {
    $stmt = $dbh->prepare("INSERT INTO `admin-logins` (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    echo "Admin user '{$username}' was successfully added.";
} catch (PDOException $e) {
    echo "Error inserting admin: " . $e->getMessage();
}