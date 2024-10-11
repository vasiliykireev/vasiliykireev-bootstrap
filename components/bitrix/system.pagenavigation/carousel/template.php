<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
if(!$arResult['NavShowAlways'])
{
	if ($arResult['NavRecordCount'] == 0 || ($arResult['NavPageCount'] == 1 && $arResult['NavShowAll'] == false))
		return;
}
$strNavQueryString = ($arResult['NavQueryString'] != "" ? $arResult['NavQueryString']."&amp;" : "");
$strNavQueryStringFull = ($arResult['NavQueryString'] != "" ? "?".$arResult['NavQueryString'] : "");
?>
<?if($arResult['bDescPageNumbering'] === true): // Если используется обратная навигация?>
	<div class="carousel-indicators mb-0">
        <?while($arResult['nStartPage'] >= $arResult['nEndPage']):?>
        	<?$NavRecordGroupPrint = $arResult['NavPageCount'] - $arResult['nStartPage'] + 1;?>
        	<?if ($arResult['nStartPage'] == $arResult['NavPageNomer']):?>
	    		<a type="button" data-bs-target="#carouselIndicators" class="active" aria-current="true" aria-label="<?=$NavRecordGroupPrint?>"></a>
        	<?elseif($arResult['nStartPage'] == $arResult['NavPageCount'] && $arResult['bSavePage'] == false):?>
	    		<a type="button" data-bs-target="#carouselIndicators" aria-label="<?=$NavRecordGroupPrint?>"
	    		href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>"></a>
        	<?else:?>
	    		<a type="button" data-bs-target="#carouselIndicators" aria-label="<?=$NavRecordGroupPrint?>"
	    		href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['nStartPage']?>"></a>
        	<?endif?>
        	<?$arResult['nStartPage']--?>
        <?endwhile?>
	</div>
    <?if ($arResult['NavPageNomer'] < $arResult['NavPageCount']):?>
    	<?if($arResult['bSavePage']):?>
			<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
            href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
            </a>
    	<?else:?>	
    		<?if ($arResult['NavPageCount'] == ($arResult['NavPageNomer']+1) ):?>
				<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
                </a>
    		<?else:?>
				<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
                </a>
    		<?endif?>
    	<?endif?>
    <?else:?>
		<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
        href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=1">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?=GetMessage('nav_end')?></span>
        </a>
    <?endif?>
    <?if ($arResult['NavPageNomer'] > 1):?>
		<a type="button" class="carousel-button carousel-button__page__right carousel-control-next"
        href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?=GetMessage('nav_next')?></span>
        </a>
    <?else:?>
		<a type="button" class="carousel-button carousel-button__page__right carousel-control-next"
        href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?=GetMessage('nav_begin')?></span>
        </a>
    <?endif?>
<?else:?>
    <noindex>
        <div class="carousel-indicators mb-0 d-none d-xl-flex">
            <?while($arResult['nStartPage'] <= $arResult['nEndPage']):?>
                <?if ($arResult['nStartPage'] == $arResult['NavPageNomer']):?>
                    <a type="button" rel="nofollow" data-bs-target="#carouselIndicators" class="active" aria-current="true" aria-label="<?=$arResult['nStartPage']?>"></a>
                <?elseif($arResult['nStartPage'] == 1 && $arResult['bSavePage'] == false):?>
                    <a type="button" rel="nofollow" data-bs-target="#carouselIndicators" aria-label="<?=$arResult['nStartPage']?>"
                    href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>"></a>
                <?else:?>
                    <a type="button" rel="nofollow" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="<?=$arResult['nStartPage']?>"
                    href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['nStartPage']?>"></a>
                <?endif?>
                <?$arResult['nStartPage']++?>
            <?endwhile?>
        </div>
        <?if ($arResult['NavPageNomer'] > 1):?>
            <?if($arResult['bSavePage']):?>
                <a type="button" rel="nofollow" class="carousel-button carousel-button__page__left d-none d-xl-flex carousel-control-prev"
                href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
                </a>
            <?else:?>
            	<?if ($arResult['NavPageNomer'] > 2):?>
                    <a type="button" rel="nofollow" class="carousel-button carousel-button__page__left d-none d-xl-flex carousel-control-prev"
                    href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
                    </a>
            	<?else:?>
                    <a type="button" rel="nofollow" class="carousel-button carousel-button__page__left d-none d-xl-flex carousel-control-prev"
                    href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"><?=GetMessage('nav_prev')?></span>
                    </a>
            	<?endif?>
            <?endif?>
        <?else:?>
            <a type="button" rel="nofollow" class="carousel-button carousel-button__page__left d-none d-xl-flex carousel-control-prev"
            href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['NavPageCount']?>">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?=GetMessage('nav_end')?></span>
            </a>
        <?endif?>
        <?if($arResult['NavPageNomer'] < $arResult['NavPageCount']):?>
            <a type="button" rel="nofollow" class="carousel-button carousel-button__page__right d-none d-xl-flex carousel-control-next"
            href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?=GetMessage('nav_next')?></span>
            </a>
        <?else:?>
            <a type="button" rel="nofollow" class="carousel-button carousel-button__page__right d-none d-xl-flex carousel-control-next"
            href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=1">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?=GetMessage('nav_begin')?></span>
            </a>
        <?endif?>
    </noindex>
    <?if ($arResult['bShowAll']):?>
        <noindex>
    	    <?if ($arResult['NavShowAll']):?>
				<div class="text-center d-xl-none mb-5"><a rel="nofollow" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult['NavNum']?>=0" class="btn btn-outline-primary"><?=GetMessage('nav_paged')?></a></div>
    	    <?else:?>
				<div class="text-center d-xl-none mb-5"><a rel="nofollow" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult['NavNum']?>=1" class="btn btn-outline-primary"><?=GetMessage('nav_all')?></a></div>
    	    <?endif?>
        </noindex>
    <?endif?>
<?endif?>