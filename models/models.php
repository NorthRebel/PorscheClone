<?php

class Models
{   
    public static function getAdvancedParams($subSubModelID)
    {
        $db = Db::getConnection();  //соединение с БД

        $primaryParams = array();  //первичные параметры модели подмодели

        $qry = $db->prepare("SELECT dr.name 'Drive', ssb.Power_kWt 'kWt', ssb.Power_HP 'HP', ssb.Engine_Speed 'Engine_Speed' ".
                            " FROM subsubmodels ssb INNER JOIN drive dr ON(ssb.Drive_ID = dr.id) "
                            ."WHERE (ssb.id = ?)");
        $qry->bindParam(1, $subSubModelID);    //передача кода модели подмодели
        if ($qry->execute()){
            $primaryParams = $qry->fetch(PDO::FETCH_ASSOC); //получение асоциативного массива
        }

        $transmisionsTypes = array();   //коробки выьранной модели

        $qry = $db->prepare("SELECT ch.id 'CharacteristicID', tr.Name 'TransmissionName', tr.id 'TransmissionID' "
                            ."FROM characteristic ch INNER JOIN transmission tr ON(ch.Transmission_ID = tr.id) "
                            ."WHERE ch.SubSubModel_ID = ?");
        $qry->bindParam(1, $subSubModelID);    //передача кода модели подмодели

        $i = 0;
        if ($qry->execute()){
            while($row = $qry->fetch())
            {
                $transmisionsTypes[$i]['CharacteristicID'] = $row['CharacteristicID'];
                $transmisionsTypes[$i]['TransmissionName'] = $row['TransmissionName'];
                $transmisionsTypes[$i]['TransmissionID'] = $row['TransmissionID'];
                $i++;
            }
        }

        $secondaryParams = array();

        foreach ($transmisionsTypes as $key=>$value) {
            $qry = $db->prepare("SELECT Acceleration,Max_Speed, Fuel_Consumption, CO_Ejection, Price "
                                ."FROM characteristic WHERE id = ?");
            $qry->bindParam(1, $value['CharacteristicID']);    //передача кода характеристик
            if ($qry->execute()) {
                $secondaryParams[$value['CharacteristicID']] = $qry->FETCH(PDO::FETCH_ASSOC);
                $secondaryParams[$value['CharacteristicID']] += ['TransmissionName'=> $value['TransmissionName']];
                $secondaryParams[$value['CharacteristicID']] += ['TransmissionID'=> $value['TransmissionID']];
            }
        }

        $photoIDs = array();    //фотографии карусели просмотра модели подмодели

        $qry = $db->prepare("SELECT ph.Data_ID 'PhotoID' "
            ."FROM photos ph INNER JOIN phototype pt ON(ph.PType_ID = pt.id) "
            ."WHERE (ph.SubSubModel_ID = ?) AND (pt.Description = 'Preview')");
        $qry->bindParam(1, $subSubModelID);    //передача кода модели подмодели

        $i = 0;
        if ($qry->execute()){
            while($row = $qry->fetch())
            {
                $photoIDs[$i] = $row['PhotoID'];
                $i++;
            }
        }

        $result = array(
            'primaryParams' => $primaryParams,
            'secondaryParams' => $secondaryParams,
            'PhotoIDs' => $photoIDs,
        );

        return $result;
    }
    //получение списка вкладок моделей подмоделей
    public static function getSubSubModelsTabs($model,$submodel)
    {
        $db = Db::getConnection();  //соединение с БД
        
        $modelsList = array();  //список вкладок моделей подмоделей         
        
        $stmt = $db->prepare("SELECT md.Name 'ModelsListName', sm.Name 'SubModelsListName', sb.Name 'SubSubModelsListName', "
                            ."sb.id 'SubSubmodelID', ch.Price 'Price', ph.Data_ID 'PhotoID' "
                            ."FROM models_dict md "
                            ."INNER join submodels_list sm on (md.id = sm.Model_ID) "
                            ."INNER JOIN subsubmodels sb ON (sm.id = sb.SubModel_ID) "
                            ."INNER JOIN characteristic ch ON (sb.id = ch.SubSubModel_ID) "
                            ."INNER JOIN photos ph ON (sb.id = ph.SubSubModel_ID) "
                            ."INNER JOIN phototype pt ON (ph.PType_ID = pt.id) "
                            ."WHERE (md.Name = ?) AND (sm.Name = ?) AND (pt.Description = 'Tab') "
                            ."GROUP BY(sb.id)");
        $stmt->bindParam(1, $model);    //передача названия модели
        $stmt->bindParam(2, $submodel); //передача названия подмодели
        
        $i=0;
        if ($stmt->execute()){
            while($row = $stmt->fetch())
            {
                $modelsList[$i]['ModelsListName'] = $row['ModelsListName'];
                $modelsList[$i]['SubModelsListName'] = $row['SubModelsListName'];
                $modelsList[$i]['SubSubModelsListName'] = $row['SubSubModelsListName'];
                $modelsList[$i]['SubSubmodelID'] = $row['SubSubmodelID'];
                $modelsList[$i]['Price'] = $row['Price'];                
                $modelsList[$i]['PhotoID'] = $row['PhotoID'];
                $modelsList[$i]['Params'] = self::getAdvancedParams($row['SubSubmodelID']);
                $i++;
            }
        }
        
        return $modelsList;
    }
    
    public static function getSubModelsCarousel($model,$submodel)
    {
        $db = Db::getConnection();  //соединение с БД
        
        $photoIDsList = array();
        
        $stmt = $db->prepare("SELECT ph.Data_ID 'PhotoID', dat.description 'description', dat.subDescription 'subDescription' "
                            ."FROM models_dict md "
                            ."INNER join submodels_list sm on (md.id = sm.Model_ID) "
                            ."INNER JOIN subsubmodels sb ON (sm.id = sb.SubModel_ID) "
                            ."INNER JOIN photos ph ON (sb.id = ph.SubSubModel_ID) "
                            ."INNER JOIN phototype pt ON (ph.PType_ID = pt.id) "
                            ."INNER JOIN data_blobs dat ON (ph.Data_ID = dat.id) "
                            ."WHERE (md.Name = ?) AND (sm.Name = ?) AND (pt.Description = 'Carousel')");
        $stmt->bindParam(1, $model);    //передача названия модели
        $stmt->bindParam(2, $submodel); //передача названия подмодели 
        
        $i=0;
        if ($stmt->execute()){
            while($row = $stmt->fetch())
            {
                $modelsList[$i]['PhotoID'] = $row['PhotoID'];
                $modelsList[$i]['description'] = $row['description'];
                $modelsList[$i]['subDescription'] = $row['subDescription'];
                $i++;
            }
        }
        
        return $modelsList;
    }


    public static function getSubModelsOfModel($model)
    {
        $db = Db::getConnection();  //соединение с БД

        $submodelsList = array();

        $qry = $db ->prepare("SELECT lst.id 'Id', lst.Name 'Name' "
                            ."FROM models_dict dict "
                            ."INNER JOIN submodels_list lst ON (dict.id = lst.Model_ID) "
                            ."WHERE (dict.Name =  ?)");
        $qry->bindParam(1,$model);

        $i=0;
        if ($qry->execute()){
            while($row = $qry->fetch())
            {
                $submodelsList[$i]['Id'] = $row['Id'];
                $submodelsList[$i]['Name'] = $row['Name'];
                $i++;
            }
        }

        foreach ($submodelsList as $key=>$value)
        {
            $subsubmodels = array();
            $qry = $db ->prepare("SELECT lst.Name 'SubName', ch.Price 'Price', ph.Data_ID 'PhotoID' "
                                ."FROM subsubmodels lst "
                                ."INNER JOIN characteristic ch ON(lst.id = ch.SubSubModel_ID) "
                                ."INNER JOIN photos ph ON(lst.id = ph.SubSubModel_ID) "
                                ."INNER JOIN phototype pt ON (ph.PType_ID = pt.id) "
                                ."WHERE (lst.SubModel_ID = ?) AND (pt.Description = 'Tab') "
                                ."GROUP BY (lst.id)");
            $qry->bindParam(1,$value['Id']);
            if ($qry->execute())
            {
                $j = 0;
                while($row = $qry->fetch())
                {
                    $subsubmodels[$j]['SubName'] = $row['SubName'];
                    $subsubmodels[$j]['Price'] = $row['Price'];
                    $subsubmodels[$j]['PhotoID'] = $row['PhotoID'];
                    $j++;
                }
                $submodelsList[$key]['SubModels'] = $subsubmodels;
            }
        }

        return $submodelsList;
    }

    //получение информации об линейках модели
    public static function getModelsLines()
    {
        $db = Db::getConnection();  //соединение с БД
        $modelsLines = array();

        $qry = $db->prepare("SELECT md.id 'Id', md.Name 'Name', COUNT(sm.id) 'SubModelsCount' "
                            ."FROM models_dict md "
                            ."LEFT JOIN submodels_list sm ON (md.id = sm.Model_ID) "
                            ."GROUP BY (md.id)");
        if ($qry->execute())
        {
            $i = 0;
            while ($row = $qry->fetch())
            {
                $modelsLines[$i]['Id'] = $row['Id'];
                $modelsLines[$i]['Name'] = $row['Name'];
                $modelsLines[$i]['SubModelsCount'] = $row['SubModelsCount'];
                $i++;
            }
        }
        else
            return;
        $qry = $db->prepare("SELECT COUNT(sub.id) 'SubSubModelsCount' "
                            ."FROM submodels_list sm "
                            ."INNER JOIN subsubmodels sub ON (sm.id = sub.SubModel_ID) "
                            ."WHERE (sm.Model_ID = :ModelID)");
        foreach ($modelsLines as $key=>$value)
        {
            $qry->bindParam(':ModelID', $value['Id'], PDO::PARAM_INT);
            if ($qry->execute())
            {
                $tmp = $qry->fetch(PDO::FETCH_ASSOC);
                $modelsLines[$key]['SubSubModelsCount'] = $tmp['SubSubModelsCount'];
            }
            else
            {
                $modelsLines[$key]['SubSubModelsCount'] = 0;
            }
        }
        return $modelsLines;
    }

    //проверка дублирования названия линейки модели
    public static function checkLineNameExists($LineName)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM models_dict WHERE Name = :LineName';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':LineName', $LineName, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    //проверкка длина названия линейки моделей (должно быть 2 или более символа)
    public static function checkLineName($LineName)
    {
        if (strlen($LineName) > 2) {
            return true;
        }
        return false;
    }

    //создание новой линейки модели
    public static function createNewModelLine($LineName)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $qry = $db->prepare("INSERT INTO models_dict (Name) "
                            ."VALUES (:LineName)");
        $qry->bindParam(':LineName', $LineName, PDO::PARAM_STR);
        return $qry->execute();
    }

    //получение названия линейки моделей по ID
    public static function getLineParamsByID($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $result = $db->prepare("SELECT Name "
                                ."FROM models_dict "
                                ."WHERE (id = :id)");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result->execute())
        {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }

    //редактирование названия линейки моделей
    public static function editLineName($id, $newLineName)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $result = $db->prepare("UPDATE models_dict "
                                ."SET Name = :newName "
                                ."WHERE (id = :id)");
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':newName', $newLineName, PDO::PARAM_STR);
        return $result->execute();
    }

    //удаление линейки моделей и моделей, которые были в данной линейке
    public static function deleteLineById($id, $photosCarousel, $photosTab, $photosPreview, $backup)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $subModels = array();
        $subSubModels = array();
        $characteristics = array();

        $photos = array();

        $qry = $db->prepare("CALL getSubModelIDSByModelID(:modelID)");
        $qry->bindParam(':modelID', $id, PDO::PARAM_INT);

        if($qry->execute())
        {
            $i = 0;
            while ($row = $qry->fetch())
            {
                $subModels[$i] = $row['id'];    //получение моделей модельного ряда (ключ - счетчик, занчение - код модели модельного ряда)
                $i++;
            }
        }

        foreach ($subModels as $key=>$value)
        {
            $qry = $db->prepare("CALL getSubSubModelIDSBySubModelID(:subModelID)");
            $qry->bindParam(':subModelID', $value, PDO::PARAM_INT);
            if($qry->execute())
            {
                $i = 0;
                while ($row = $qry->fetch())
                {
                    $subSubModels[$value][$i] = $row['id'];    //получение подмоделей моделей (ключ - код модели, занчение - код подмодели)
                    $i++;
                }
            }
        }

        foreach ($subSubModels as $key=>$value)
        {
            for ($i = 0; $i < count($value); $i++)
            {
                $qry = $db->prepare("CALL getCharacteristicIDSBySubSubModelID(:subSubModelID)");
                $qry->bindParam(':subSubModelID', $value[$i], PDO::PARAM_INT);  //получение характеристик подмодели
                if($qry->execute())
                {
                    $j = 0;
                    while ($row = $qry->fetch())
                    {
                        $characteristics[$value[$i]][$j] = $row['id'];    //получение характеристик подмоделей (ключ - подмодель, занчение - код характеристики)
                        $j++;
                    }
                }
                $photos[$value[$i]] = Self::getPhotosAndDataBlobsIDsBySubSubModelID($value[$i]);
            }
        }
        if ($backup)
        {
            self::archiveModel($id);
            if (count($subModels) > 0)
            {
                self::archiveSubModels($subModels);
            }
            if (count($subSubModels) > 0)
            {
                self::archiveDrive();
                self::archiveSubSubModels($subSubModels);
                if (count($photos) > 0){
                    self::archivePhotosAndBlobs($photos,$photosCarousel,$photosTab,$photosPreview);
                }
                if (count($characteristics) > 0){
                    self::archiveTransmission();
                    self::archiveCharacteristics($characteristics);
                }
            }

        }
        if (count($photos) > 0){
            self::deletePhotosAndBlobs($photos,$photosCarousel,$photosTab,$photosPreview);
        }
        if (count($characteristics) > 0) {
            self::deleteCharacteristics($characteristics);
        }
        if (count($subSubModels) > 0){
            self::deleteSubSubModels($subSubModels);
        }
        if (count($subModels) > 0){
            self::deleteSubModels($subModels);
        }
        self::deleteModelByID($id);

        return $photos;
    }

    //архивирование записи модельного ряда
    private static function archiveModel($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL archiveModel(:id)");
        $qry->bindParam(':id', $id, PDO::PARAM_INT);
        return $qry->execute();
    }

    //архивирование моделей модельного ряда
    private static function archiveSubModels($subModels)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL archiveSubModel(:id)");

        foreach ($subModels as $key=>$value)
        {
            $qry->bindParam(':id', $value, PDO::PARAM_INT);
            $qry->execute();
        }
    }

    //архивирование подмоделей моделей
    private static function archiveSubSubModels($subSubModels)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL archiveSubSubModel(:id)");

        foreach ($subSubModels as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry->bindParam(':id', $innerValue, PDO::PARAM_INT);
                $qry->execute();
            }
        }
    }

    //архивирование таблицы с приводами
    private static function archiveDrive()
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL cloneDriveToArchive");
        return $qry->execute();
    }

    //архивирование фотографий
    private static function archivePhotosAndBlobs($photos, $photosCarousel, $photosTab, $photosPreview)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $description = '';
        $subqry = $db->prepare("CALL clonePhotoTypeToArchive");
        $subqry->execute();
        foreach ($photos as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry = $db->prepare("CALL getTypeDescriptionOfPhotoID(:photoID)");
                $qry->bindParam(':photoID', $innerValue['id'], PDO::PARAM_INT);
                if ($qry->execute())
                {
                    if ($photosCarousel)
                    {
                        $description = $qry->fetchColumn(); //название типа фотографии
                        if ($description === 'Carousel')
                        {
                            $subqry = $db->prepare("CALL archiveDataBlob(:data_ID)");
                            $subqry->bindParam(':data_ID', $innerValue['data_ID'], PDO::PARAM_INT);
                            if ($subqry->execute())
                            {
                                $subqry = $db->prepare("CALL archivePhoto(:id)");
                                $subqry->bindParam(':id', $innerValue['id'], PDO::PARAM_INT);
                                $subqry->execute();
                            }
                        }
                    }

                    if ($photosTab)
                    {
                        $description = $qry->fetchColumn(); //название типа фотографии
                        if ($description === 'Tab')
                        {
                            $subqry = $db->prepare("CALL archiveDataBlob(:data_ID)");
                            $subqry->bindParam(':data_ID', $innerValue['data_ID'], PDO::PARAM_INT);
                            if ($subqry->execute())
                            {
                                $subqry = $db->prepare("CALL archivePhoto(:id)");
                                $subqry->bindParam(':id', $innerValue['id'], PDO::PARAM_INT);
                                $subqry->execute();
                            }
                        }
                    }

                    if ($photosPreview)
                    {
                        $description = $qry->fetchColumn(); //название типа фотографии
                        if ($description === 'Preview')
                        {
                            $subqry = $db->prepare("CALL archiveDataBlob(:data_ID)");
                            $subqry->bindParam(':data_ID', $innerValue['data_ID'], PDO::PARAM_INT);
                            if ($subqry->execute())
                            {
                                $subqry = $db->prepare("CALL archivePhoto(:id)");
                                $subqry->bindParam(':id', $innerValue['id'], PDO::PARAM_INT);
                                $subqry->execute();
                            }
                        }
                    }
                }

            }
        }
    }

    //архивирование характеристик
    private static function archiveCharacteristics($characteristics)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL archiveCharacteristic(:id)");

        foreach ($characteristics as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry->bindParam(':id', $innerValue, PDO::PARAM_INT);
                $qry->execute();
            }
        }
    }

    //архивирование таблицы с коробками пердач
    private static function archiveTransmission()
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL cloneTransmissionToArchive");
        return $qry->execute();
    }

    /** ------------------------------------------------------------------------------------------------------------- */

    //получеие массива кодов описаний фотографий и кодов на двоичные записи
    private static function getPhotosAndDataBlobsIDsBySubSubModelID($id)
    {
        $photosAndBlobsIDs = array();
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("CALL getPhotoIDSBySubSubModelID(:subSubModelID)");
        $qry->bindParam(':subSubModelID', $id, PDO::PARAM_INT);  //получение кода описания фотографии и кода на двоичную запись
        if ($qry->execute())
        {
            $i = 0;
            while ($row = $qry->fetch())
            {
                $photosAndBlobsIDs[$i]['id'] = $row['id'];
                $photosAndBlobsIDs[$i]['data_ID'] = $row['data_ID'];
                $i++;
            }
        }
        return $photosAndBlobsIDs;
    }

    //удаление характеристик подмоделей
    private static function deleteCharacteristics($characteristics)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM characteristic WHERE  id = :id");

        foreach ($characteristics as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry->bindParam(':id', $innerValue, PDO::PARAM_INT);
                $qry->execute();
            }
        }
    }

    //удаление подмоделей моделей
    private static function deleteSubSubModels($subSubModels)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM subsubmodels WHERE (id = :idToDelete)");
        foreach ($subSubModels as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry->bindParam(':idToDelete', $innerValue, PDO::PARAM_INT);
                $qry->execute();
            }
        }
    }

    //удаление назначение фотографий и их файлоа
    private static function deletePhotosAndBlobs($photos, $photosCarousel, $photosTab, $photosPreview)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $description = '';
        $subqry = $db->prepare("CALL clonePhotoTypeToArchive");
        $subqry->execute();
        foreach ($photos as $key=>$value)
        {
            foreach ($value as $innerKey=>$innerValue)
            {
                $qry = $db->prepare("CALL getTypeDescriptionOfPhotoID(:photoID)");
                $qry->bindParam(':photoID', $innerValue['id'], PDO::PARAM_INT);
                if ($qry->execute())
                {
                    $description = $qry->fetchColumn(); //название типа фотографии
                    if ($photosCarousel)
                    {
                        if ($description === "Carousel")
                        {
                            self::deletePhotoByID($innerValue['id']);
                            self::deleteBlobByID($innerValue['data_ID']);
                        }

                    }

                    if ($photosTab)
                    {
                        if ($description === "Tab")
                        {
                            self::deletePhotoByID($innerValue['id']);
                            self::deleteBlobByID($innerValue['data_ID']);
                        }
                    }

                    if ($photosPreview)
                    {
                        if ($description === "Preview")
                        {
                            self::deletePhotoByID($innerValue['id']);
                            self::deleteBlobByID($innerValue['data_ID']);
                        }
                    }
                    else{
                        self::setPhotoNullSubSubModelID($innerValue['id']);
                    }
                }

            }
        }
    }

    //удаление указателя фотографии на модификацию модели
    private static function setPhotoNullSubSubModelID($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("UPDATE photos "
                            ."SET SubSubModel_ID = NULL "
                            ."WHERE id = :photoID");
        $qry->bindParam(':photoID', $id, PDO::PARAM_INT);
        $qry->execute();
    }

    //удаление фотографии по id
    private static function deleteBlobByID($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM data_blobs WHERE  id = :id");
        $qry->bindParam(':id', $id, PDO::PARAM_INT);
        $qry->execute();
    }

    //удаление ссылки с описанием фотографии по id
    private static function deletePhotoByID($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM photos WHERE  id = :id");
        $qry->bindParam(':id', $id, PDO::PARAM_INT);
        $qry->execute();
    }

    //удаление моделей модельного ряда
    private static function deleteSubModels($subModels)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM submodels_list WHERE  id = :id");

        foreach ($subModels as $key=>$value)
        {
            $qry->bindParam(':id', $value, PDO::PARAM_INT);
            $qry->execute();
        }
    }

    //удаление модельного ряда по ID
    private static function deleteModelByID($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $qry = $db->prepare("DELETE FROM models_dict WHERE  id = :id");
        $qry->bindParam(':id', $id, PDO::PARAM_INT);
        $qry->execute();
    }
}
