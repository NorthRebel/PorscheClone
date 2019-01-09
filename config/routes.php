<?php

return array(

    /** Контроллер/Экшн/Параметры **/

    //модели авто
    'models/(\w+)/(\w+)' => 'models/view/$1/$2',
    'models/(\w+)/(\w+)/(\w+)' => 'models/view/$1/$2/$3',
    'models/(\w+)' => 'models/index/$1',

    //получение фото с базы данных
    'photos/([0-9]+)' => 'photos/index/$1',

    //сервис Porsche
    'service' => 'service/index',
    
    //корпоративные продажи
    'about/enterprise/' => 'about/enterprise',
    
    //контакты
    'about/contacts/' => 'about/contacts',
    
    //о компании
    'about' => 'about/index',
    
    //Обратная связь
    'feedback' => 'feedback/index',

    //личный кабинет
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/register' => 'user/register',

    //упраление обратной связью
    'admin/communication' => 'adminCommunication/index',

    //управление линейками моделями
    'admin/submodels/create' => 'adminSubModels/create',
    'admin/submodels/update/([0-9]+)' => 'adminSubModels/update/$1',
    'admin/submodels/delete/([0-9]+)' => 'adminSubModels/delete/$1',
    'admin/submodels/view/([0-9]+)' => 'adminSubModels/view/$1',
    'admin/submodels' => 'adminSubModels/index',

    //управление линейками моделями
    'admin/models/create' => 'adminModels/create',
    'admin/models/update/([0-9]+)' => 'adminModels/update/$1',
    'admin/models/delete/([0-9]+)' => 'adminModels/delete/$1',
    'admin/models/view/(\w+)' => 'adminModels/view/$1',
    'admin/models' => 'adminModels/index',

    //упраление заказами
    'admin/purchases' => 'adminPurchases/index',

    //управление пользователями
    'admin/users' => 'adminUsers/index',

    //управление фотографиями
    'admin/photos' => 'adminPhotos/index',

    //панель администратора
    'admin' => 'admin/index',

    //главная страница
    'index.php' => 'porsche/index', // actionIndex в SiteController
    '' => 'porsche/index', // actionIndex в SiteController
);