<?php

class User {

    public static function register($name, $email, $password) {
        $db = Db::getConnection();
        $query = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return TRUE;
        }
        
        return FALSE;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        }
        
        return FALSE;
    }

    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        
        return FALSE;
    }
    
    public static function checkPhone($userPhone) { 
        if ( (preg_match('~0([0-9]{9})~', $userPhone)) && (strlen($userPhone) == 10) ) {
            return TRUE;
        }
        
        return FALSE;
    }

    public static function chekEmailExist($email) {
        $db = Db::getConnection();
        $query = 'SELECT COUNT(*) FROM user WHERE email = :email';
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        
        return FALSE;
    }

    public static function checkUserData($email, $password) {
        $db = Db::getConnection();
        $query = 'SELECT * FROM user WHERE password = :password AND email = :email';
        $result = $db->prepare($query);
        $result->bindParam(':email', $email);
        $result->bindParam(':password', $password);
        $result->execute();
        $userInf = $result->fetch();
        
        if ($userInf) {
            return $userInf['id'];
        }

        return FALSE;
    }

    
    public static function auth($userId) {
        $_SESSION['id'] = $userId;
    }
    
    public static function checkLogger() {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];    
        }
       
        header("Location: /online_shop/user/login");
    }
    
    
    public static function isGuest() {
        if (isset($_SESSION['id'])) {
            return FALSE;
        } 
        
        return TRUE;
    }
    
    
    public static function getUserById($userId) {
        $db = Db::getConnection();
        $query = 'SELECT * FROM user WHERE id = :userId';
        $result = $db->prepare($query);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();         
    }
    
    public static function edit($id, $name, $password) { 
        $db = Db::getConnection();
        $query = "UPDATE user SET name = :name, password = :password WHERE id = :id";
        $result = $db->prepare($query);       
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
}
