<?php

class SignUp
{
    private $errors = [];
    
    public function __construct()
    {
        if (Request::method() == 'POST') {
            $this->createNewUser();
        } else {
            $this->displayForm();
        }
    }

    private function createNewUser()
    {
        if ($this->isValidForm()) {
            $this->insertToDatabase();
        } else {
            $this->displayForm(); // with errors
        }
    }

    private function isValidForm()
    {
        if (Validation::isEmpty('username')) {
            $this->errors['username'] = 'User name is required';
        }
        
        if (Validation::isEmpty('email')) {
            $this->errors['email'] = 'email is required';
        } elseif (! Validation::isEmail('email')) [
            $this->errors['email'] = 'Invalid email address';
        ] elseif (Database::exists('email')) {
            $this->errors['email'] = 'email address exists';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}

new Signup;