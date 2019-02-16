<?php

class CartController {

    public function actionAdd($id) {
        Cart::addProduct($id);
        $referrer = $_SERVER['HTTP_REFERER'];
        
        header("Location: $referrer");
        return true;
    }

    public function actionAddAjax($id) {
        echo Cart::addProduct($id);

        return true;
    }

    public function actionIndex() {
        $categories = array();
        $categories = Category::getCategories();
        $productsInCart = FALSE;
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once ROOT . '/views/cart/index.php';
        return TRUE;
    }

    public function actionCheckout() {
        $categories = array();
        $categories = Category::getCategories();
        $result = FALSE;
        
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $errors = FALSE;
                
            if (!User::checkName($userName)) { 
                $errors[] = 'Неправильное имя';            
            }
            
            if (!User::checkPhone($userPhone)) { 
                $errors[] = 'Неправильный номер телефона';
            } 
            
            if ($errors == FALSE) {
                $productsInCart = Cart::getProducts();
                
                if (User::isGuest()) { 
                    $userId = FALSE;
                } else { 
                    $userId = User::checkLogger();
                }
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart); 
         
                if ($result) {
                    $adminEmail = 'kgmerlin777@gmail.com';
                    $message = 'http:// CCЫЛКА НА АДМИНИСТРАТИВНЫЙ РАЗдел';
                    $subject = 'Новый  заказ';
//                    mail($adminEmail, $subject, $message);
                    
                    Cart::clear(); 
                }
                
            } else { 
                // форма заполнена не коректно
                //Итоги общая стоимость, кол товаров
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
            
        } else { 
             // форма не отправлена 
            $productsInCart = Cart::getProducts();
            
            if ($productsInCart == FALSE) { 
                header("Location: /online_shop/");
            } else {
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
                
                $userName = FALSE;
                
                if (User::isGuest()) {
                    // форма остается пустой
                } else {
                    $userId = User::checkLogger();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];   
                }
            }
        }
        
        require_once ROOT.'/views/cart/checkout.php';
        return TRUE;
    }
    
       public function actionDelete($id) {
           Cart::deleteFromCart($id);
           
           header("Location: /online_shop/cart");
           return true; 
       }
}
