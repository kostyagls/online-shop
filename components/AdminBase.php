<?php

abstract class AdminBase { 
    
    public static function checkAdmin() { 
        
        $userId = User::checkLogger();
        
        $user = User::getUserById($userId);
        if ($user['role'] == 'admin') { 
            return TRUE;
        } 
        
        die('Access denied');
    }
    
    public static function checkAdminWithoutDie() { 
        
        $userId = User::checkLogger();
        
        $user = User::getUserById($userId);
        if ($user['role'] == 'admin') { 
            return TRUE;
        } 
        
        return FALSE;
    }
    
}