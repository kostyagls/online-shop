<?php
include ROOT.'/models/Product.php';
include ROOT.'/models/Category.php';

class ProductController {
    
    public function actionView($id) {
//        $productList = Product::getLatestProducts();
        $categories = Category::getCategories();
        $productsById = Product::getProductsById($id);
      

        require_once ROOT.'/views/product/view.php';
        return true;
    }
    
    
    
}