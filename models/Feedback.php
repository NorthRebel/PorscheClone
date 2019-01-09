<?php

    class Feedback
    {
        public static function sendMessage($mail, $fio, $theme, $message)
        {
            // Соединение с БД
            $db = Db::getConnection();

            $sql = 'INSERT INTO feedback (email, author_FIO, theme, message) '
                . 'VALUES (:email, :fio, :theme, :message)';

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':email', $mail, PDO::PARAM_STR);
            $result->bindParam(':fio', $fio, PDO::PARAM_STR);
            $result->bindParam(':theme', $theme, PDO::PARAM_STR);
            $result->bindParam(':message', $message, PDO::PARAM_STR);
            return $result->execute();
        }

        public static function checkFIO($fio)
        {
            if (strlen($fio) >= 10) {
                return true;
            }
            return false;
        }

        public static function checkEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }
    }