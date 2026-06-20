<?php
namespace common\models;

use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    public $id;
    public $username;
    public $password; // ← tambahkan password

    private static $users = [
        // kamu bisa ganti/extend array ini kalau mau pakai lebih dari 1 user
        'admin' => [
            'id' => 1,
            'username' => 'admin',
            'password' => 'admin', // bisa diganti dengan hash kalau perlu
        ],
    ];

    public static function findIdentity($id)
    {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return new static($user);
            }
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // tidak digunakan
    }

    public static function findByUsername($username)
    {
        if (isset(self::$users[$username])) {
            return new static(self::$users[$username]);
        }
        return null;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function __construct($config = [])
    {
        foreach ($config as $k => $v) {
            $this->$k = $v;
        }
    }
}
