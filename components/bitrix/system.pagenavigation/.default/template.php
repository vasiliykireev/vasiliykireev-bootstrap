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

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Begin">
                <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
            </a>
        </li>
	    <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
            </a>
        </li>
	    <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
            </a>
        </li>
    </ul>
</nav>

<?
if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<?/*<font class="text nav-title"><?=$arResult["NavTitle"]?> */?>

<?if($arResult["bDescPageNumbering"] === true): // Если используется обратная навигация?> 

	<?/*<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?><br /></font>*/?>

	<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

	<?/*<font class="text row">*/?>

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>

		    <li class="page-item">
                <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" aria-label="<?=GetMessage("nav_begin")?>">
                    <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                </a>
            </li>
	        <li class="page-item">
                <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                    <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                </a>
            </li>

			<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>
			|
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
			|*/?>
		<?else:?>

		    <li class="page-item">
                <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_begin")?>">
                    <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                </a>
            </li>			
			<?/*<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			|*/?>
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
			    <li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_prev")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>
				<?/*<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
				|*/?>
			<?else:?>
				<li class="page-item">
                <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                    <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                </a>
            </li>
				<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
				|*/?>
			<?endif?>
		<?endif?>
	<?else:?>
		<li class="page-item">
            <a class="page-link disabled" aria-label="<?=GetMessage("nav_begin")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
            </a>
        </li>
    	<li class="page-item">
            <a class="page-link disabled" aria-label="<?=GetMessage("nav_prev")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
            </a>
        </li>
		<?/*=GetMessage("nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("nav_prev")?>&nbsp;|*/?>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<li class="page-item active"><a class="page-link"><?=$NavRecordGroupPrint?></a></li>
			<?/*<b><?=$NavRecordGroupPrint?></b>*/?>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
			<?/*<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>*/?>
		<?else:?>
			<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
			<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>*/?>
		<?endif?>
		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	<?/*|*/?>

	<?if ($arResult["NavPageNomer"] > 1):?>
		<li class="page-item">
            <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_next")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
            </a>
        </li>
	    <li class="page-item">
            <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" aria-label="<?=GetMessage("nav_end")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
            </a>
        </li>
		<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_next")?></a>
		|
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>*/?>
	<?else:?>
		<li class="page-item">
            <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_next")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_end")?>">
                <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
            </a>
        </li>
	<?endif?>

	</ul>
	</nav>

<?else:?>

	<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?><br /></font>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center font-monospace">
    	    <?if ($arResult["NavPageNomer"] > 1):?>
                <?if($arResult["bSavePage"]):?>
    	    		<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
    	    		<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </a>
                    </li>
                <?else:?>
    	    		<li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_begin")?>">
                            <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                        </a>
                    </li>
                	<?if ($arResult["NavPageNomer"] > 2):?>
    	    			<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
                	<?else:?>
    	    			<li class="page-item">
                            <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="<?=GetMessage("nav_prev")?>">
                                <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                        </li>
                	<?endif?>
                <?endif?>
    	    <?else:?>
    	    	<li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_begin")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
    	        <li class="page-item">
                    <a class="page-link disabled" aria-label="<?=GetMessage("nav_prev")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>
    	    <?endif?>
    	    <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
                <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
    	    		<li class="page-item active"><a class="page-link"><?=$arResult["nStartPage"]?></a></li>
                <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
    	    		<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
                <?else:?>
    	    		<li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
                <?endif?>
                <?$arResult["nStartPage"]++?>
            <?endwhile?>
    	    <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    	    	<li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
    	        <li class="page-item">
                    <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
    	    <?else:?>
    	    	<li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_next")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
    	        <li class="page-item">
                    <a class="page-link disabled" href="#" aria-label="<?=GetMessage("nav_end")?>">
                        <span aria-hidden="true"><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
    	    <?endif?>
        </ul>
        <?if ($arResult["bShowAll"]):?>
            <noindex>
        	    <?if ($arResult["NavShowAll"]):?>
	    			<div class="text-center mb-5"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" class="btn btn-outline-primary"><?=GetMessage("nav_paged")?></a></div>
        	    <?else:?>
	    			<div class="text-center mb-5"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" class="btn btn-outline-primary"><?=GetMessage("nav_all")?></a></div>
        	    <?endif?>
            </noindex>
        <?endif?>
    </nav>
<?endif?>
<?/*?>
	<font class="text row-2">

	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a>
			|
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
			|
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			|
			<?if ($arResult["NavPageNomer"] > 2):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
			<?endif?>
			|
		<?endif?>

	<?else:?>
		<?=GetMessage("nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("nav_prev")?>&nbsp;|
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<b><?=$arResult["nStartPage"]?></b>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	|

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_next")?></a>&nbsp;|
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a>
	<?else:?>
		<?=GetMessage("nav_next")?>&nbsp;|&nbsp;<?=GetMessage("nav_end")?>
	<?endif?>

<?endif?>


<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>?>
<?endif?>
<? /*
</font>
*/?>