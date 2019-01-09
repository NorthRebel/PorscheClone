<?php include(ROOT.'/views/layouts/header.php'); ?>

<main>
    <div id="TopMargin">
        <div class="container" id="myCarousel">
            <img src="/template/images/feedback/main.jpg" class="img-responsive img-rounded">
        </div>
    </div>

    <div class="container rad">
        <h1>Написать письмо</h1>
        <hr class="divider">
        <?php if ($result): ?>
            <p>Сообщение успешно отправлено!</p>
        <?php else: ?>
        <?php if (isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="form-center">
            <form action="#" method="post">
                <?php if (User::isGuest()): ?>
                <div class="row">
                    <label for="mail">E-Mail <span class="req">*</span></label>
                    <input type="text" id="mail" name="mail" class="form-control" maxlength="50" tabindex="1" placeholder="Ваш e-mail для ответа" required value="<?php echo $mail; ?>">
                </div>
                <div class="row">
                    <label for="fio">ФИО <span class="req">*</span></label>
                    <input type="text" id="fio" name="fio" class="form-control" maxlength="100" tabindex="2" placeholder="ФИО" required value="<?php echo $fio; ?>">
                </div>
                <?php endif; ?>
                <div class="row">
                    <label for="subject">Тема <span class="req">*</span></label>
                    <input type="text" id="subject" name="theme" class="form-control" maxlength="50" tabindex="3" placeholder="Тема письма" required value="<?php echo $theme; ?>">
                </div>

                <div class="row">
                    <label for="message">Сообщение <span class="req">*</span></label>
                    <textarea id="message" name="message" class="form-control" tabindex="4" maxlength="500" placeholder="Введите содержание сообщения" required value="<?php echo $message; ?>"></textarea>
                </div>
                <div class="submit-button">
                    <input type="submit" id="submitbtn" name="submit" class="btn btn-success" tabindex="5" value="Отправить Сообщение">
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include(ROOT.'/views/layouts/footer.php'); ?>
