<?php

// Параметры роутинга
return array(
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    // Админпанель:
    // Страница участков
    'admin/uchastok/create' => 'adminUchastok/create',
    'admin/uchastok/update/([0-9]+)' => 'adminUchastok/update/$1',
    'admin/uchastok/delete/([0-9]+)' => 'adminUchastok/delete/$1',
    'admin/uchastok/([0-9]+)' => 'adminUchastok/view/$1', #Просмотр определённого участка

    // Страница садоводов
    'admin/sadovod/create' => 'adminSadovod/create',
    'admin/sadovod/update/([0-9]+)' => 'adminSadovod/update/$1',
    'admin/sadovod/delete/([0-9]+)' => 'adminSadovod/delete/$1',
    'admin/sadovod/([0-9]+)' => 'adminSadovod/view/$1', # Просмотр определённого садовода

    // Страница контактов
    'admin/contact/create' => 'adminContact/create',
    'admin/contact/update/([0-9]+)' => 'adminContact/update/$1',
    'admin/contact/delete/([0-9]+)' => 'adminContact/delete/$1',

    // Страница показаний электросчётчиков
    'admin/electro/create' => 'adminElectro/create',
    'admin/electro/delete/([0-9]+)' => 'adminElectro/delete/$1',

    # Страницы сайта
    // Контакты
    'contacts' => 'site/contacts',

    // Расписание маршруток
    'buses' => 'site/buses',

    // Тарифы
    'tarif' => 'site/tarif',

    // Расписание полива
    'poliv' => 'site/poliv',

    // Расписание конторы
    'grafik' => 'site/grafik',

    // Список участков
    'uchastki' => 'site/uchastki',

     // Список садоводов, живущих в СВТ
    'sadovods_svt' => 'site/sadovodsSvt', # Все садоводы, живущие в СВТ

    // Список садоводов
    'sadovods' => 'site/sadovods',

    // Показания счётчиков элетроэнергии
    'electro' => 'site/electro',
    
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);