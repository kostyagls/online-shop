<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1> Кабинет пользователя </h1>
            <h3> Hi, <?php echo $user['name']; ?></h3>
            <ul> 
                <li> <a href="/online_shop/cabinet/edit/" > Редактировать данные</a></li>
                <li> <a href="/online_shop/cabinet/history/" >Список покупок</a></li>  
                <?php if( (AdminBase::checkAdminWithoutDie() ) == TRUE): ?>
                <li> <a href="/online_shop/admin/" >Меню администратора</a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>