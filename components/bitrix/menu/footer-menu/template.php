<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
    <button class="header__toggle navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Раскрыть меню">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="header__navbar-menu navbar-menu collapse navbar-collapse" id="navbar-menu">
        <ul class="navbar-menu__list navbar-nav ms-auto mb-2 mb-lg-0">
        <?
        foreach($arResult as $arItem):
        	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        		continue;
        ?>
        	<?if($arItem["SELECTED"]):?>
                <li class="navbar-menu__item nav-item px-1">
                    <a class="navbar-menu__link btn btn-outline-light focus-ring focus-ring-dark" href="<?=$arItem["LINK"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
	        <?else:?>
                <li class="navbar-menu__item nav-item px-1">
                    <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark" href="<?=$arItem["LINK"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
	        <?endif?>
        <?endforeach?>
        </ul>
    </div>
<?endif?>