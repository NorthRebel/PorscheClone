<?php

    class User
    {
        /**
         * @return array <p>Массив ролей пользователя</p>
         */
        public static function getRolesList()
        {
            // Соединение с БД
            $db = Db::getConnection();
            $rolesList = array();

            $qry = $db->prepare("SELECT * FROM userRole");

            if ($qry->execute())
            {
                $i = 0;
                while($row = $qry->fetch())
                {
                    $rolesList[$i]['id'] = $row['id'];
                    $rolesList[$i]['description'] = $row['description'];
                    $i++;
                }
            }

            return $rolesList;
        }


        /**
         * Регистрация пользователя
         * @param string $email <p>E-mail</p>
         * @param string $password <p>Пароль</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function register($email, $password, $firstName, $lastName, $patronymic)
        {
            // Соединение с БД
            $db = Db::getConnection();
            $password = md5($password);
            $userRoleID = 2;    //обычный пользователь

            // Текст запроса к БД
            $sql = 'INSERT INTO users (email, password, role_id, FirstName, LastName, Patronymic) '
                . 'VALUES (:email, :password, :role_id, :FirstName, :LastName, :Patronymic)';

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            $result->bindParam(':role_id', $userRoleID, PDO::PARAM_INT);
            $result->bindParam(':FirstName', $firstName, PDO::PARAM_STR);
            $result->bindParam(':LastName', $lastName, PDO::PARAM_STR);
            $result->bindParam(':Patronymic', $patronymic, PDO::PARAM_STR);
            return $result->execute();
        }

        /**
         * Проверяет имя: не меньше, чем 6 символов
         * @param string $password <p>Пароль</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function checkPassword($password)
        {
            if (strlen($password) >= 6) {
                return true;
            }
            return false;
        }

        //проверка старого пароля перед его измением
        public static function CheckOldPassword($oldPassword)
        {
            // Соединение с БД
            $db = Db::getConnection();
            $oldPassword = md5($oldPassword);

            // Текст запроса к БД
            $sql = 'SELECT id FROM users WHERE password = :password';

            // Получение результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':password', $oldPassword, PDO::PARAM_STR);
            $result->execute();

            if ($result->fetch(PDO::FETCH_ASSOC))
                return true;
            return false;
        }

        /**
         * Проверяет имя: не меньше, чем 2 символа
         * @param string $name <p>Имя</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function checkName($name)
        {
            if (strlen($name) >= 2) {
                return true;
            }
            return false;
        }

        /**
         * Проверяет не занят ли email другим пользователем
         * @param type $email <p>E-mail</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function checkEmailExists($email)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

            // Получение результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();

            if ($result->fetchColumn())
                return true;
            return false;
        }

        /**
         * Проверяет email
         * @param string $email <p>E-mail</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function checkEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }

        public static function checkUserData($email, $password)
        {
            // Соединение с БД
            $db = Db::getConnection();
            $password = md5($password);

            // Текст запроса к БД
            $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

            // Получение результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_INT);
            $result->bindParam(':password', $password, PDO::PARAM_INT);
            $result->execute();

            // Обращаемся к записи
            $user = $result->fetch();

            if ($user) {
                // Если запись существует, возвращаем id пользователя
                return $user['id'];
            }
            return false;
        }

        /**
         * Запоминаем пользователя
         * @param integer $userId <p>id пользователя</p>
         */
        public static function auth($userId)
        {
            // Записываем идентификатор пользователя в сессию
            $_SESSION['user'] = $userId;
        }

        /**
         * Возвращает идентификатор пользователя, если он авторизирован.<br/>
         * Иначе перенаправляет на страницу входа
         * @return string <p>Идентификатор пользователя</p>
         */
        public static function checkLogged()
        {
            // Если сессия есть, вернем идентификатор пользователя
            if (isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }

            header("Location: /user/login");
        }

        /**
         * Проверяет является ли пользователь гостем
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function isGuest()
        {
            if (isset($_SESSION['user'])) {
                return false;
            }
            return true;
        }

        /**
         * Возвращает пользователя с указанным id
         * @param integer $id <p>id пользователя</p>
         * @return array <p>Массив с информацией о пользователе</p>
         */
        public static function getUserById($id)
        {
            // Соединение с БД
            $db = Db::getConnection();
            $result = array();

            // Получение и возврат результатов. Используется подготовленный запрос
            $qry = $db->prepare("SELECT usr.email 'email', role.description 'role', usr.FirstName 'FirstName', "
                                ."usr.LastName 'LastName', usr.Patronymic 'Patronymic' "
                                ."FROM users usr "
                                ."INNER JOIN userRole role ON (usr.role_id = role.id) "
                                ."WHERE usr.id = :id");
            $qry->bindParam(':id', $id, PDO::PARAM_INT);
            if ($qry->execute()){
                $result = $qry->fetch(PDO::FETCH_ASSOC); //получение асоциативного массива
            }
            return $result;
        }

        public static function edit($id, $firstName, $lastName, $patronymic, $password)
        {
            // Соединение с БД
            $db = Db::getConnection();
            $password = md5($password);

            // Текст запроса к БД
            $sql = "UPDATE users 
            SET FirstName = :firstName, LastName = :lastName, Patronymic = :patronymic, password = :password 
            WHERE id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $result->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            return $result->execute();
        }
    }