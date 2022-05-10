<?php
session_start();

include_once 'config.php';

//  Hashes a password using password_hash builtin function
function set_hashed_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Checks if hashed password and password are the same.
function check_password($password, $hash) {
    return password_verify($password, $hash);
}
