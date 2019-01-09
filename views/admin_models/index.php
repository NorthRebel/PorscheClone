<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

<main>

    <div class="container" id="TopMargin">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="active">Линейки моделей</li>
            </ol>
        </div>
    </div>

    <div class="container rad">
        <h2>Линейки моделей</h2>
        <hr class="divider">
        <a href="/admin/models/create/" style="margin-top: 20px;">
            <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить линейку</button>
        </a>
        <?php if (!isset($modelsLines) || count($modelsLines) === 0): ?>
            <div class="alert alert-danger">
                <p>Отсутсвуют записи линеек моделей</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th scope="col">Код линейки</th>
                    <th scope="col">Название линейки</th>
                    <th scope="col">Кол-во моделей</th>
                    <th scope="col">Кол-во модификаций</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($row = 0; $row < count($modelsLines); $row++): ?>
                    <tr>
                        <td><?php echo $modelsLines[$row]['Id']?></td>
                        <td><?php echo $modelsLines[$row]['Name']?></td>
                        <td><?php echo $modelsLines[$row]['SubModelsCount']?></td>
                        <td><?php echo $modelsLines[$row]['SubSubModelsCount']?></td>
                        <td><a href="/admin/models/view/<?php echo $modelsLines[$row]['Name']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/models/update/<?php echo $modelsLines[$row]['Id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/models/delete/<?php echo $modelsLines[$row]['Id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>
