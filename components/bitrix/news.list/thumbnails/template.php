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
	<?if(($arResult['NAME'] ?? '') !== ''):?>
        <div class="thumbnails__name container">
            <div class="thumbnails__name-row row justify-content-center">
                <div class="thumbnails__name-column col-auto text-center">
                    <h2 class="thumbnails__heading"><?=$arResult['NAME']?></h2>
		    		<?if(($arResult['DESCRIPTION'] ?? '') !== ''):?>
		    		    <p class="thumbnails__description text text-body-secondary"><?=$arResult['DESCRIPTION']?></p>
		    		<?endif?>
                </div>
            </div>
		</div>
	<?endif?>
	<div id="carouselIndicators" class="carousel carousel-dark slide">
        <?if(($arParams['DISPLAY_TOP_PAGER'] ?? '') !== ''):?>
        	<?=$arResult['NAV_STRING']?><br />
        <?endif;?>
	    <div class="carousel-inner">
            <div class="container">
                <div class="thumbnails__grid row row-cols-1 row-cols-md-2 row-cols-xl-3 mx-xl-5 gx-2 gy-2 justify-content-center align-items-center">
	                <?foreach($arResult['ITEMS'] as $arItem):?>
	            		<?
	                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
	                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	                    ?>
                        <div class="thumbnail col"id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="thumbnail__card card border-0">
	            				<?if(($arItem['DISPLAY_PROPERTIES']['CODE_SVG']['VALUE'] ?? '') !== ''):?>
                                    <div class="thumbnail__icon text-center text-primary">
	            			    	    <?=$arItem['DISPLAY_PROPERTIES']['CODE_SVG']['~VALUE']?>
                                    </div>
	            				<?elseif(($arItem['PREVIEW_PICTURE']['SAFE_SRC'] ?? '') !== ''):?>
	            					<img class="thumbnail__image"
									src="<?=$arItem['PREVIEW_PICTURE']['SAFE_SRC']?>"
									alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>"
								    title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>"
									loading="lazy">
	            			    <?endif?>
                                <div class="thumbnail__caption card-body">
	            					<?if($arItem['NAME']):?>
                                        <h3 class="thumbnail__heading mt-0 mb-2 text-center"><?=$arItem['NAME']?></h3>
	            					<?endif?>
	            					<?if(($arItem['PREVIEW_TEXT'] ?? '') !== ''):?>
                                        <p class="thumbnail__text text-center text-body-secondary"><?=$arItem['PREVIEW_TEXT']?></p>
	            					<?endif?>
	            					<?if($arParams['DISPLAY_LINK']!="N" && (($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ?? '') !== '') && (($arItem['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE'] ?? '') !== '') || (($arParams['DEFAULT_LINK_CAPTION'] ?? '') !== '')):?>
	            						<div class="solution__buttons text-center">
                                            <a
	            							class="solution__button btn btn-primary"
	            							href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>"
	            							target="<?
	            							if(str_contains($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'], "://")){
	            								echo '_blank';
	            							} else {
	            								echo "_self";
	            							} ?>">
	            								<?if(($arItem['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE'] ?? '') !== ''):?>
	            									<?=$arItem['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE']?>
	            								<?else:?>
	            									<?=$arParams['DEFAULT_LINK_CAPTION']?>
	            								<?endif?>
	            							</a>
                                        </div>
	            					<?endif?>
                                </div>
                            </div>
                        </div>
	            	<?endforeach;?>
                </div>
			</div>
	        <?if(($arParams['DISPLAY_BOTTOM_PAGER'] ?? '') !== ''):?>
                <?=$arResult['NAV_STRING']?>
            <?endif;?>
		</div>
	</div>
</section>