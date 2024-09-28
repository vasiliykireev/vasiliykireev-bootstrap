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
if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

        <?if($arResult["bDescPageNumbering"] === true): // Если используется обратная навигация?>
			<div class="carousel-indicators">
            <?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
            	<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
            	<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
					<a type="button" data-bs-target="#carouselIndicators" class="active" aria-current="true" aria-label="<?=$NavRecordGroupPrint?>"></a>
            		<?/*<li class="page-item active"><a class="page-link"><?=$NavRecordGroupPrint?></a></li>*/?>
            	<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
					<a type="button" data-bs-target="#carouselIndicators" aria-label="<?=$NavRecordGroupPrint?>"
					href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
            		<?/*<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>*/?>
            	<?else:?>
					<a type="button" data-bs-target="#carouselIndicators" aria-label="<?=$NavRecordGroupPrint?>"
					href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"></a>
            		<?/*<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>*/?>
            	<?endif?>
            	<?$arResult["nStartPage"]--?>
            <?endwhile?>
			</div>
            <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
            	<?if($arResult["bSavePage"]):?>
					<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                    href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                    </a>
            	    <?/*<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </a>
                    </li>*/?>
            	<?else:?>
            	    <?/*<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>*/?>		
            		<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
						<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                        href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                        </a>
            		    <?/*<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>*/?>
            		<?else:?>
						<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                        href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                        </a>
            			<?/*<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>*/?>
            		<?endif?>
            	<?endif?>
            <?else:?>
				<a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_end")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_begin")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
            	<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_prev")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>*/?>
            <?endif?>
            <?if ($arResult["NavPageNomer"] > 1):?>
				<a type="button" class="carousel-button carousel-button__page__left carousel-control-next"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_next")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>*/?>
            <?else:?>
				<a type="button" class="carousel-button carousel-button__page__left carousel-control-next"
                href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_begin")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>*/?>
            <?endif?>
        <?else:?>
            <div class="carousel-indicators">
                <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
                    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <a type="button" data-bs-target="#carouselIndicators" class="active" aria-current="true" aria-label="<?=$arResult["nStartPage"]?>"></a>
                		<?/*<li class="page-item active"><a class="page-link"><?=$arResult["nStartPage"]?></a></li>*/?>
                    <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                        <a type="button" data-bs-target="#carouselIndicators" aria-label="<?=$arResult["nStartPage"]?>"
                        href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
                		<?/*<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>*/?>
                    <?else:?>
                        <a type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="<?=$arResult["nStartPage"]?>"
                        href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"></a>
                		<?/*<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>*/?>
                    <?endif?>
                    <?$arResult["nStartPage"]++?>
                <?endwhile?>
            </div>
            <?if ($arResult["NavPageNomer"] > 1):?>
                <?if($arResult["bSavePage"]):?>

                    <a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                    href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                    </a>
            		<?/*<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
            		<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </a>
                    </li>*/?>
                <?else:?>
            		<?/*<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>*/?>
                	<?if ($arResult["NavPageNomer"] > 2):?>
                        <a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                        href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                        </a>
            			<?/*<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>*/?>
                	<?else:?>
                        <a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                        href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden"><?=GetMessage("nav_prev")?></span>
                        </a>
            			<?/*<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>*/?>
                	<?endif?>
                <?endif?>
            <?else:?>
                <a type="button" class="carousel-button carousel-button__page__left carousel-control-prev"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_end")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_begin")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_prev")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>*/?>
            <?endif?>
            <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                <a type="button" class="carousel-button carousel-button__page__left carousel-control-next"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_next")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>*/?>
            <?else:?>
                <a type="button" class="carousel-button carousel-button__page__left carousel-control-next"
                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?=GetMessage("nav_begin")?></span>
                </a>
            	<?/*<li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>*/?>
            <?endif?>
            <?if ($arResult["bShowAll"]):?>
                <noindex>
            	    <?if ($arResult["NavShowAll"]):?>
        				<div class="text-center mb-5"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" class="btn btn-outline-primary"><?=GetMessage("nav_paged")?></a></div>
            	    <?else:?>
        				<div class="text-center mb-5"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" class="btn btn-outline-primary"><?=GetMessage("nav_all")?></a></div>
            	    <?endif?>
                </noindex>
            <?endif?>
        <?endif?>