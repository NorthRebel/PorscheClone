<?php

    class CabinetController
    {
        public function actionIndex()
        {
            // Получаем идентификатор пользователя из сессии
            $userId = User::checkLogged();

            // Получаем информацию о пользователе из БД
            $user = User::getUserById($userId);
            $odersList = Purchase::getOrdersList($userId);

            require_once(ROOT.'/views/cabinet/index.php');
            return true;
        }

        public function actionEdit()
        {
            // Получаем идентификатор пользователя из сессии
            $userId = User::checkLogged();

            // Получаем информацию о пользователе из БД
            $user = User::getUserById($userId);

            // Заполняем переменные для полей формы
            $firstName = $user['FirstName'];
            $lastName = $user['LastName'];
            $patronymic = $user['Patronymic'];

            // Флаг результата
            $result = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы редактирования
                $firstName = $_POST['FirstName'];
                $lastName = $_POST['LastName'];
                $patronymic = $_POST['Patronymic'];
                $OldPassword = $_POST['OldPassword'];
                $NewPassword = $_POST['NewPassword'];
                $ConfirmPassword = $_POST['ConfirmPassword'];

                // Флаг ошибок
                $errors = false;

                // Валидация полей
                if (!User::checkName($firstName)) {
                    $errors[] = 'Имя не должно быть короче 2-х символов';
                }
                if (!User::checkName($lastName)) {
                    $errors[] = 'Фамилия не должна быть короче 2-х символов';
                }
                if (!User::checkName($patronymic)) {
                    $errors[] = 'Отчество не должно быть короче 2-х символов';
                }
                if (!User::CheckOldPassword($OldPassword)){
                    $errors[] = ' Старый пароль введен неверно!';
                }
                if (!User::checkPassword($NewPassword)) {
                    $errors[] = 'Новый пароль не должен быть короче 6-ти символов';
                }
                if ($NewPassword !== $ConfirmPassword){
                    $errors[] = 'Новые пароли не совпадают!';
                }

                if ($errors == false) {
                    // Если ошибок нет, сохраняет изменения профиля
                    $result = User::edit($userId, $firstName, $lastName, $patronymic, $NewPassword);
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/cabinet/edit.php');
            return true;
        }
    }