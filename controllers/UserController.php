<?php

class UserController {

    public function actionRegister() {
        $name = '';
        $email = '';
        $password = '';
        $result = FALSE;
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            

            $errors = FALSE;

            if (!User::checkName($name)) {

                $errors[] = 'Имя не должно быть короче 2 символов';
            }

            if (!User::checkEmail($email)) {


                $errors[] = 'неправильный email';
            }

            if (!User::checkPassword($password)) {

                $errors[] = 'пароль не может быть короче 6 символов';
            }
            
            if(User::chekEmailExist($email)){
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == FALSE) {
               $result = User::register($name, $email, $password);
            }
        }
        
        require ROOT . '/views/user/register.php';
        return true;
    }

    
    
    public function actionLogin() {
        
        $email = '';
        $password ='';
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            
            $errors = FALSE;
            
            if(!User::checkEmail($email)) {
                
                $errors[] = 'Неправильный email';
            }
            if(!User::checkPassword($password)) { 
                
                $errors[] = 'пароль не может быть короче 6 символов';
            }
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) { 
                
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                header("Location: /online_shop/cabinet/"); 
                
            }
        }
        require_once ROOT.'/views/user/login.php';
        return true; 
    }
    
    
    public function actionLogout() {
        
        unset($_SESSION['id']);
        header("Location: /online_shop/");    
    }
    
    
    
    
}
