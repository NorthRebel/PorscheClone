<?php

class Photos
{
    public static function getPhotoByID($photoID)
    {
        $db = Db::getConnection();

        $photoParams = array();

        $qry = $db->prepare("SELECT bin_data, file_type FROM data_blobs WHERE id = ?");
        $qry->bindParam(1, $photoID);
        if ($qry->execute()){
            $photoParams = $qry->fetch(PDO::FETCH_ASSOC); //получение асоциативного массива
        }

        //задаем тип страницы
        header("Content-type: image/".$photoParams['file_type']);
        // И  передаем сам файл
        echo $photoParams['bin_data'];
    }

    public static function getRandomPhotoByType()
    {
        return true;
    }
}