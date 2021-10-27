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

        }
    }

    private function validatePassword($password, $password_confirm ){

    }

    private function validateFirstName($firstName){

    }

    private function validateLastName($lastName){

    }

}