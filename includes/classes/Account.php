<?php
class Account{

    public function __constructor(){
        $this->errorArray = array();
    }

    public function register($un, $em, $em2, $pw, $pw2, $fn, $sn){
        $this->validateUsername($un);
        $this->validateEmail($em,$em2);
        $this->validatePassword($pw, $pw2);
        $this->validateFirstName($fn);
        $this->validateLastName($sn);

        if(empty($this->errorArray)){
            return true;
        }
        else {
            return false;
        }
    }

    public function getError($error){
        if(!in_array($error, $this->errorArray)){
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function validateUsername($username){
        if (strlen($username) > 25 || strlen($username) < 5 ){
            array_push($this->errorArray, "Your username must be between 5 and 25 characters");
            return;
        }

        //TODO check is username already exists
    }

    private function validateEmail($email, $email_confirm){
        if ($email !== $email_confirm){
            array_push($this->errorArray, "Emails are not matching");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
            array_push($this->errorArray, "Email is invalid");
        }
    }

    private function validatePassword($password, $password_confirm ){
        if ($password !== $password_confirm){
            array_push($this->errorArray, "Passwords are not matching");
        }

        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, "Passwords must contain characters A-z and digits 0-9");
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