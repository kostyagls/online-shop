<?php include ROOT . '/views/layouts/header.php'; ?> 

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                       <?php foreach ($categories as $category): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="/online_shop/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></h4>
                            </div>
                        </div>
                       <?php endforeach; ?>
                    </div><!--/category-products-->
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php echo Product::getImage($productsById['id']); ?>" alt="" height="200" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if ($productsById['is_new']): ?>
                                <img src="/online_shop/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?php endif;?>
                                <h2><?php echo $productsById['name']?></h2>
                                <p>Код товара: <?php echo $productsById['code']?></p>
                                <span>
                                    <span>$<?php echo $productsById['price']?></span>
                                    <a href="#"  data-id="<?php echo $productsById['id']; ?>"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                </span>
                                <p><b>Наличие:</b> <?php if ($productsById['availability']): ?> В наличии <?php else: ?>Нет в наличии <?php endif;?> </p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?php echo $productsById['brand']?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p> <?php echo $productsById['description']; ?> </p>
                        </div>
                    </div>
                </div><!--/product-details-->
            </div>
        </div>
    </div>
</section>

<br/>
<br/>

<?php include ROOT . '/views/layouts/footer.php'; ?> 