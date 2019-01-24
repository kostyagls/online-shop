<?php

class Order {

//    public static function save($userName, $userPhone, $userComment, $userId, $productsInCart) {
//
//        $productsInCart = json_encode($productsInCart);
//        var_dump($productsInCart);
//        $db = Db::getConnection();
//        $query = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
//                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
//
//        $result = $db->prepare($query);
//     
//        $result->bindParam(':user_name', $userName,  PDO::PARAM_STR);
//        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
//        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
//        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
//        $result->bindParam(':products', $productsInCart, PDO::PARAM_STR);
//        var_dump($result);
//        $op = $result->execute();
//        var_dump($op);
//        return $op;
//    }

 public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);
        $db = Db::getConnection();
          $sql = "INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) "
                . "VALUES (:userName, :userPhone, :userComment, :userId, :products)";

        $result = $db->prepare($sql);
  
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        $finish = $result->execute();
        return $finish;
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
    
     public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполняем запрос
        $result->execute();
        // Возвращаем данные
        return $result->fetch();
    }

     public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    
     public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM product_order WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function getOrderByUserId($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE user_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполняем запрос
        $result->execute();
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
}
