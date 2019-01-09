<?php

class ModelsController
{
    public function actionIndex($model)
    {
        $submodels = Models::getSubModelsOfModel($model);
        $selectedModel = $model;

        require_once(ROOT . '/views/models/index.php');
        return true;
    }

    public function actionView($model, $submodel, $modelOfSubmodel = '')
    {
        $model = str_replace('_', ' ', $model);
        $submodel = str_replace('_', ' ', $submodel);
        $modelOfSubmodel = str_replace('_', ' ', $modelOfSubmodel);

        // Флаг ошибок
        $errors = false;

        $modelTabs = Models::getSubSubModelsTabs($model,$submodel);
        $carouselPhotos = Models::getSubModelsCarousel($model,$submodel);

        if (!isset($modelTabs) || !isset($carouselPhotos))
        {
            $errors[] = "Не удалось получить данные с БД";
        }

        if (isset($_POST['submit'])) {
            $transmissionID = $_POST['transmissionSelect'];
            $modelSelect = $_POST['modelSelect'];

            // Получаем идентификатор пользователя из сессии
            $userId = User::checkLogged();

            // Флаг успешного выполнения действий
            $succsess = false;

            /* echo "UserID = $userId <br>";
             echo "TransmissionID = $transmissionID <br>";
             echo "ModelSelect = $modelSelect <br>";
            */
            if (Purchase::ordering($userId, $modelSelect, $transmissionID)) {
                $succsess[] = "Покупка успешно совершена!";
            } else {
                $errors[] = "Не удавлось совершить покупку!";
                $errors[] = "UserID = $userId";
                $errors[] = "TransmissionID = $transmissionID";
                $errors[] = "ModelSelect = $modelSelect";
            }
        }


        // Подключаем вид
        require_once(ROOT . '/views/models/view.php');
        return true;
    }
}
