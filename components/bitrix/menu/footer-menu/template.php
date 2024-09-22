<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
    <ul class="footer-menu__list nav flex-column flex-md-row align-items-start justify-content-xl-end justify-content-start">
        <?
        foreach($arResult as $arItem):
        	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        		continue;
        ?>
        	<?if($arItem["SELECTED"]):?>
                <li class="footer-menu__item mb-2 px-1">
                    <a class="footer-menu__link btn btn-outline-light py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="<?=$arItem["LINK"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
	        <?else:?>
                <li class="footer-menu__item mb-2 px-1">
                    <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="<?=$arItem["LINK"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
	        <?endif?>
        <?endforeach?>
    </ul>
<?endif?>
                <!-- <ul class="footer-menu__list nav flex-column flex-md-row align-items-start justify-content-xl-end justify-content-start">
                    <li class="footer-menu__item mb-2">
                        <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="#first-screen">Наверх</a>
                    </li>
                    <li class="footer-menu__item mb-2">
                        <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="#skills">Навыки</a>
                    </li>
                    <li class="footer-menu__item mb-2">
                        <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="#projects">Проекты</a>
                    </li>
                    <li class="footer-menu__item mb-2">
                        <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="#portfolio">Портфолио</a>
                    </li>
                    <li class="footer-menu__item mb-2">
                        <a class="footer-menu__link btn btn-dark py-0 py-md-2 px-2 focus-ring focus-ring-dark" href="#solutions">Решения</a>
                    </li>
                </ul> -->
