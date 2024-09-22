<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
    <ul class="contacts__list ps-0 mb-0">
        <?
        foreach($arResult as $arItem):
        	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        		continue;
        ?>
                <li class="contacts__item">
                    <a
                    class="social__link btn btn-dark focus-ring focus-ring-dark pt-0 pb-1 px-2"
                    aria-current="page"
                    href="<?=$arItem["LINK"]?>">
                        <?=$arItem["PARAMS"]["SVG"]?>
                        <span class="lh-1 align-middle"><?=$arItem["TEXT"]?></span>
                    </a>
                </li>
        <?endforeach?>
    </ul>
<?endif?>
                    <!-- <ul class="contacts__list ps-0 mb-0">
                        <li class="contacts__item contacts__item_link_mailto">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark pt-0 pb-1 px-2" aria-current="page" href="mailto:hello@vasiliykvasov.ru">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/></svg>
                            <span class="lh-1 align-middle">hello@vasiliykvasov.ru</span>
                            </a>
                        </li>
                    </ul> -->