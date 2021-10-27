<?php

function sanitizeUsername($input){
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    return $input;
}

function sanitizePassword($input){
    $input = strip_tags($input);
    return $input;
}

function sanitizeString($input){
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = ucfirst(strtolower($input));
    return $input;
}

if(isset($_POST['register_button'])){
    $username = sanitizeUsername($_POST['username']);
    $firstName = sanitizeString($_POST['firstName']);
    $lastName = sanitizeString($_POST['lastName']);
    $email = sanitizeString($_POST['email']);
    $email_confirm = sanitizeString($_POST['confirm_email']);
    $password = sanitizePassword($_POST['password']);
    $password_confirm = sanitizePassword($_POST['confirm_password']);

    $wasSuccessful = $account->register($username, $firstName, $lastName, $email, $email_confirm, $password, $password_confirm);

}

