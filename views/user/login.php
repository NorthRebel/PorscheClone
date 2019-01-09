<?php include(ROOT . '/views/layouts/header.php'); ?>

    <main>
        <div class="container rad" id="TopMargin">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <?php if (isset($errors) && is_array($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайт</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" value=""/>
                            <input type="password" name="password" placeholder="Пароль" value=""/>
                            <input type="submit" name="submit" class="btn btn-default" value="Вход"/>
                        </form>
                    </div><!--/sign up form-->

                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </main>

<?php include(ROOT . '/views/layouts/footer.php'); ?>