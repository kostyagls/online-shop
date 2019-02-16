<?php

class ProductController {
    
    public function actionView($id) {
        $categories = Category::getCategories();
        $productsById = Product::getProductsById($id);
        
        require_once ROOT.'/views/product/view.php';
        return true;
    }   
}