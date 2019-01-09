<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

<main>
    <div class="container" id="TopMargin">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin/submodels">Модели</a></li>
                <li class="active">Создание новой модели</li>
            </ol>
        </div>
    </div>

    <div class="container rad">
        <h2>Создание новой модели</h2>
        <hr class="divider">
        <?php if (!isset($modelsLines) || count($modelsLines) === 0): ?>
            <div class="alert alert-danger">
                <p>Отсутсвуют записи линеек моделей</p>
            </div>
        <?php else: ?>
        <?php if ($result): ?>
            <div class="alert alert-success">
                <p>Модель линейки успешно создана!</p>
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
                        <div class="form-group">
                            <label for="modelsNames">Модельный ряд</label>
                            <select class="form-control" id="modelsNames" name="modelsNames" required>
                                <?php foreach ($modelsLines as $key=>$value): ?>
                                <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <label for="mail">Наименование модели <span class="req">*</span></label>
                        <input type="text" id="mail" name="subModelName" class="form-control" maxlength="255" tabindex="1"
                               placeholder="Введите наименование модели" required value="">
                        <small id="emailHelp" class="form-text text-muted">Наименование модели является уникальным в контексте модельного ряда</small>
                    </div>
                    <div class="submit-button">
                        <input type="submit" id="submitbtn" name="submit" class="btn btn-success" tabindex="5"
                               value="Создать">
                    </div>
                </form>
            </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>
