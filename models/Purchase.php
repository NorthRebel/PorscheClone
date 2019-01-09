<?php

class Purchase
{
    //добавление ковой покупки к текущему пользователю
    public static function ordering($userId, $subSubModelID, $transmissionID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $qry = $db->prepare("SELECT ch.id 'ID' "
                            ."FROM subsubmodels sub "
                            ."INNER JOIN characteristic ch ON (sub.id = ch.SubSubModel_ID) "
                            ."WHERE (sub.id = :subID) AND (ch.Transmission_ID = :transID)");
        $qry->bindParam(":subID",$subSubModelID,PDO::PARAM_INT);
        $qry->bindParam(":transID",$transmissionID,PDO::PARAM_INT);

        $statusID = 1;

        if ($qry->execute())
        {
            $Characteristic_ID = $qry->fetchColumn();   //код характеристики модели подмодели

            $insertRecord = $db->prepare("INSERT INTO purchases (Characteristic_ID, User_ID, Status_ID) "
                                        ."VALUES (:Characteristic_ID,:User_ID,:Status_ID)");
            $insertRecord->bindParam(":Characteristic_ID",$Characteristic_ID,PDO::PARAM_INT);
            $insertRecord->bindParam(":User_ID",$userId,PDO::PARAM_INT);
            $insertRecord->bindParam(":Status_ID",$statusID,PDO::PARAM_INT);
            return $insertRecord->execute();
        }
        else
        {
            return false;
        }
    }

    //получение истории заказов пользователя
    public static function getOrdersList($userId)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $qry = $db->prepare("SELECT pur.id 'TabNo',  DATE_FORMAT(pur.PurchaseDate, \"%d.%m.%Y\") 'PurchaseDate', "
                            ."ps.Name 'purchaseStatus', CONCAT(dct.Name,' ', lst.Name,' ', sub.Name) 'ModelName', dct.Name 'Mod', "
                            ."lst.Name 'Sub', tr.Name 'Transmission', ch.Price 'Price' "
                            ."FROM users usr "
                            ."INNER JOIN purchases pur ON (usr.id = pur.User_ID) "
                            ."INNER JOIN purchaseStatus ps ON (pur.Status_ID = ps.id) "
                            ."INNER JOIN characteristic ch ON (pur.Characteristic_ID = ch.id) "
                            ."INNER JOIN transmission tr ON (ch.Transmission_ID = tr.id) "
                            ."INNER JOIN subsubmodels sub ON (ch.SubSubModel_ID = sub.id) "
                            ."INNER JOIN submodels_list lst ON (sub.SubModel_ID = lst.id) "
                            ."INNER JOIN models_dict dct ON (lst.Model_ID = dct.id) "
                            ."WHERE (usr.id = :userID) "
                            ."ORDER BY (pur.id)");
        $qry->bindParam(":userID",$userId,PDO::PARAM_INT);  //передача кода текущего пользователя
        $odersList = array();

        if ($qry->execute())
        {
            $i = 0;
            while($row = $qry->fetch())
            {
                $odersList[$i]['TabNo'] = $row['TabNo'];
                $odersList[$i]['PurchaseDate'] = $row['PurchaseDate'];
                $odersList[$i]['purchaseStatus'] = $row['purchaseStatus'];
                $odersList[$i]['ModelName'] = $row['ModelName'];
                $odersList[$i]['Mod'] = $row['Mod'];
                $odersList[$i]['Sub'] = $row['Sub'];
                $odersList[$i]['Transmission'] = $row['Transmission'];
                $odersList[$i]['Price'] = $row['Price'];
                $i++;
            }

            return $odersList;
        }
        else
        {
            return false;
        }
    }
}