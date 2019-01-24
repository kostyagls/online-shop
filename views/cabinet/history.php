<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/online_shop/cabinet">Личный кабинет</a></li>
                    <li class="active">История заказов</li>
                </ol>
            </div>

            <h4>Список заказов</h4>

            <br/>
            <?php if(empty($orderHistory)): ?>
            <h3>Список заказов пуст!</h3>
            <?php else: ?> 
       
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th></th>
                </tr>
                <?php foreach ($orderHistory as $order): ?>
                    <tr>
                        <td>
                            <a href="/online_shop/admin/order/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?> 
                            </a>
                        </td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo $order['date']; ?></td>  
                        <td><a href="/online_shop/cabinet/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>