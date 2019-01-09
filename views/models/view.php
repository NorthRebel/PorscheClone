<?php include(ROOT . '/views/layouts/header.php'); ?>

<main>
    <?php if (isset($errors) && is_array($errors)): ?>
        <div class="container marginTop">
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
    <div class="container ">
        <div class="row round carousel  slide marginTop" id="ModelCar">
            <div class=" carousel slide" data-interval="3000" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php foreach ($carouselPhotos as $CaroselKey => $CarouselItem): ?>
                        <?php if ($CaroselKey === 0): ?>
                            <li data-target="#ModelCar" data-slide-to="<?php echo $CaroselKey; ?>" class="active"></li>
                        <?php else: ?>
                            <li data-target="#ModelCar" data-slide-to="<?php echo $CaroselKey; ?>"></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php foreach ($carouselPhotos

                    as $CaroselKey => $CarouselItem): ?>

                    <?php if ($CaroselKey === 0): ?>
                    <div class="item active">
                        <?php else: ?>
                        <div class="item">
                            <?php endif; ?>
                            <img src="/photos/<?php echo $CarouselItem['PhotoID']; ?>">
                            <div class="carousel-caption">
                                <h3><?php echo $CarouselItem['description']; ?></h3>
                                <p><?php echo $CarouselItem['subDescription']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#ModelCar" data-slide="prev">
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#ModelCar" data-slide="next">
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container round" id="ModelsTabs">
            <?php if (isset($errors) && is_array($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($succsess) && is_array($succsess)): ?>
                <?php foreach ($succsess as $succ): ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="tabs">
                <!-- Основной контейнер -->
                <ul class="nav nav-tabs">
                    <?php foreach ($modelTabs as $tabKey => $tabItem): ?>
                        <?php if ($tabKey === 0): ?>
                            <li class="active">
                            <a href="#InitialModel" data-toggle="tab" id="InitialModelTab">
                        <?php else: ?>
                            <li>
                            <a href="#<?php echo(str_replace(array('', ' '), '_', $tabItem['SubSubModelsListName'])); ?>" data-toggle="tab" id="<?php echo(str_replace(array('', ' '), '_', $tabItem['SubSubModelsListName'])); ?>Tab">
                        <?php endif; ?>

                        <img src="/photos/<?php echo $tabItem['PhotoID']; ?>">
                        <p><?php echo $tabItem['ModelsListName'] . ' ' . $tabItem['SubModelsListName'] . ' ' . $tabItem['SubSubModelsListName']; ?></p>
                        <p>от <?php echo $tabItem['Price']; ?> руб. вкл. НДС</p>
                        </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Содержимое вкладок -->
                <div class="tab-content">
                    <?php foreach ($modelTabs as $tabKey => $tabItem): ?>
                    <?php if ($tabKey === 0): ?>
                    <div class="tab-pane active" id="InitialModel">
                        <?php else: ?>
                        <div class="tab-pane"
                             id="<?php echo(str_replace(array('', ' '), '_', $tabItem['SubSubModelsListName'])); ?>">
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <h1><?php echo $tabItem['ModelsListName'] . ' ' . $tabItem['SubModelsListName'] . ' ' . $tabItem['SubSubModelsListName']; ?></h1>
                                    <p>от <?php echo $tabItem['Price']; ?> руб. вкл. НДС</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <button class="btn btn-success btn-lg" style=" margin-top: 20px;  width: 100%; "
                                            onclick='location.href="#selectModelTrans";'>Перейти к покупке
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-1">
                                    <h3><?php echo $tabItem['Params']['primaryParams']['kWt']; ?> кВт
                                        (<?php echo $tabItem['Params']['primaryParams']['HP']; ?> л.с.)</h3>
                                    <p>Мощность</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-1">
                                    <div id="line"></div>
                                    <h3><?php
                                        foreach ($tabItem['Params']['secondaryParams'] as $speedKey => $speedValue) {
                                            if ($speedKey > 0) {
                                                echo $speedValue['Acceleration'];
                                                break;
                                            }
                                        }
                                        ?>
                                        с
                                    </h3>
                                    <p>Разгон 0-100 км/ч</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-2">
                                    <h3><?php echo $tabItem['Params']['primaryParams']['Drive']; ?></h3>
                                    <p>Привод</p>
                                </div>
                            </div>
                            <div id="Prev<?php echo $tabKey; ?>" class="carousel  slide round" data-ride="carousel"
                                 data-interval="3000">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php foreach ($tabItem['Params']['PhotoIDs'] as $PreviewKey => $PreviewItem): ?>
                                        <?php if ($PreviewKey === 0): ?>
                                            <li data-target="#Prev<?php echo $tabKey; ?>"
                                                data-slide-to="<?php echo $PreviewKey; ?>" class="active"></li>
                                        <?php else: ?>
                                            <li data-target="#Prev<?php echo $tabKey; ?>"
                                                data-slide-to="<?php echo $PreviewKey; ?>"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php foreach ($tabItem['Params']['PhotoIDs'] as $PreviewKey => $PreviewItem): ?>
                                        <?php if ($PreviewKey === 0): ?>
                                            <div class="item active">
                                                <img src="/photos/<?php echo $PreviewItem; ?>">
                                            </div>
                                        <?php else: ?>
                                            <div class="item">
                                                <img src="/photos/<?php echo $PreviewItem; ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#Prev<?php echo $tabKey; ?>" data-slide="prev">
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#Prev<?php echo $tabKey; ?>" data-slide="next">
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div>
                                <h2 style="text-align: center;">Технические характеристики</h2>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead id="thcol">
                                        <tr>
                                            <th></th>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $transKey => $transValue): ?>
                                                <th><?php echo $transValue['TransmissionName']; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><b>Мощность</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $transKey => $transValue): ?>
                                                <td><?php echo $tabItem['Params']['primaryParams']['kWt']; ?> кВт
                                                    (<?php echo $tabItem['Params']['primaryParams']['HP']; ?> л.с.)
                                                    при <?php echo $tabItem['Params']['primaryParams']['Engine_Speed']; ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Разгон 0-100 км/ч</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $AccelerationKey => $AccelerationValue): ?>
                                                <td><?php echo $AccelerationValue['Acceleration']; ?> сек.</td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Максимальная скорость</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $MaxSpeedKey => $MaxSpeedValue): ?>
                                                <td><?php echo $MaxSpeedValue['Max_Speed']; ?> км/ч</td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Потребление топлива</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $ConsumptionKey => $ConsumptionValue): ?>
                                                <td><?php echo $ConsumptionValue['Fuel_Consumption']; ?> л/100 км</td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Выброс CO2</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $coKey => $coValue): ?>
                                                <td><?php echo $coValue['CO_Ejection']; ?> г/км</td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Цена</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $priceKey => $priceValue): ?>
                                                <td>от <?php echo $priceValue['Price']; ?> руб. вкл. НДС</td>
                                            <?php endforeach; ?>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <form action="" method="post" id="selectModelTrans">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td><b>Выберите вид КПП</b></td>
                                            <?php foreach ($tabItem['Params']['secondaryParams'] as $transKey => $transValue): ?>
                                                <td>
                                                    <label>
                                                        <input class="form-check-input" type="radio"
                                                               name="transmissionSelect"
                                                               id="transmission" required
                                                               value="<?php echo $transValue['TransmissionID']; ?>">
                                                    </label>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <input type="text" hidden name="modelSelect" value="<?php echo $tabItem['SubSubmodelID']; ?>"/>
                                    <div class="row">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <button type="submit" name="submit" class="btn btn-success btn-lg">
                                                Оформить заказ
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php include(ROOT . '/views/layouts/footer.php'); ?>
