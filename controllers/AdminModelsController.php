<?php

    class AdminModelsController extends AdminBase
    {
        public function actionIndex()
        {
            $modelsLines = Models::getModelsLines();

            // Подключаем вид
            require_once(ROOT . '/views/admin_models/index.php');
            return true;
        }

        public function actionCreate()
        {
            // Флаг результата
            $result = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $LineName = $_POST['LineName'];

                // Флаг ошибок в форме
                $errors = false;

                // При необходимости можно валидировать значения нужным образом
                if (!Models::checkLineName($LineName)){
                    $errors[] = 'Название линейки модели должно быть больше 2-х символов!';
                }
                if (is_array(Models::checkLineNameExists($LineName))) {
                    $errors[] = 'Линейка моделей с таким названием уже существует!';
                }

                if ($errors == false) {
                    // Если ошибок нет
                    // создаем новую линейку моделей
                    $result = Models::createNewModelLine($LineName);
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/admin_models/create.php');
            return true;
        }

        public function actionDelete($id)
        {
            $LineParams = Models::getLineParamsByID($id);

            if (!isset($LineParams))
            {
                $fatalErrors[] = "Не удалось получить данные с БД";
            }
            else
            {
                $submodels = Models::getSubModelsOfModel($LineParams['Name']);
                $selectedModel = $LineParams['Name'];
                $modCount = 0;
                foreach ($submodels as $key=>$value)
                {
                    $modCount+= count($value['SubModels']);
                }
            }

            // Флаг результата
            $result = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена:

                //проверяем, нужно ли удалять фотографии моделей их разновидности
                $photosCarousel =  isset($_POST['photosCarousel']) ? 1 : 0 ;
                $photosTab = isset($_POST['photosTab']) ? 1 : 0 ;
                $photosPreview = isset($_POST['photosPreview']) ? 1 : 0 ;
                $backup = isset($_POST['backup']) ? 1 : 0 ; //резервная копия

                // Удаляем товар
                $result =Models::deleteLineById($id,$photosCarousel,$photosTab,$photosPreview,$backup);
            }

            // Подключаем вид
            require_once(ROOT . '/views/admin_models/delete.php');
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
            require_once(ROOT . '/views/admin_models/update.php');
            return true;
        }

        public function actionView($model)
        {
            $submodels = Models::getSubModelsOfModel($model);
            $selectedModel = $model;

            if (count($submodels) === 0)
            {
                $fatalErrors[] = "Не удалось получить данные с БД";
            }

            // Подключаем вид
            require_once(ROOT . '/views/admin_models/view.php');
            return true;
        }
    }