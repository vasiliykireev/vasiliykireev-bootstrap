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

<section class="thumbnails pt-3 pb-5">
    <div class="thumbnails__container container">
		<?if($arResult["NAME"]):?>
            <div class="thumbnails__header-row row justify-content-center pt-3 pb-5">
                <div class="thumbnails__header-column col-auto text-center">
                    <h2 class="thumbnails__heading"><?=$arResult["NAME"]?></h2>
					<?if($arResult["DESCRIPTION"]):?>
					    <p class="text text-body-secondary"><?=$arResult["DESCRIPTION"]?></p>
					<?endif?>
                </div>
            </div>
		<?endif?>
        <div class="thumbnails__grid row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-4 gy-5 justify-content-center align-items-center">
		    <?foreach($arResult["ITEMS"] as $arItem):?>
                <div class="thumbnail col"id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="thumbnail__card card border-0">
						<?if(isset($arItem["DISPLAY_PROPERTIES"]["CODE_SVG"]["VALUE"])):?>
                            <div class="thumbnail__icon text-center text-primary">
					    	    <?=$arItem["DISPLAY_PROPERTIES"]["CODE_SVG"]["~VALUE"]?>
                            </div>
						<?elseif(isset($arItem["PREVIEW_PICTURE"]["SAFE_SRC"])):?>
							<img class="thumbnail__image" src="<?=$arItem["PREVIEW_PICTURE"]["SAFE_SRC"]?>" alt="" title="">
					    <?endif?>
                        <div class="thumbnail__caption card-body">
							<?if($arItem["NAME"]):?>
                                <h3 class="thumbnail__heading mt-3 mb-2 text-center"><?=$arItem["NAME"]?></h3>
							<?endif?>
							<?if($arItem["PREVIEW_TEXT"]):?>
                                <p class="thumbnail__text text-center text-body-secondary"><?=$arItem["PREVIEW_TEXT"]?></p>
							<?endif?>
                        </div>
                    </div>
                </div>
                <!-- <div class="col thumbnail__spacer"></div> -->
			<?endforeach;?>
        </div>
    </div>
</section>
<div class="accordion" id="accordion-debug">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-debug" aria-expanded="false" aria-controls="collapse-debug">
        Debug
      </button>
    </h2>
    <div id="collapse-debug" class="accordion-collapse collapse" data-bs-parent="#accordion-debug">
      <div class="accordion-body">
	    <pre>
        	<?print_r($arResult)?>
        </pre>
      </div>
    </div>
  </div>
</div>
<div class="accordion" id="accordion-original">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-original" aria-expanded="false" aria-controls="collapse-original">
        Original
      </button>
    </h2>
    <div id="collapse-original" class="accordion-collapse collapse" data-bs-parent="#accordion-original">
      <div class="accordion-body">
	    <pre>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

</pre>
      </div>
    </div>
  </div>
</div>

<hr>