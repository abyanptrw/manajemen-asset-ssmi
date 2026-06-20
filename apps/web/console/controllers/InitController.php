<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use common\models\User;
use Yii;

class InitController extends Controller
{
    public function actionUser($username = 'admin', $password = 'password', $email = 'admin@example.com')
    {
        echo "=== Creating Default User ===\n\n";
        
        // Check if user exists
        $existingUser = User::findByUsername($username);
        if ($existingUser) {
            echo "User '{$username}' already exists.\n";
            return ExitCode::OK;
        }
        
        // Create new user
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        
        if ($user->save()) {
            echo "✅ User created successfully!\n\n";
            echo "Username: {$username}\n";
            echo "Password: {$password}\n";
            echo "Email: {$email}\n";
            echo "Status: ACTIVE\n\n";
            echo "You can now login with these credentials.\n";
            return ExitCode::OK;
        } else {
            echo "❌ Failed to create user.\n";
            echo "Errors: " . json_encode($user->errors) . "\n";
            return ExitCode::DATAERR;
        }
    }
    
    public function actionDefaultUsers()
    {
        echo "=== Creating Multiple Default Users ===\n\n";
        
        $users = [
            ['username' => 'admin', 'password' => 'admin123', 'email' => 'admin@petrolab.com'],
            ['username' => 'manager', 'password' => 'manager123', 'email' => 'manager@petrolab.com'],
            ['username' => 'user', 'password' => 'user123', 'email' => 'user@petrolab.com'],
        ];
        
        foreach ($users as $userData) {
            $existingUser = User::findByUsername($userData['username']);
            if ($existingUser) {
                echo "⏭️  User '{$userData['username']}' already exists, skipping...\n";
                continue;
            }
            
            $user = new User();
            $user->username = $userData['username'];
            $user->email = $userData['email'];
            $user->setPassword($userData['password']);
            $user->generateAuthKey();
            $user->status = User::STATUS_ACTIVE;
            
            if ($user->save()) {
                echo "✅ Created: {$userData['username']} / {$userData['password']}\n";
            } else {
                echo "❌ Failed: {$userData['username']} - " . json_encode($user->errors) . "\n";
            }
        }
        
        echo "\n=== All users created! ===\n";
        return ExitCode::OK;
    }
}
