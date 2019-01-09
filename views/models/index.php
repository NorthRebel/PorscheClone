<?php include(ROOT.'/views/layouts/header.php'); ?>

<main>
    <?php foreach ($submodels as $key=>$value): ?>
        <div class="container rad" style="margin-top: 100px;">
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
</main>

<?php include(ROOT.'/views/layouts/footer.php'); ?>
