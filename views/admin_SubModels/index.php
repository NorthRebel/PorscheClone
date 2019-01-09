<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

<main>

    <div class="container" id="TopMargin">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="active">Модели</li>
            </ol>
        </div>
    </div>

    <div class="container rad">
        <h2>Модели</h2>
        <hr class="divider">

        <?php if (!isset($modelsLines) || count($modelsLines) === 0): ?>
            <div class="alert alert-danger">
                <p>Отсутсвуют записи линеек моделей</p>
            </div>
        <?php else: ?>
            <a href="/admin/submodels/create/" style="margin-top: 20px;">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить модель</button>
            </a>
        <?php if (!isset($subModels) || count($subModels) === 0): ?>
            <div class="alert alert-danger" style="margin-top: 20px; ">
                <p>Отсутсвуют записи моделей</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th scope="col">Код Модели</th>
                    <th scope="col">Название линейки</th>
                    <th scope="col">Название модели</th>
                    <th scope="col">Кол-во модификаций</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($row = 0; $row < count($subModels); $row++): ?>
                    <tr>
                        <td><?php echo $subModels[$row]['Id'] ?></td>
                        <td><?php echo $subModels[$row]['ModelName'] ?></td>
                        <td><?php echo $subModels[$row]['SubModelName'] ?></td>
                        <td><?php echo $subModels[$row]['SubSubModelsCount'] ?></td>s
                        <td><a href="/admin/submodels/view/<?php echo $subModels[$row]['Id']; ?>" title="Смотреть"><i
                                        class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/submodels/update/<?php echo $subModels[$row]['Id']; ?>"
                               title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/submodels/delete/<?php echo $subModels[$row]['Id']; ?>" title="Удалить"><i
                                        class="fa fa-times"></i></a></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>
