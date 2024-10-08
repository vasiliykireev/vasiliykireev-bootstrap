<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
    <ul class="social__list ps-0 mb-0">
        <?
        foreach($arResult as $arItem):
        	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) 
        		continue;
        ?>
                <li class="social__item d-inline-block">
                    <a
                    class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2"
                    aria-current="page"
                    href="<?=$arItem['LINK']?>"
                    target="_blank"
                    title="<?=$arItem['TEXT']?>">
                        <?=$arItem['PARAMS']['SVG']?>
                    </a>
                </li>
        <?endforeach?>
    </ul>
<?endif?>