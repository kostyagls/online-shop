<?php

class AdminCategoryController extends AdminBase {

    public function actionIndex() {
        self::checkAdmin();
        
        $categoriesList = Category::getCategoriesListAdmin();
        
        require_once ROOT.'/views/admin_category/index.php';
        return TRUE;
    }
    
    public function actionCreate() { 
        self::checkAdmin();
        
        if(isset($_POST['submit'])) { 
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            
             $errors = FALSE;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните поля';
            }
            
            if ($errors == FALSE) { 
                Category::createCategory($options);
                header("Location: /online_shop/admin/category");
            }
               
        }
        
        require_once ROOT.'/views/admin_category/create.php';
        return TRUE;
    }
    
    public function actionUpdate($id) { 
        self::checkAdmin();
        
        $category = Category::getCategoryById($id);
        
        if (isset($_POST['submit'])) { 
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            $errors = FALSE;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните поля';
            }
            
             if ($errors == FALSE) { 
                Category::updateCategoryById($id, $options);
                header("Location: /online_shop/admin/category");
            }   
        }
        require_once ROOT.'/views/admin_category/update.php';
        return TRUE;
    }
    
    public function actionDelete($id) {
        self::checkAdmin();
        
        if (isset($_POST['submit'])) { 
            Category::deleteCategoryById($id);
            
            header("Location: /online_shop/admin/category");
        }
        
        require_once ROOT.'/views/admin_category/delete.php';
        return TRUE;
    }

}
