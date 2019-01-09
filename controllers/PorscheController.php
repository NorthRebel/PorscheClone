<?php

    include_once (ROOT.'/models/porsche.php');

    class PorscheController
    {
        public function actionIndex()
        {
            $carouselPhotosList = porsche::getMainCarousel();
            $modelsRowList = porsche::getModelsRow();

            require_once(ROOT.'/views/porsche/index.php');
            return true;
        }

    }