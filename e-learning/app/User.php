<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User implements AuthenticatableContract{
    use Notifiable;
    public $account;
    protected $password;
    public function setPw($pw){
        $this->password=$pw;
    }

    public function __construct2($account,$password){
        $this->account=$account;
        $this->password=$password;
    }
    public function __construct(){}

    protected function setAccount($account){
        $this->account=$account;
    }
    public function getAuthIdentifierName(){
        return $this->account;
    }

    public function getAuthPassword(){
        return 'how about no';
    }

    public function getAuthIdentifier(){
        return $this->account;
    }

    public function getRememberToken(){
    }

    public function setRememberToken($value){
    }
    public function getRememberTokenName(){
    }
}
