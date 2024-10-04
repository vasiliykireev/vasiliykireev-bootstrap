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

<div class="articles mt-3 mb-3">
    <div class="articles__container container">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	        <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?if(($arParams["DISPLAY_HEADER"] == 'Y') && ((($arResult["SECTION"]["PATH"] ?? '') !== '') || (($arResult["NAME"] ?? '') !== ''))):?>
        	<div class="articles__header-row row justify-content-center pt-3 pb-2">
                <div class="articles__header-col col-auto">
                    <h1 class="articles__heading">
        			    <?if(($arResult["SECTION"]["PATH"] ?? '') !== ''):?>
        			        <?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["NAME"]?></h1>
        			    <?elseif(($arResult["NAME"] ?? '') !== ''):?>
        			        <?=$arResult["NAME"]?>
        			    <?endif?>
        			</h1>
                </div>
            </div>
        <?endif?>
    <?if($arParams['DISPLAY_SECTIONS'] == "Y"):?>
        <div class="articles__sections-row row justify-content-center">
			<div class="articles__sections-col col-12 col-md-10 col-lg-8 col-xl-12 col-xxl-11 mb-5">
				<?if(($arParams['DISPLAY_SECTIONS_BUTTONS'] == 'Y') && !isset($arResult["SECTION"]["PATH"]) && ($arResult["SECTIONS"] ?? '') !== ''):?>
					<?foreach($arResult["SECTIONS"] as $arSection):?>
                         <?if($arSection["ELEMENT_CNT"] > 0):?>
							<a class="articles__section-button btn btn-outline-primary" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
						 <?endif?>
					<?endforeach?>
                <?elseif((($arResult["SECTION"]["PATH"] ?? '') !== '') && ($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["SECTIONS"]?? '') !== ''):?>
					<?foreach($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["SECTIONS"] as $arSection):?>
                        <a class="articles__section-button btn btn-outline-primary mb-1" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
					<?endforeach?>
				<?endif?>
			</div>
        </div>
    <?endif?>
            <div class="articles__grid row gx-4 gy-5 justify-content-center align-items-center">
			    <?foreach($arResult["ITEMS"] as $arItem):?>
					<?
                        $isShowDetailLink = ($arParams['DISPLAY_DETAIL_LINK'] == "Y") && (($arItem["DETAIL_PAGE_URL"] ?? '') !== '') && !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] && $arResult["USER_HAVE_ACCESS"];
                        $isExistExternalLinkCaption = ($arItem['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE'] ?? '') !== '';
                        $isExistExternalLinkDefaultCaption = ($arParams['DEFAULT_EXTERNAL_LINK_CAPTION'] ?? '') !== '';
                        $isShowExternalLink = ($arParams['DISPLAY_EXTERNAL_LINK'] == "Y") &&
                            (($arItem['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE'] ?? '') !== '') &&
                            ($isExistExternalLinkCaption || $isExistExternalLinkDefaultCaption);
                        $isShowLinks = $isShowDetailLink || $isShowExternalLink;
                    ?>
	                <?
	                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	                ?>
                    <div class="article col-12 col-md-10 col-lg-8 col-xl-12 col-xxl-11" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="article__card card mb-3 border-0">
                            <div class="article__row row justify-content-center align-items-stretch">
								<div class="article__image col-xl-6 col-xxl-5 text-center d-flex flex-column justify-content-end">
									<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
		                            	<?if($isShowDetailLink):?>
		                            		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<?endif?>
			    				    	<picture class="article__picture">
						                <?if(($arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X'] ?? '') !== ''):?>
                                            <source
                                            type="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['CONTENT_TYPE']?>"
						                    srcset="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['SRC']?>"
						                    class="article__image-source article-screen__image-source_size_2x"
                                            media="(min-width: 576px) and (-webkit-min-device-pixel-ratio: 1.5)" />
						                <?endif?>
						                <?if(($arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP'] ?? '') !== ''):?>
                                            <source
                                            type="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['CONTENT_TYPE']?>"
						                    srcset="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['SRC']?>"
                                            class="article__image-source article-screen__image-source_size_normal">
						                <?endif?>
                                            <img
                                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                            class="article__image img-fluid rounded"
                                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                            loading="lazy">
                                        </picture>
										<?if($isShowDetailLink):?>
										    </a>
		                            	<?endif;?>
		                            <?endif?>
								</div>
                                <div class="article__card-body col col-xl-6 col-xxl-7 card-body pt-xl-0 pb-xl-0 d-flex flex-column <?
								    if($isShowLinks && ($arParams["DISPLAY_SECTIONS_BUTTONS"] == 'Y') && ($arParams['DISPLAY_SECTIONS'] == "Y")){
                                        echo 'justify-content-between';
								    } elseif(!$isShowLinks && $arParams["DISPLAY_SECTIONS_BUTTONS"] == 'Y') {
										echo 'justify-content-evenly';
									} else {
								    	echo 'justify-content-evenly';
								    }
								?>">
                                    <?/*<div class="card-body pt-xl-0 pb-xl-0 px-0 px-xl-3 d-flex flex-column h-100 justify-content-between">*/?>
									    <?if($arParams['DISPLAY_SECTIONS'] == "Y" && $arParams["DISPLAY_SECTIONS_BUTTONS"]):?>
									        <div class="article__badges text-center text-xl-start">
									        	<?foreach($arItem["SECTIONS"] as $arSection):?>
                                                    <a class="article__badge btn btn-outline-primary btn-sm mb-1" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
									        	<?endforeach?>
									        </div>
									    <?endif?>
                                        <div class="article__announce">
									    	<?if(($arItem["NAME"] ?? '') !== ''):?>
									    		<h2 class="h4 article__heading card-title text-center text-xl-start text-lines text-lines__amount__2">
									    			<?echo $arItem["NAME"]?>
									    		</h2>
		                                    <?endif;?>
                                            <div class="article__info row mb-1">
                                                <?/*<div class="article__author col small text-body-tertiary">
												To Do: Добавить вывод автора
												</div>*/?>
									    		<?if($arParams["DISPLAY_DATE"]!="N" && (($arItem["DISPLAY_ACTIVE_FROM"] ?? '') !== '')):?>
                                                    <div class="article__time col-auto small text-body-tertiary"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
									    		<?endif?>
                                            </div>
									    	<?if(($arItem["PREVIEW_TEXT"] ?? '') !== ''):?>
                                                <p class="article__preview-text card-text text-body-secondary mb-2 text-lines text-lines__amount__3">
		                                        	<?echo $arItem["PREVIEW_TEXT"];?>
									    	    </p>
									    	<?endif;?>
									    </div>
                                        <?if($isShowLinks):?>
                                            <div class="article__buttons text-center text-xl-start">
                                        		<?if($isShowDetailLink):?>
                                        				<a class="btn btn-primary" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
                                        		<?endif?>
                                        		<?if($isShowExternalLink):?>
                                                    <a
                                        	    	class="solution__button btn <?
													if($isShowDetailLink){
														echo 'btn-secondary';
													} else {
														echo "btn-primary";
													}
													?>"
                                        	    	href="<?=$arItem['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE']?>"
                                        	    	target="<?
                                        	    	if(str_contains($arItem['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE'], "://")){
                                        	    		echo '_blank';
                                        	    	} else {
                                        	    		echo "_self";
                                        	    	} ?>">
                                        	    	<?if($isExistExternalLinkCaption):?>
                                        	    		<?=$arItem['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE']?>
                                        	    	<?else:?>
                                        	    		<?=$arParams['DEFAULT_EXTERNAL_LINK_CAPTION']?>
                                        	    	<?endif?>
                                        	    	</a>
                                        	    <?endif?>
                                            </div>
                                        <?endif?>
                                    <?/*</div>*/?>
                                </div>
                            </div>
                        </div>
                    </div>
			    <?endforeach?>
            </div>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <?=$arResult["NAV_STRING"]?>
            <?endif;?>
    </div>
</div>


<?/*
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
</div>
*/?>
<? $debug = false;
if($debug){
	echo "<pre> arParams ";
	print_r($arParams);
	echo "</pre>";
	echo "<pre> arResult ";
	print_r($arResult);
	echo "</pre>";
}
?>