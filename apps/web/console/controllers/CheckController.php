<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\User;

class CheckController extends Controller
{
    public function actionUsers()
    {
        echo "=== Checking Existing Users ===\n\n";
        
        $users = User::find()->all();
        
        if (count($users) > 0) {
            echo "Found " . count($users) . " user(s):\n\n";
            foreach ($users as $user) {
                $statusText = $user->status == User::STATUS_ACTIVE ? 'ACTIVE' : 
                             ($user->status == User::STATUS_INACTIVE ? 'INACTIVE' : 'DELETED');
                echo "ID: {$user->id}\n";
                echo "Username: {$user->username}\n";
                echo "Email: {$user->email}\n";
                echo "Status: {$statusText}\n";
                echo "---\n";
            }
        } else {
            echo "No users found in database.\n";
        }
    }
}
