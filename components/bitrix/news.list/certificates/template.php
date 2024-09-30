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
<div class="certificates pb-5">
    <?if(($arResult['SECTION']['PATH'][0] ?? '') !== ''):?>
        <div class="certificates__name container">
            <div class="certificates__name-row row justify-content-center">
                <div class="certificates__name-column col-auto text-center">
                    <h3 class="certificates__heading mt-3 mb-3"><?=$arResult['SECTION']['PATH'][0]['NAME']?></h3>
		    		<?if(($arResult['SECTION']['PATH'][0]['DESCRIPTION'] ?? '') !== ''): // Нет в массиве?>
		    		    <p class="certificates__description text text-body-secondary"><?=$arResult['SECTION']['PATH'][0]['DESCRIPTION']?></p>
		    		<?endif?>
                </div>
            </div>
		</div>
	<?endif?>
	<div id="carouselIndicators" class="certificates__carousel carousel carousel-dark slide">
        <?if($arParams['DISPLAY_TOP_PAGER']):?>
        	<?=$arResult['NAV_STRING']?><br />
        <?endif;?>
	    <div class="certificates__carousel-inner carousel-inner">
            <div class="certificates__carousel-item carousel-item active">
                <div class="certificates__container container">
                    <div class="certificates__grid row row-cols-1 row-cols-xl-<?=$arParams['NEWS_COUNT']?> mx-xl-5 justify-content-center align-items-start">
                    <?/*
                    <?if($arParams['DISPLAY_TOP_PAGER']):?>
                    	<?=$arResult['NAV_STRING']?><br />
                    <?endif;?>
	        	    */?>
                        <?foreach($arResult['ITEMS'] as $arItem):?>
                        	<?
                        	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                        	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        	?>
                            <div class="certificate col card border-0 d-flex flex-column justify-content-between align-self-stretch align-items-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?/*<div class="certificate__image text-center text-primary">*/?>
	        	    				<?if(($arItem["PREVIEW_PICTURE"]["SAFE_SRC"] ?? '') !== ''):?>
                                        <img
	        	    					class="certificate__image d-block"
	        	    					src="<?=$arItem['PREVIEW_PICTURE']['SAFE_SRC']?>"
	        	    					alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>"
	        	    					title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>"
	        	    					loading="lazy">
	        	    				<?endif?>
                                <?/*</div>*/?>
	        	    			<?if(($arItem['NAME'] ?? '') !== ''):?>
                                    <div class="certificate__caption card-body d-flex flex-column justify-content-start align-self-stretch">
                                        <h3 class="h6 card-title certificate__heading mt-auto mb-auto text-center align-middle"><?=$arItem['NAME']?></h3>
	        	    					<?if(!empty($arItem['PREVIEW_TEXT'])):?>
                                            <p class="certificate__text text-center mt-auto text-body-secondary"><?=$arItem['PREVIEW_TEXT']?></p>
	        	    					<?endif?>
                                    </div>
	        	    			<?endif?>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
	    </div>
        <?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
            <?=$arResult['NAV_STRING']?>
        <?endif;?>
	</div>

</div>
