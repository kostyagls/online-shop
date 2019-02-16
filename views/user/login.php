<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if(isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li> -<?php echo $error; ?>
                         <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <div class="signup-form"><!--sign up form-->
                    <h2> Вход на сайт </h2> 
                    <form action="#" method="post"> 
                        <input type="email" name="email" placeholder="Email" value="" > 
                        <input type="password" name="password" placeholder="Пароль"value="" >
                        <input type="submit" name="submit" class="btn btn-default" value="Вход">  
                    </form>
                    <a href="/online_shop/user/register" class="btn btn-default">Регистрация</a>
                </div><!--/sign up form-->
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>








<?php include_once ROOT . '/views/layouts/footer.php'; ?>




