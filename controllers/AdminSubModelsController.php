<?php

    class AdminSubModelsController extends AdminBase
    {
        public function actionIndex()
        {
            $modelsLines = Models::getModelsLines();
            $subModels = subModels::getSubModels();

            // Подключаем вид
            require_once(ROOT . '/views/admin_SubModels/index.php');
            return true;
        }

        public function actionCreate()
        {
            $modelsLines = Models::getModelsLines();

            // Флаг результата
            $result = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $LineID = $_POST['modelsNames'];
                $SubModelName = $_POST['subModelName'];

                // Флаг ошибок в форме
                $errors = false;

                // При необходимости можно валидировать значения нужным образом
                if (!Models::checkLineName($SubModelName)){
                    $errors[] = 'Название модели должно быть больше 2-х символов!';
                }
                if (is_array(subModels::checkNameModelExists($SubModelName, $LineID))) {
                    $errors[] = 'Модель с таким наименованием уже существует!';
                }

                if ($errors == false) {
                    // Если ошибок нет
                    // создаем новую линейку моделей
                    $result = subModels::createNewModel($SubModelName, $LineID);
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/admin_SubModels/create.php');
            return true;
        }

        public function actionDelete($id)
        {
            // Подключаем вид
            require_once(ROOT . '/views/admin_SubModels/delete.php');
            return true;
        }

        public function actionUpdate($id)
        {
            $LineParams = Models::getLineParamsByID($id);


            if (!isset($LineParams))
            {
                $fatalErrors[] = "Не удалось получить данные с БД";
            }

            // Флаг результата
            $result = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $newLineName = $_POST['newLineName'];

                // Флаг ошибок в форме
                $errors = false;

                // При необходимости можно валидировать значения нужным образом
                if (!Models::checkLineName($newLineName)){
                    $errors[] = 'Название линейки модели должно быть больше 2-х символов!';
                }
                if (is_array($check = Models::checkLineNameExists($newLineName))) {
                    if ($check['id'] !== $id) {
                        $errors[] =  'Линейка моделей с таким названием уже существует!';
                    }
                }

                if ($errors == false) {
                    // Если ошибок нет
                    // изменеяем название линейки моделей
                    $result = Models::editLineName($id,$newLineName);
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/admin_SubModels/update.php');
            return true;
        }

        public function actionView($model)
        {
            // Подключаем вид
            require_once(ROOT . '/views/admin_SubModels/view.php');
            return true;
        }
    }