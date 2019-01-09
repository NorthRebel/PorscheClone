<?php

class PhotosController
{    
    public function actionIndex($photoID)
    {
        Photos::getPhotoByID($photoID);
    }
}