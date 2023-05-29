<?php

namespace app\api\models;

use common\models\User;
use Yii;
use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $lastname;
    public $firstname;

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->lastname = $this->lastname;
        $user->firstname = $this->firstname;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateAccessToken();
        $user->generateEmailVerificationToken();

        return $user->save();
    }
}