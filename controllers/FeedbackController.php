<?php

class FeedbackController
{
    public function actionIndex()
    {
        //проверка гостя
        if (!User::isGuest()) {
            // Получаем идентификатор пользователя из сессии
            $userId = User::checkLogged();
            // Получаем информацию о пользователе из БД
            $user = User::getUserById($userId);
            $mail = $user['email'];
            $fio = $user['LastName'] . ' ' . $user['FirstName'] . ' ' . $user['Patronymic'];
        }
        else
        {
            $mail = false;
            $fio = false;
        }
        $theme = false;
        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования

            // Флаг ошибок
            $errors = false;

            if (User::isGuest()) {
                $mail = $_POST['mail'];
                $fio = $_POST['fio'];

                if (!Feedback::checkFIO($fio)) {
                    $errors[] = 'ФИО не должно быть короче 10-х символов';
                }
                if (!Feedback::checkEmail($mail)) {
                    $errors[] = 'Адрес электронной почты не корректно введен!';
                }
            }
            $theme = $_POST['theme'];
            $message = $_POST['message'];

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = Feedback::sendMessage($mail,$fio,$theme,$message);
            }
        }

        require_once(ROOT . '/views/feedback/index.php');
        return true;
    }
}