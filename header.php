<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <?$APPLICATION->AddHeadString('<link type="image/x-icon" href="favicon/vasiliykvasov-favicon.svg" rel="shortcut icon">')?>
    <?$APPLICATION->AddHeadString('<link type="Image/x-icon" href="favicon/vasiliykvasov-favicon.svg" rel="icon">')?>
    <!-- To Do: Add Counters to Head and Body-->
    <!-- External styles -->
    <?$APPLICATION->AddHeadString('<link rel="stylesheet" href="https://projects.vasiliykvasov.ru/bootstrap-5.3.1/dist/css/bootstrap.min.css">')?>
    <?$APPLICATION->AddHeadString('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">')?>
    <!-- Title -->
    <title><? $APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead()?>
    <?$APPLICATION->ShowMeta("og:title")?>
    <?$APPLICATION->ShowMeta("og:description")?>
    <?$APPLICATION->ShowMeta("og:image")?>
    <?$APPLICATION->ShowMeta("og:type")?>
    <?$APPLICATION->ShowMeta("og:url")?>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="panel">
	    <? $APPLICATION->ShowPanel(); ?> 
    </div>
    <header class="header">
        <nav class="navbar navbar-expand-lg text-bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <? // Brand
                if ($APPLICATION->GetCurPage(false) === '/'): ?>
                    <span class="brand navbar-brand fw-semibold focus-ring focus-ring-light ps-2 pe-2 rounded-2">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                        	"AREA_FILE_SHOW" => "sect",
                        	"AREA_FILE_SUFFIX" => "brand",
                        	"AREA_FILE_RECURSIVE" => "Y",
                        	"EDIT_TEMPLATE" => "sect_brand.php"
                        	),
                        	false
                        );?>
                    </span>
                <? else: ?>
                    <a class="brand navbar-brand fw-semibold focus-ring focus-ring-light ps-2 pe-2 rounded-2" href="/">
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
                <button class="header__toggle navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="<?=GetMessage('TOGGLE_NAVIGATION')?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="header__navbar-menu navbar-menu collapse navbar-collapse" id="navbar-menu">
                    <div class="ms-auto">
                    <? // Top menu
                    $APPLICATION->IncludeComponent(
	                    "bitrix:menu", 
	                    "navbar-menu", 
	                    array(
	                    	"ROOT_MENU_TYPE" => "top",
	                    	"MAX_LEVEL" => "1",
	                    	"CHILD_MENU_TYPE" => "left",
	                    	"USE_EXT" => "Y",
	                    	"COMPONENT_TEMPLATE" => "navbar-menu",
	                    	"MENU_CACHE_TYPE" => "N",
	                    	"MENU_CACHE_TIME" => "3600",
	                    	"MENU_CACHE_USE_GROUPS" => "Y",
	                    	"MENU_CACHE_GET_VARS" => array(
	                    	),
	                    	"DELAY" => "N",
	                    	"ALLOW_MULTI_SELECT" => "N"
	                    ),
	                    false
                    );?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>