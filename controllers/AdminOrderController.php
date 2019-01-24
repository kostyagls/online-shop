<?php

class AdminOrderController extends AdminBase {

    public function actionIndex() {
        self::checkAdmin();

        $ordersList = Order::getOrderList();

        require_once ROOT . '/views/admin_order/index.php';
        return TRUE;
    }

    public function actionUpdate($id) {
        self::checkAdmin();
        $order = Order::getOrderById($id);
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            // Сохраняем изменения
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);
            // Перенаправляем пользователя на страницу управлениями заказами
//            header("Location: /admin/order/view/$id");
            header("Location: /online_shop/admin/order");
        }
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }
    
    public function actionDelete($id) { 
        self::checkAdmin();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::deleteOrderById($id);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /online_shop/admin/order");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    
    }
    public function actionView($id) { 
        self::checkAdmin();
        
        $order = Order::getOrderById($id);
        
        $productsQuantity = json_decode($order['products'], true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);
        
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

}
