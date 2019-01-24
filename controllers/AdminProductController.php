<?php

class AdminProductController extends AdminBase {

    public function actionIndex() {

        self::checkAdmin();

        $productsList = Product::getProductsList();
        require_once ROOT . '/views/admin_product/index.php';
        return TRUE;
    }

    public function actionDelete($id) {

        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);

            header('Location: /online_shop/admin/product');
        }

        require_once ROOT . '/views/admin_product/delete.php';
        return true;
    }

    public function actionCreate() {

        self::checkAdmin();
        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {

            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
           
            $errors = FALSE;
           
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните поля';
            }

            if ($errors == FALSE) {
                $id = Product::createProducts($options);


                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/online_shop/upload/images/products/{$id}.jpg");
                    }
                }

                header("Location: /online_shop/admin/product");
            }
        }
        require_once ROOT . '/views/admin_product/create.php';
        return TRUE;
    }

    public function actionUpdate($id) {
        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();
        $productById = Product::getProductsById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = FALSE;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните поля';
            }

            if ($errors == FALSE) {

                if (Product::updateProductById($id, $options)) {

                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/online_shop/upload/images/products/{$id}.jpg");
                    }
                }


                header("Location: /online_shop/admin/product");
            }
        }


        require_once ROOT . '/views/admin_product/update.php';
        return TRUE;
    }

}
