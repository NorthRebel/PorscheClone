<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

<main>
    <div class="container" id="TopMargin">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin/models">Линейки моделей</a></li>
                <li class="active">Создание новой линейки</li>
            </ol>
        </div>
    </div>

    <div class="container rad">
        <h2>Создание новой линейки</h2>
        <hr class="divider">
        <?php if ($result): ?>
            <div class="alert alert-success">
                <p>Линейка моделей успешно создана!</p>
            </div>
        <?php else: ?>
            <?php if (isset($errors) && is_array($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-center">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="mail">Название линейки <span class="req">*</span></label>
                        <input type="text" id="mail" name="LineName" class="form-control" maxlength="255" tabindex="1"
                               placeholder="Введите название линейки" required value="">
                        <small id="emailHelp" class="form-text text-muted">Название линейки является уникальным</small>
                    </div>
                    <div class="submit-button">
                        <input type="submit" id="submitbtn" name="submit" class="btn btn-success" tabindex="5"
                               value="Создать">
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>
