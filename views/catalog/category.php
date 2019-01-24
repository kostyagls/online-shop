<?php include ROOT . '/views/layouts/header.php'; ?>     
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $item): ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/online_shop/category/<?php echo $item['id']; ?>"
                                           class="<?php if ($categoryId == $item['id']) echo 'active'; ?>"
                                           >
                                            <?php echo $item['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php foreach ($categoriesProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" height="200" />
                                        <h2><?php echo $product['price']; ?>$</h2>
                                        <p>
                                            <a href="/online_shop/product/<?php echo $product['id']; ?>">
                                             <?php echo $product['id']; ?> <?php echo $product['name']; ?>
                                            </a>
                                        </p>
                                        <a href="/online_shop/cart/add/<?php echo $product['id']; ?>"  data-id="<?php echo $product['id']; ?>"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/online_shop/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php echo $pagination->get(); ?>


                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
