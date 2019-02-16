<?php

class SiteController {

    public function actionIndex() {
        $categories = Category::getCategories();
        $productList = Product::getLatestProducts(6);
        $recommendedProduct = Product::getRecommendedProducts();

        require_once ROOT . '/views/site/index.php';
        return true;
    }

    public static function actionContact() {
        $result = FALSE;
        
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            $errors = FALSE;

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == FALSE) {
                $adminEmail = 'kgmerlin777@gmail.com';
                $message = "Текст: {$userText}. Oт {$userEmail} ";
                $subject = "Тема письма";
//                $result = mail($adminEmail, $subject, $message);
                $result = TRUE;
            }
        }
        
        require_once ROOT . '/views/site/contact.php';
        return true;
    }

    public function actionAbout() {
        require_once ROOT . '/views/site/about.php';
        
        return true;
    }
}
