<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

<main>
    <div class="container" id="TopMargin">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin/models">Линейки моделей</a></li>
                <li class="active">Удаление линейки <?php echo $selectedModel; ?></li>
            </ol>
        </div>
    </div>

    <?php if ($result): ?>
        <div class="container">
            <div class="alert alert-info">
                <p>Линейка моделей успешно удалена!</p>
            </div>
        </div>
    <?php else: ?>
    <?php if (isset($fatalErrors) && is_array($fatalErrors)): ?>
        <div class="container marginTop">
            <?php foreach ($fatalErrors as $error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="container rad">
            <h2>Удаление линейки <?php echo $selectedModel; ?></h2>
            <hr class="divider">
            <div class="row row-flex">
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12 inner">
                    <h4>Линейка включает в себя</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><?php echo count($submodels); ?> моделей</li>
                        <li class="list-group-item"><?php echo $modCount; ?> модификаций</li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12 inner">
                    <form action="" method="post">
                    <div class="panel panel-primary" style="margin-top: 10px;">
                        <div class="panel-heading">Типы удаляемых изображений</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="photosCarousel" class="form-check-input">
                                            Карусели
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="photosTab" class="form-check-input">
                                            Вкладки
                                        </label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="photosPreview" class="form-check-input">
                                            Превью
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <small id="deletePhotosHelp" class="form-text text-muted">Отметьте виды изображений, которые следует удалить</small>
                        </div>
                        <div class="row inputs">
                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                                <label class="form-check-label">
                                    <input type="checkbox" name="backup" class="form-check-input" checked>
                                    Резервная копия
                                </label>
                                <br>
                                <small id="backupHelp" class="form-text text-muted">Не рекомендуется отключать бэкап данных, так как пользователи потеряют записи из истрорий заказов</small>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" name="submit" class="btn btn-danger">Удалить</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if (!isset($submodels) || count($submodels) === 0): ?>
            <div class="container" id="TopMargin">
                <div class="alert alert-info">
                    <p>Отсутсвуют модели удаляемой линейки</p>
                </div>
            </div>
        <?php else: ?>
            <div class="container rad" style="padding-bottom: 20px; ">
                <h2>Модели, которые будут удалены вместе с линейкой <?php echo $selectedModel; ?></h2>
                <hr class="divider">
                <?php foreach ($submodels as $key=>$value): ?>
                    <div class="rad" style="background: #EECFA1;">
                        <a href="/models/<?php echo $selectedModel; ?>/<?php echo(str_replace( ' ','_',$value['Name'])); ?>">
                            <button type="button" class="btn btn-primary" style="margin-top: 20px; margin-left: 10px; "><?php echo($selectedModel.' '.$value['Name']);?> Модели <span class="badge"><?php echo count($value['SubModels']); ?></span></button>
                        </a>
                        <div class="row" style="margin-top: 20px; margin-left: 10px;">
                            <?php foreach ($value['SubModels'] as $subKey=>$subValue): ?>
                                <?php
                                $columns = array(
                                    'lg' => 6,
                                    'md' => 6,
                                    'sm' => 6,
                                    'xs' => 12,
                                );
                                if (count($value['SubModels']) === 3)
                                {
                                    $columns['lg'] = 4;
                                    $columns['md'] = 4;
                                }
                                if (count($value['SubModels']) >= 4)
                                {
                                    $columns['lg'] = 3;
                                    $columns['md'] = 3;
                                }
                                ?>
                                <div class="col-lg-<?php echo $columns['lg']; ?> col-md-<?php echo $columns['md']; ?> col-sm-<?php echo $columns['sm']; ?> col-xs-<?php echo $columns['xs']; ?>">
                                    <a href="/models/<?php echo $selectedModel; ?>/<?php echo $value['Name']; ?>/<?php echo str_replace(' ','_',$subValue['SubName']); ?>" class="modelItem">
                                        <img src="/photos/<?php echo $subValue['PhotoID']; ?>">
                                        <p><?php echo($selectedModel.' '.$value['Name'].' '.$subValue['SubName']); ?></p>
                                        <p>от <?php echo $subValue['Price']; ?> руб. вкл. НДС</p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
</main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>