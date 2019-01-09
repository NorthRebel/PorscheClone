<?php

    class UserController
    {
        public function actionRegister()
        {
            // Переменные для формы
            $firstName = false;
            $lastName = false;
            $patronymic = false;
            $email = false;
            $password = false;
            $result = false;
            $rolesList = User::getRolesList();

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $firstName = $_POST['FirstName'];
                $lastName = $_POST['LastName'];
                $patronymic = $_POST['Patronymic'];
                $email = $_POST['email'];
                $password = $_POST['password'];

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
                if (!User::checkEmail($email)) {
                    $errors[] = 'Неправильный email';
                }
                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }
                if (User::checkEmailExists($email)) {
                    $errors[] = 'Такой email уже используется';
                }

                if ($errors == false) {
                    // Если ошибок нет
                    // Регистрируем пользователя
                    $result = User::register($email, $password, $firstName, $lastName, $patronymic);
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/user/register.php');
            return true;
        }

        public function actionLogin()
        {
            // Переменные для формы
            $email = false;
            $password = false;

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Флаг ошибок
                $errors = false;

                // Валидация полей
                if (!User::checkEmail($email)) {
                    $errors[] = 'Неправильный email';
                }
                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }

                // Проверяем существует ли пользователь
                $userId = User::checkUserData($email, $password);

                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    User::auth($userId);

                    // Перенаправляем пользователя в закрытую часть - кабинет
                    header("Location: /cabinet");
                }
            }


            // Подключаем вид
            require_once(ROOT . '/views/user/login.php');
            return true;
        }

        /**
         * Удаляем данные о пользователе из сессии
         */
        public function actionLogout()
        {
            // Удаляем информацию о пользователе из сессии
            unset($_SESSION['user']);

            // Перенаправляем пользователя на главную страницу
            header("Location: /");
        }
    }