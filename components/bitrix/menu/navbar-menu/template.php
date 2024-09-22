<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
        <ul class="navbar-menu__list navbar-nav mb-2 mb-lg-0">
        <?
        foreach($arResult as $arItem):
        	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        		continue;
        ?>
        	<?if($arItem["SELECTED"]):?>
                <li class="navbar-menu__item nav-item px-1">
                    <a class="navbar-menu__link btn btn-dark focus-ring focus-ring-dark fw-semibold" href="<?=$arItem["LINK"]?>">
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
<?endif?>