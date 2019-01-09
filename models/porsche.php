<?php

class porsche
{
    public static function getMainCarousel()
    {
        $db = Db::getConnection();  //соединение с БД

        $photoIDsList = array();

        $qry = $db->prepare("SELECT dat.id 'PhotoID', dat.description 'Description', dat.subDescription 'subDescription' "
            ."FROM photos ph "
            ."INNER JOIN phototype pt ON (ph.PType_ID = pt.id) "
            ."INNER JOIN data_blobs dat ON (ph.Data_ID = dat.id) "
            ."WHERE (pt.Description = 'Main_Carousel')");

        $i=0;
        if ($qry->execute()){
            while($row = $qry->fetch())
            {
                $photoIDsList[$i]['PhotoID'] = $row['PhotoID'];
                $photoIDsList[$i]['Description'] = $row['Description'];
                $photoIDsList[$i]['subDescription'] = $row['subDescription'];
                $i++;
            }
        }

        return $photoIDsList;
    }

    public static function getModelsRow()
    {
        $db = Db::getConnection();  //соединение с БД

        $modelsRow = array();

        $qry = $db->prepare("SELECT dat.id 'PhotoID', dat.description 'Description' "
            ."FROM photos ph "
            ."INNER JOIN phototype pt ON (ph.PType_ID = pt.id) "
            ."INNER JOIN data_blobs dat ON (ph.Data_ID = dat.id) "
            ."WHERE (pt.Description = 'Main_Models_Row')");

        $i=0;
        if ($qry->execute()){
            while($row = $qry->fetch())
            {
                $modelsRow[$i]['PhotoID'] = $row['PhotoID'];
                $modelsRow[$i]['Description'] = $row['Description'];
                $i++;
            }
        }

        return $modelsRow;
    }
}