<?php

class User {

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM public.user WHERE email = :inputEmail and password = :inputPassword');
        $this->db->bind(':inputEmail', $email);
        $this->db->bind(':inputPassword', $password);
        return $this->db->fetch();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO public.user (email,password) values(:userEmail, :userPass)');
        $this->db->bind(':userEmail', $data['userEmail']);
        $this->db->bind(':userPass', $data['userPass']);
        return $this->db->fetch();
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM public.user WHERE email = :userEmail');
        $this->db->bind(':userEmail', $email);

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
}