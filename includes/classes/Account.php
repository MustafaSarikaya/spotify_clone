<?php
//
//namespace includes\classes;

class Account{

    private $errorArray;
    private $con;

    public function __construct($con){
        $this->errorArray = array();
        $this->con = $con;
    }

    public function login($un, $pw) {
        $pw = md5($pw);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");
        if (mysqli_num_rows($query) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function register($un, $em, $em2, $pw,$pw2, $fn, $ln){
        $this->validateUsername($un);
        $this->validateEmail($em,em2);
        $this->validatePassword($pw, pw2);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);

        if(empty($this->errorArray)){
            return $this->insertUserDetails($un, $em, $pw, $fn, $ln);
        }
        else {
            return false;
        }
    }

    public function getError($error){
        if(!in_array($error,$this->errorArray)){
           $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($un, $em, $pw, $fn, $ln) {
        $encriptedPw = md5($pw);
        $profilePic = "assests/images/profile-pics/head_emerald.png";
        $date = date("Y-m-d");
        return mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un','$em', '$pw', '$fn', '$ln')");
    }

    private function validateUsername($username){
        if (strlen($username) > 25 || strlen($username) < 5 ){
            array_push($this->errorArray, "Your username must be between 5 and 25 characters");
            return;
        }

        //TODO check is username already exists
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username'");
        if(mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, "This username already exists");
            return;
        }
    }

    private function validateEmail($email, $email_confirm){
        if ($email !== $email_confirm){
            array_push($this->errorArray, "Emails are not matching");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
            array_push($this->errorArray, "Email is invalid");
        }

        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE username='$email'");
        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, "This email already in use");
            return;
        }
    }

    private function validatePassword($password, $password_confirm ){
        if ($password !== $password_confirm){
            array_push($this->errorArray, "Passwords are not matching");
        }

        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, "Passwords must contain characters A-z and digits 0-9");
        }

        if(strlen($password) > 30 || strlen($password) < 5) {
            array_push($this->errorArray, "Password must be between 5 and 30 characters");
            return;
        }
    }

    private function validateFirstName($firstName){
        if (strlen($firstName) > 25 || strlen($firstName) < 2 ){
            array_push($this->errorArray, "Your name must be between 2 and 25 characters");
            return;
        }
    }

    private function validateLastName($lastName){
        if (strlen($lastName) > 25 || strlen($lastName) < 2 ){
            array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
            return;
        }
    }



}
