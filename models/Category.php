<?php

class Category {

    public static function getCategories() {
        $db = Db::getConnection();
        $categoryList = array();
        $query = 'Select id, name FROM category WHERE status = 1 ORDER BY sort_order';
        $result = $db->query($query);

        $id = 0;
        while ($row = $result->fetch()) {
            $categoryList[$id]['id'] = $row['id'];
            $categoryList[$id]['name'] = $row['name'];
            $id++;
        }
        return $categoryList;
    }

    public static function getCategoriesListAdmin() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    public static function createCategory($options) {

        $db = Db::getConnection();

        $query = 'INSERT INTO category '
                . '(name, sort_order, status) '
                . 'VALUES '
                . '(:name, :sort_order, :status)';
        $result = $db->prepare($query);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getCategoryById($id) {
        $db = Db::getConnection();

        $query = 'SELECT * FROM category WHERE id = :id ORDER BY sort_order ASC';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
         $result->setFetchMode(PDO::FETCH_ASSOC);
         $result->execute();
         return $result->fetch();
         
    }
    
    public static function updateCategoryById($id, $options) { 
        $db = Db::getConnection();
         $query = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        $result = $db->prepare($query);
         $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
    
     public static function deleteCategoryById($id) {
        $db = Db::getConnection();

        $query = 'DELETE FROM category WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
