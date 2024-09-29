<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?if (!empty($arResult)):?>
    <ul class="contacts__list ps-0 mb-0">
        <?
        foreach($arResult as $arItem):
        	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) 
        		continue;
        ?>
                <li class="contacts__item">
                    <a
                    class="social__link btn btn-dark focus-ring focus-ring-dark pt-0 pb-1 px-2"
                    aria-current="page"
                    href="<?=$arItem['LINK']?>">
                        <?=$arItem['PARAMS']['SVG']?>
                        <span class="lh-1 align-middle"><?=$arItem['TEXT']?></span>
                    </a>
                </li>
        <?endforeach?>
    </ul>
<?endif?>