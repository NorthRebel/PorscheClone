<!doctype HTML>
<html lang="ru">

<head>
    <title>Автосалон Porsche</title>
    <meta charset="utf-8">
    <!-- Иконка в браузере -->
    <link href="/template/images/ico/porsche_favicon.png" rel="icon">
    <!-- Стиль для всех страниц -->
    <link href="/template/css/AllPages.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">
    <link href="/template/css/models.css" rel="stylesheet">
    <link href="/template/css/sale.css" rel="stylesheet">
    <link href="/template/css/VideoResposive.css" rel="stylesheet">
    <link href="/template/css/Login.css" rel="stylesheet">
    <!--Awesome icons -->
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap framework -->
    <link href="/template/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/template/css/bootstrap-theme.css" rel="stylesheet">
    <!-- Скрипты, необходимые для полноценной работы bootstrap -->
    <script src="/template/js/jquery.min.js" type="text/javascript"></script>
    <script src="/template/js/bootstrap.js" type="text/javascript"></script>

    <style>
        body {
            background: url(/template/images/background/background.jpg);
        }
    </style>
</head>

<body>

<header>
    <nav class="container navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="/template/images/ico/porsche-svg.svg" width="70" align="center">
                <a class="navbar-brand" href="#"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Модельный ряд<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="/models/718/">718</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/models/718/Cayman/">718 Cayman</a></li>
                                    <li><a href="/models/718/Boxster/">718 Boxster</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="/models/911/">911</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/models/911/Carrera/">911 Carrera</a></li>
                                    <li><a href="/models/911/Targa_4/">911 Targa 4</a></li>
                                    <li><a href="/models/911/Turbo/">911 Turbo</a></li>
                                    <li><a href="/models/911/Turbo_S_Exclusive_Series/">911 Turbo Exclusive Series</a>
                                    </li>
                                    <li><a href="/models/911/GTS/">911 GTS</a></li>
                                    <li><a href="/models/911/GT3/">911 GT3</a></li>
                                    <li><a href="/models/911/GT2_RS/">911 GT2 RS</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="/models/Panamera/">Panamera</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/models/Panamera/Panamera/">Panamera</a></li>
                                    <li><a href="/models/Panamera/E_Hybrid/">Panamera E-Hybrid</a></li>
                                    <li><a href="/models/Panamera/Turbo/">Panamera Turbo</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="/models/Macan/">Macan</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/models/Macan/Macan/">Macan</a></li>
                                    <li><a href="/models/Macan/GTS/">Macan GTS</a></li>
                                    <li><a href="/models/Macan/Turbo/">Macan Turbo</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="/models/Cayenne/">Cayenne</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/models/Cayenne/Cayenne/">Cayene</a></li>
                                    <li><a href="/models/Cayenne/GTS/">Cayenne GTS</a></li>
                                    <li><a href="/models/Cayenne/Turbo/">Cayenne Turbo</a></li>
                                    <li><a href="/models/Cayenne/E_Hybrid/">Cayenne E-Hybrid</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!--/.dropdown-menu -->
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Услуги и сервис<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/service/">Сервис Porsche</a></li>
                            <li><a href="/about/enterprise/">Корпоративные продажи</a></li>
                            <li><a href="/about/contacts/"><span>Контакты</span></a></li>
                            <li><a href="/feedback/"><span>Обратная связь</span></a></li>
                        </ul>
                    </li>
                    <li><a href="/about/">О компании</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (User::isGuest()): ?>
                        <li><a href="/user/register/"><i class="fa fa-user-md" aria-hidden="true"></i> Регистрация</a></li>
                        <li><a href="/user/login/"><i class="fa fa-sign-in"></i> Вход</a></li>
                    <?php else: ?>
                        <?php if (AdminBase::checkAdmin()): ?>
                            <li><a href="/admin/"><i class="fa fa-eye"></i> Панель администратора</a></li>
                        <?php endif; ?>
                        <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                        <li><a href="/user/logout/"><i class="fa fa-sign-out"></i> Выход</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
</header>