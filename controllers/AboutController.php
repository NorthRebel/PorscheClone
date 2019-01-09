<?php

    class AboutController
    {
        public function actionIndex($page = null)
        {
            if ($page === null)
            {
                require_once(ROOT.'/views/about/index.php');
            }            
            else
            {
                require_once(ROOT."/views/about/$page.php");
            }
            return true;
        }
        
    }
