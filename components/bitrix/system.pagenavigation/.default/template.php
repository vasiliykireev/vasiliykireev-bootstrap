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
<nav aria-label="<?=GetMessage("nav_name")?>">
	<ul class="pagination justify-content-center mt-3">
        <?if($arResult['bDescPageNumbering'] === true): // Если используется обратная навигация?> 
            <?if ($arResult['NavPageNomer'] < $arResult['NavPageCount']):?>
            	<?if($arResult['bSavePage']):?>
            	    <li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['NavPageCount']?>" aria-label="<?=GetMessage('nav_begin')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>" aria-label="<?=GetMessage('nav_prev')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </a>
                    </li>
            	<?else:?>
            	    <li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage('nav_begin')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>			
            		<?if ($arResult['NavPageCount'] == ($arResult['NavPageNomer']+1) ):?>
            		    <li class="page-item">
                            <a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage('nav_prev')?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
            		<?else:?>
            			<li class="page-item">
                            <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>" aria-label="<?=GetMessage('nav_prev')?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
            		<?endif?>
            	<?endif?>
            <?else:?>
            	<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage('nav_begin')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
            	<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage('nav_prev')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>
            <?endif?>
            <?while($arResult['nStartPage'] >= $arResult['nEndPage']):?>
            	<?$NavRecordGroupPrint = $arResult['NavPageCount'] - $arResult['nStartPage'] + 1;?>
            	<?if ($arResult['nStartPage'] == $arResult['NavPageNomer']):?>
            		<li class="page-item active"><a class="page-link"><?=$NavRecordGroupPrint?></a></li>
            	<?elseif($arResult['nStartPage'] == $arResult['NavPageCount'] && $arResult['bSavePage'] == false):?>
            		<li class="page-item"><a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
            	<?else:?>
            		<li class="page-item"><a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['nStartPage']?>"><?=$NavRecordGroupPrint?></a></li>
            	<?endif?>
            	<?$arResult['nStartPage']--?>
            <?endwhile?>
            <?if ($arResult['NavPageNomer'] > 1):?>
            	<li class="page-item">
                    <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>" aria-label="<?=GetMessage('nav_next')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=1" aria-label="<?=GetMessage('nav_end')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
            <?else:?>
            	<li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage('nav_next')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage('nav_end')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
            <?endif?>
    </ul>
</nav>
        <?else:?>
            <?if ($arResult['NavPageNomer'] > 1):?>
                <?if($arResult['bSavePage']):?>
            		<li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=1" aria-label="<?=GetMessage('nav_begin')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
            		<li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>" aria-label="<?=GetMessage('nav_prev')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </a>
                    </li>
                <?else:?>
            		<li class="page-item">
                        <a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage('nav_begin')?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
                	<?if ($arResult['NavPageNomer'] > 2):?>
            			<li class="page-item">
                            <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']-1)?>" aria-label="<?=GetMessage('nav_prev')?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
                	<?else:?>
            			<li class="page-item">
                            <a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage('nav_prev')?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
                	<?endif?>
                <?endif?>
            <?else:?>
            	<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage('nav_begin')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage('nav_prev')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>
            <?endif?>
            <?while($arResult['nStartPage'] <= $arResult['nEndPage']):?>
                <?if ($arResult['nStartPage'] == $arResult['NavPageNomer']):?>
            		<li class="page-item active"><a class="page-link"><?=$arResult['nStartPage']?></a></li>
                <?elseif($arResult['nStartPage'] == 1 && $arResult['bSavePage'] == false):?>
            		<li class="page-item"><a class="page-link" href="<?=$arResult['sUrlPath']?><?=$strNavQueryStringFull?>"><?=$arResult['nStartPage']?></a></li>
                <?else:?>
            		<li class="page-item"><a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['nStartPage']?>"><?=$arResult['nStartPage']?></a></li>
                <?endif?>
                <?$arResult['nStartPage']++?>
            <?endwhile?>
            <?if($arResult['NavPageNomer'] < $arResult['NavPageCount']):?>
            	<li class="page-item">
                    <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=($arResult['NavPageNomer']+1)?>" aria-label="<?=GetMessage('nav_next')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>PAGEN_<?=$arResult['NavNum']?>=<?=$arResult['NavPageCount']?>" aria-label="<?=GetMessage('nav_end')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
            <?else:?>
            	<li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage('nav_next')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage('nav_end')?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
            <?endif?>
    </ul>
            <?if ($arResult['bShowAll']):?>
                <noindex>
            	    <?if ($arResult['NavShowAll']):?>
        				<div class="text-center mb-5"><a href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult['NavNum']?>=0" class="btn btn-outline-primary"><?=GetMessage('nav_paged')?></a></div>
            	    <?else:?>
        				<div class="text-center mb-5"><a href="<?=$arResult['sUrlPath']?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult['NavNum']?>=1" class="btn btn-outline-primary"><?=GetMessage('nav_all')?></a></div>
            	    <?endif?>
                </noindex>
            <?endif?>
</nav>
        <?endif?>