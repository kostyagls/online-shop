<?php
 
class Product {

    const SHOW_BY_DEFAULT = 3;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1) {
        $count = intval($count);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = DB::getConnection();
        $productList = array();
        $query = 'SELECT id, name, price, is_new, image FROM product '
                . 'WHERE status = 1 ORDER BY id DESC' 
                . ' LIMIT :count  OFFSET :offset';
        $result = $db->prepare($query);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();
        
        $i = 0;
        while ($row = $result->fetch()) {
            $productList [$i]['id'] = $row['id'];
            $productList [$i]['name'] = $row['name'];
            $productList [$i]['price'] = $row['price'];
            $productList [$i]['is_new'] = $row['is_new'];
            $productList [$i]['image'] = $row['image'];
            $i++;
        }

        return $productList;
    }

    public static function getProductsListByCategory($categoryId, $page = 1) {
        $categoryId = intval($categoryId);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $productByIdList = array();
        $query = 'SELECT id, name, price, is_new, image FROM product '
                . 'WHERE category_id = :categoryId AND status = 1 ORDER BY id DESC '
                . 'LIMIT ' . self::SHOW_BY_DEFAULT . ' OFFSET :offset';
        $result = $db->prepare($query);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        while ($row = $result->fetch()) {
            $productByIdList[$i]['id'] = $row['id'];
            $productByIdList[$i]['name'] = $row['name'];
            $productByIdList[$i]['price'] = $row['price'];
            $productByIdList[$i]['is_new'] = $row['is_new'];
            $productByIdList[$i]['image'] = $row['image'];
            $i++;
        }
        
        return $productByIdList;
    }

    public static function getProductsById($id) {
        $id = intval($id);
        $db = Db::getConnection();
        $query = 'SELECT * FROM product WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC); // виведенння масиву за назвами полів
        $product = $result->fetch();
        
        return $product;
    }

    public static function getTotalProductsInCategory($categoryId) {
        $db = Db::getConnection();
        $query = 'SELECT count(id) AS count FROM product WHERE status = 1 AND '
                . 'category_id = :categoryId';
        $result = $db->prepare($query);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC); // виведенння масиву за назвами полів
        $row = $result->fetch();
        
        return $total = $row['count'];
    }

    public static function getTotalProducts() {
        $db = Db::getConnection();
        $query = 'SELECT count(id) AS count FROM product WHERE status = 1';
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_ASSOC); // виведенння масиву за назвами полів
        $row = $result->fetch();
        
        return $total = $row['count'];
    }

    public static function getProductsByIds($productsIds) {
        $db = Db::getConnection();
        $products = array();
        $idString = implode(',', $productsIds);
        $query = "SELECT * FROM product where status = 1 AND id IN ($idString)";
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_ASSOC); // виведенння масиву за назвами полів

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }

    public static function getRecommendedProducts() {
        $db = Db::getConnection();
        $recommendedProducts = array();
        $query = 'SELECT id, name, price, image, is_new FROM product '
                . 'WHERE is_recommended = 1 AND status = 1';
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $recommendedProducts[$i]['id'] = $row['id'];
            $recommendedProducts[$i]['name'] = $row['name'];
            $recommendedProducts[$i]['image'] = $row['image'];
            $recommendedProducts[$i]['price'] = $row['price'];
            $recommendedProducts[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        
        return $recommendedProducts;
    }

    public static function getProductsList() {
        $db = Db::getConnection();
        $productList = array();
        $query = 'SELECT id, name, price, code FROM product';
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['code'] = $row['code'];
            $i++;
        }
        
        return $productList;
    }

    public static function deleteProductById($id) {
        $db = Db::getConnection();
        $query = 'DELETE FROM product WHERE id = :id';
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }

    public static function createProducts($options) {
        $db = Db::getConnection();
        $query = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';
        $result = $db->prepare($query);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        if($result->execute()) { 
            return $db->lastInsertId();
        }
        
        return 0;
    }
    
    public static function updateProductById($id, $options) {
        $db = Db::getConnection();
         $sql = 'UPDATE product SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function getImage($id){
        $noImage = 'no-image.jpg';
        $path = '/online_shop/upload/images/products/';
        $pathToProductImage = $path . $id . '.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) { 
             // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        
        return $path.$noImage;
    }
}
