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

if($arParams['SECTION_SET_CANONICAL_URL'] == "Y"){
	if(($arResult["SECTION"]["PATH"] ?? '') !== '') {
	    $APPLICATION->SetPageProperty("canonical", "https://".SITE_SERVER_NAME.$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["SECTION_PAGE_URL"]);
	} elseif (($arParams["IBLOCK_URL"] ?? '') !== '') {
		$APPLICATION->SetPageProperty("canonical", "https://".SITE_SERVER_NAME.$arParams["IBLOCK_URL"]);
	}
}
?>

<?if($arParams["DISPLAY_HEADER"] == 'Y'):?>
                            <?/*<div class="articles__info row mb-1"><!-- Дата --></div>*/?>
    						<?if((($arResult["SECTION"]["PATH"] ?? '') !== '') || (($arResult["DESCRIPTION"] ?? '') !== '')):?>
    	                        <p class="articles__preview-text card-text text-body-secondary mb-2 text-lines text-lines__amount__3">
    							    <?if(($arResult["SECTION"]["PATH"] ?? '') !== ''):?>
            			                <?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["DESCRIPTION"]?></h1>
            			            <?elseif(($arResult["DESCRIPTION"] ?? '') !== ''):?>
            			                <?=$arResult["DESCRIPTION"]?>
            			            <?endif?>
    						    </p>
    						<?endif?>
    	                </div>
                    </div>
				    <div class="articles__preview-image-col col-xl-6 col-xxl-5 order-first order-xl-last text-center d-flex flex-column justify-content-end">
	                    <picture class="articles__preview-picture">
                            <?/*<source type="image/webp" srcset="image@2x.webp" class="article__image-source article-screen__image-source_size_2x" media="(-webkit-min-device-pixel-ratio: 1.5)">
                            <source type="image/webp" srcset="image.webp" class="article__image-source article-screen__image-source_size_normal">*/?>
                            <?if(($arResult["SECTION"]["PATH"] ?? '') !== ''):?>
                                <img
                                src="<?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['RESIZED_PICTURE']['src']?>"
                                class="articles__preview-image img-fluid rounded"
                                alt="<?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]?>"
                                title="<?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]?>"
                                loading="lazy">
							<?else:?>
								<?$APPLICATION->SetPageProperty("og:image", "https://".SITE_SERVER_NAME.$arResult['IBLOCK_PICTURE']['SRC']);?>
                                <img
                                src="<?=$arResult['IBLOCK_RESIZED_PICTURE']['src']?>"
                                class="articles__preview-image img-fluid rounded"
                                alt="<?=$APPLICATION->GetPageProperty("title")?>"
                                title="<?=$APPLICATION->GetPageProperty("title")?>"
                                loading="lazy">
                            <?endif?>
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?elseif ($arParams["DISPLAY_HEADER"] == 'N'):?>
	<div class="articles mb-5">
        <div class="articles__container container">
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
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif?>
<div class="articles__grid row gx-4 gy-5 mb-4 justify-content-center align-items-center">
    <?if(($arResult["ITEMS"][0] ?? '') !== ''):?>
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
	    				<div class="article__image-col col-xl-6 col-xxl-5 text-center d-flex flex-column justify-content-end">
	    					<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
                            	<?if($isShowDetailLink):?>
                            		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
	    						<?endif?>
        				    	<picture class="article__picture">
	    		                <?/*if(($arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X'] ?? '') !== ''):?>
                                    <source
                                    type="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['CONTENT_TYPE']?>"
	    		                    srcset="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['SRC']?>"
	    		                    class="article__image-source article-screen__image-source_size_2x"
                                    media="(-webkit-min-device-pixel-ratio: 1.5)" />
	    		                <?endif?>
	    		                <?if(($arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP'] ?? '') !== ''):?>
                                    <source
                                    type="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['CONTENT_TYPE']?>"
	    		                    srcset="<?=$arItem['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['SRC']?>"
                                    class="article__image-source article-screen__image-source_size_normal">
	    		                <?endif*/?>
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
								    <?if($arParams["DISPLAY_AUTHOR"] === 'Y') {?>
									    <div class="article__author col-auto small text-body-tertiary">
                                            <?if(($arItem['AUTHOR']['NAME'] ?? '') !== '' || ($arItem['AUTHOR']['LAST_NAME']?? '') !== '') {?>
                                                <span itemprop="name"><?
                                                    if(($arItem['AUTHOR']['NAME'] ?? '') !== '') echo($arItem['AUTHOR']['NAME']);
                                                    if(($arItem['AUTHOR']['NAME'] ?? '') !== '' && ($arItem['AUTHOR']['LAST_NAME']?? '') !== '') echo " ";
                                                    if(($arItem['AUTHOR']['LAST_NAME'] ?? '') !== '') echo($arItem['AUTHOR']['LAST_NAME'])
                                                    ?></span>
                                            <?}?>
                                        </div>
                                    <?}?>
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
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach?>
    <?else:?>
    <div class="text-danger text-center"><?=GetMessage('ERROR_NO_ITEMS')?></div>
	<?endif?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
<?if ($arParams["DISPLAY_HEADER"] == 'N'):?>
    </div>
</div>
<?endif?>