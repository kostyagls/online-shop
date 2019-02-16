<?php

class CatalogController {
    
    public function actionIndex( $page = 1) {
        $categories = Category::getCategories();
        $productList = Product::getLatestProducts(Product::SHOW_BY_DEFAULT, $page);
        $total = Product::getTotalProducts();
         $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT.'/views/catalog/index.php';
        return true;
    }
    
    public function actionCategory($categoryId, $page = 1) {
        $categories = Category::getCategories();
        $categoriesProducts = Product::getProductsListByCategory($categoryId, $page);
        $total = Product::getTotalProductsInCategory($categoryId);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT.'/views/catalog/category.php';
        return true;
    }
}