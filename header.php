<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- To Do: Add Favicon -->
    <!-- To Do: Add Title and Open Graph -->
    <!-- To Do: Add Conters to Head and Body-->
    <!-- To Do: Add Styles correctly -->
    <!-- Styles -->
    <link rel="stylesheet" href="https://projects.vasiliykvasov.ru/bootstrap-5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Head -->
    <!-- Check: Title -->
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <? $APPLICATION->ShowHead();  ?>
</head>
<body>
<div id="panel">
	<? $APPLICATION->ShowPanel(); ?> 
</div>
    <header class="header">
        <nav class="navbar navbar-expand-lg text-bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <? if ($APPLICATION->GetCurPage(false) === '/'): ?>
                    <span class="header__brand navbar-brand fw-semibold focus-ring focus-ring-light ps-2 pe-2 rounded-2">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    	"AREA_FILE_SHOW" => "sect",
                    	"AREA_FILE_SUFFIX" => "brand",
                    	"AREA_FILE_RECURSIVE" => "Y",
                    	"EDIT_TEMPLATE" => "sect_brand.php"
                    	),
                    	false
                    );?>
                    </a>
                <? else: ?>
                    <a class="header__brand navbar-brand fw-semibold focus-ring focus-ring-light ps-2 pe-2 rounded-2" href="/">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    	"AREA_FILE_SHOW" => "sect",
                    	"AREA_FILE_SUFFIX" => "brand",
                    	"AREA_FILE_RECURSIVE" => "Y",
                    	"EDIT_TEMPLATE" => "sect_brand.php"
                    	),
                    	false
                    );?>
                    </a>
                <? endif; ?>
                <button class="header__toggle navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Раскрыть меню">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="header__navbar-menu navbar-menu collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-menu__list navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="navbar-menu__item nav-item px-1">
                            <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark" href="#skills">Навыки</a>
                        </li>
                        <li class="navbar-menu__item nav-item px-1">
                            <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark" href="#projects">Проекты</a>
                        </li>
                        <li class="navbar-menu__item nav-item px-1">
                            <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark" href="#portfolio">Портфолио</a>
                        </li>
                        <li class="navbar-menu__item nav-item px-1">
                            <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark" href="#solutions">Решения</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>