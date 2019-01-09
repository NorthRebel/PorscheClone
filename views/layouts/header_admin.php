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
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Модели<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/models">Линейки</a></li>
                            <li><a href="/admin/submodels">Модели</a></li>
                        </ul>
                    </li>
                    <li><a href="/admin/purchases">Заказы</a></li>
                    <li><a href="/admin/feedback">Обратная связь</a></li>
                    <li><a href="/admin/users">Пользователи</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/"><i class="fa fa-sign-out"></i>На сайт</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>
</header>