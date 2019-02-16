<?php

class Cart {

    public static function addProduct($id) {
        $id = intval($id);
        $productsInCart = array();
         
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }

    public static function countItems() {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $number) {
                $count = $count + $number;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts() {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        } else {
            return FALSE;
        }
    }

    public static function getTotalPrice($products) {
        $totalPrice = 0;
        $productsInCart = self::getProducts();
        
        foreach ($products as $item) {
            $totalPrice = $totalPrice + $item['price'] * $productsInCart[$item['id']];
        }
        
        return $totalPrice;
    }

    public static function clear() {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    public static function deleteFromCart($id) {
       if(isset($_SESSION['products'])) { 
           unset($_SESSION['products'][$id]);
       }  
    }

}
