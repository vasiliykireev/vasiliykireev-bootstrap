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

<section class="certificates pt-3 pb-5">
	<div class="carousel carousel-dark">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
    	<?=$arResult["NAV_STRING"]?><br />
    <?endif;?>
	<div class="carousel-inner">
    <div class="certificates__container container">
        <div class="certificates__header row justify-content-center pt-3 pb-5">
            <div class="col-auto">
                <h2 class="certificates__heading">Мои решения</h2>
            </div>
        </div>
        <div class="certificates__grid row row-cols-1 row-cols-lg-3 mx-5 gx-4 gy-5 justify-content-center align-items-start">


<?/*<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>*/?>
            <?foreach($arResult["ITEMS"] as $arItem):?>
            	<?
            	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            	?>
            

                <div class="certificate col">
                    <div class="certificate__card card border-0">
                        <div class="certificate__icon text-center text-primary">
							<?if(isset($arItem["PREVIEW_PICTURE"]["SAFE_SRC"])):?>
                                <img
								class="certificate__image"
								src="<?=$arItem["PREVIEW_PICTURE"]["SAFE_SRC"]?>"
								alt="..."
								title="..."
								loading="lazy">
							<?endif?>
                        </div>
                        <div class="certificate__caption card-body">
                            <h3 class="certificate__heading mt-3 mb-2 text-center text-lines text-lines__amount__2 align-middle"><?=$arItem["NAME"]?></h3>
                            <p class="certificate__text text-center text-body-secondary text-lines__amount__2"><?=$arItem["PREVIEW_TEXT"]?></p>
                        </div>
                    </div>
                </div>

	        <?/*<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	        	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
	        		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
	        			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
	        					class="preview_picture"
	        					border="0"
	        					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
	        					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
	        					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
	        					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
	        					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
	        					style="float:left"
	        					/></a>
	        		<?else:?>
	        			<img
	        				class="preview_picture"
	        				border="0"
	        				src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
	        				width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
	        				height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
	        				alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
	        				title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
	        				style="float:left"
	        				/>
	        		<?endif;?>
	        	<?endif?>
	        	<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
	        		<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
	        	<?endif?>
	        	<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
	        		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
	        			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
	        		<?else:?>
	        			<b><?echo $arItem["NAME"]?></b><br />
	        		<?endif;?>
	        	<?endif;?>
	        	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
	        		<?echo $arItem["PREVIEW_TEXT"];?>
	        	<?endif;?>
	        	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
	        		<div style="clear:both"></div>
	        	<?endif?>
	        	<?foreach($arItem["FIELDS"] as $code=>$value):?>
	        		<small>
	        		<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
	        		</small><br />
	        	<?endforeach;?>
	        	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
	        		<small>
	        		<?=$arProperty["NAME"]?>:&nbsp;
	        		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
	        			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
	        		<?else:?>
	        			<?=$arProperty["DISPLAY_VALUE"];?>
	        		<?endif?>
	        		</small><br />
	        	<?endforeach;?>
	        </p>*/?>
            <?endforeach;?>
        </div>
    </div>
	</div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>


	</div>
</section>
<?/*</div>*/?>
<?/*<pre>
    <? print_r($arResult)?>
</pre>*/?>
