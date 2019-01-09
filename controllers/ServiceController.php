<?php

    class ServiceController
    {
        public function actionIndex()
        {
            require_once(ROOT.'/views/service/index.php');
            return true;
        }
    }