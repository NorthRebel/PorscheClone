<?php include(ROOT . '/views/layouts/header_admin.php'); ?>

    <main>
        <div class="container" id="TopMargin">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin/models">Линейки моделей</a></li>
                    <li class="active">Просмотр моделей линейки <?php echo $selectedModel; ?></li>
                </ol>
            </div>
        </div>

        <?php if (isset($fatalErrors) && is_array($fatalErrors)): ?>
            <div class="container marginTop">
                <?php foreach ($fatalErrors as $error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>

        <?php foreach ($submodels as $key=>$value): ?>
            <div class="container rad">
                <a href="/models/<?php echo $selectedModel; ?>/<?php echo(str_replace( ' ','_',$value['Name'])); ?>">
                    <button type="button" class="btn btn-primary" style="margin-top: 20px;"><?php echo($selectedModel.' '.$value['Name']);?> Модели <span class="badge"><?php echo count($value['SubModels']); ?></span></button>
                </a>
                <div class="row" style="margin-top: 20px;">
                    <?php foreach ($value['SubModels'] as $subKey=>$subValue): ?>
                        <?php
                        $columns = array(
                            'lg' => 6,
                            'md' => 6,
                            'sm' => 6,
                            'xs' => 6,
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
        <?php endif; ?>
    </main>

<?php include(ROOT . '/views/layouts/footer_admin.php'); ?>