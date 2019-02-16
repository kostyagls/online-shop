<?php

class Order {

 public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);
        $db = Db::getConnection();
        $query = 'INSERT INTO product_order '
                . '(user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:userName, :userPhone, :userComment, :userId, :products)';
        $result = $db->prepare($query);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function getOrderList() { 
        $db = Db::getConnection();
        $query = 'SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC';
        $result = $db->query($query);
        $ordersList = array();
        
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        
        return $ordersList;
    }
    
    public static function getStatustext($status) { 
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }
    
     public static function getOrderById($id) {
        $db = Db::getConnection();
        $query = 'SELECT * FROM product_order WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }

     public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status) {
        $db = Db::getConnection();
        $query = "UPDATE product_order 
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
     public static function deleteOrderById($id) {
        $db = Db::getConnection();
        $query = 'DELETE FROM product_order WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function getOrderByUserId($id) {
        $db = Db::getConnection();
        $ordersList = array();
        $query = 'SELECT * FROM product_order WHERE user_id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);      
        $result->execute();
        
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        
        return $ordersList;
    }
}
