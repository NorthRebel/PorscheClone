<?php include(ROOT . '/views/layouts/header.php'); ?>

    <main>
        <div class="container rad" id="TopMargin">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <?php if ($result): ?>
                        <div class="alert alert-success">
                            <p>Вы зарегистрированы!</p>
                        </div>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <?php foreach ($errors as $error): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="signup-form"><!--sign up form-->
                            <h2>Регистрация на сайте</h2>
                            <form action="#" method="post">
                                <input type="text" name="FirstName" placeholder="Имя" value="<?php echo $firstName; ?>"/>
                                <input type="text" name="LastName" placeholder="Фамилия" value="<?php echo $lastName; ?>"/>
                                <input type="text" name="Patronymic" placeholder="Отчество" value="<?php echo $patronymic; ?>"/>
                                <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                                <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                            </form>
                        </div><!--/sign up form-->

                    <?php endif; ?>

                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </main>

<?php include(ROOT . '/views/layouts/footer.php'); ?>