<?php

class subModels
{
    //получение информации о моделях всех линееек
    public static function getSubModels()
    {
        $db = Db::getConnection();  //соединение с БД
        $subModels = array();
        $qry = $db->prepare("SELECT sm.id 'Id', md.Name 'ModelName', sm.Name 'SubModelName', "
            ."COUNT(sub.id) 'SubSubModelsCount' "
            ."FROM models_dict md  "
            ."INNER JOIN submodels_list sm ON (md.id = sm.Model_ID) "
            ."LEFT JOIN subsubmodels sub ON (sm.id = sub.SubModel_ID) "
            ."GROUP BY (sm.id)");
        if ($qry->execute())
        {
            $i = 0;
            while ($row = $qry->fetch())
            {
                $subModels[$i]['Id'] = $row['Id'];
                $subModels[$i]['ModelName'] = $row['ModelName'];
                $subModels[$i]['SubModelName'] = $row['SubModelName'];
                $subModels[$i]['SubSubModelsCount'] = $row['SubSubModelsCount'];
                $i++;
            }
        }
        return $subModels;
    }

    //создание новой модели
    public static function createNewModel($modelName, $modelLineID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $qry = $db->prepare("INSERT INTO submodels_list (Model_ID, Name) "
            ."VALUES (:modelID, :modelName)");
        $qry->bindParam(':modelID', $modelLineID, PDO::PARAM_INT);
        $qry->bindParam(':modelName', $modelName, PDO::PARAM_STR);
        return $qry->execute();
    }


    //проверка дублирования названия линейки модели
    public static function checkNameModelExists($modelName, $modelLineID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM submodels_list WHERE (Model_ID = :modelID) AND (Name = :modelName)';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':modelID', $modelLineID, PDO::PARAM_INT);
        $result->bindParam(':modelName', $modelName, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

}