<?php

require_once '../app/libraries/Model.php';

class User  extends Model {

    public function login($email, $password)
    {
        return false;
    }

    public function register($data)
    {
        return false;
    }

}