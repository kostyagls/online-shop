<?php

class CabinetController {

    public function actionIndex() {
        $userId = User::CheckLogger();
        $user = User::getUserById($userId);
        
        require_once ROOT . '/views/cabinet/index.php';
        return true;
    }

    public function actionEdit() {
        $userId = User::CheckLogger();
        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];
        $result = FALSE;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $errors = FALSE;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-х символов';
            }

            if ($errors == FALSE) {
                $result = User::edit($userId, $name, $password);
            }
        }
        
        require_once ROOT . '/views/cabinet/edit.php';
        return TRUE;
    }
    
    public function actionHistory() {
        $userId = User::CheckLogger();
        $orderHistory = Order::getOrderByUserId($userId);
       
        require_once ROOT . '/views/cabinet/history.php';
        return true ;
    }

    public function actionView($id) {
        $userId = User::CheckLogger();
        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products'], true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);
        
        require_once(ROOT . '/views/cabinet/view.php');
        return true;
    }
}
