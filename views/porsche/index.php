<?php include(ROOT.'/views/layouts/header.php'); ?>
<main>
    <div class="container">
        <div class="row round carousel slide marginTop" id="mainCarousel">
            <div class=" carousel slide" data-interval="3000" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php foreach($carouselPhotosList as $CaroselKey=>$CarouselItem): ?>
                        <?php if ($CaroselKey === 0): ?>
                            <li data-target="#mainCarousel" data-slide-to="<?php echo $CaroselKey; ?>" class="active"></li>
                        <?php else: ?>
                            <li data-target="#mainCarousel" data-slide-to="<?php echo $CaroselKey; ?>"></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php foreach($carouselPhotosList as $CaroselKey=>$CarouselItem): ?>
                    <?php if ($CaroselKey === 0): ?>
                    <div class="item active">
                        <?php else: ?>
                        <div class="item">
                            <?php endif; ?>
                            <img src="/photos/<?php echo $CarouselItem['PhotoID']; ?>">
                            <div class="carousel-caption">
                                <h3><?php echo $CarouselItem['Description']; ?></h3>
                                <p><?php echo $CarouselItem['subDescription']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#mainCarousel" data-slide="prev">
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#mainCarousel" data-slide="next">
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <p style="text-align: center; margin-top: 25px; color: #FFFFF; font-size: 22pt;">Модельный ряд</p>
        </div>
        <div class="row modlist">
            <div class="col-lg-1 col-md-1 hidden-xs hidden-sm"></div>

            <?php foreach($modelsRowList as $modelKey=>$modelItem): ?>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                    <img src="/photos/<?php echo $modelItem['PhotoID']; ?>" class="img-responsive">
                    <span><a href="/models/<?php echo $modelItem['Description']; ?>"><?php echo $modelItem['Description']; ?></a></span>
                </div>
            <?php endforeach; ?>
            <div class="col-lg-1 col-md-1 hidden-xs hidden-sm"></div>
        </div>
    </div>
</main>
<?php include(ROOT.'/views/layouts/footer.php'); ?>
