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

<section class="portfolio pt-3 pb-5">
        <div class="container">
		    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
	            <?=$arResult["NAV_STRING"]?><br />
            <?endif;?>

			<?if($arResult["SECTION"]):?>
				<div class="portfolio__header row justify-content-center pt-3 pb-2">
                    <div class="col-auto">
                        <h1 class="portfolio__heading"><?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["NAME"]?></h1>
                    </div>
                </div>
			<?else:?>
				<div class="portfolio__header row justify-content-center pt-3 pb-2">
                    <div class="col-auto">
                        <h1 class="portfolio__heading"><?=$arResult["NAME"]?></h1>
                    </div>
                </div>
			<?endif?>

            <div class="row justify-content-center">
				<!-- To Do: Переделать вывод компонентов:
				 I
				 - Вывод разделов 1 уровня
				 - Вывод разделов 2 уровня (выводится) и возврат на 1 уровень
				 - Вывод разделов 3 уровня и возврат на 2 уровень (сделано)
				 II
				 Или убрать назад и выводить разделы с помощью одноуровнего меню.
			    -->
				<div class="caption col-12 col-md-10 col-lg-8 col-xl-12 col-xxl-11 mb-5">

				<?if(!isset($arResult["SECTION"]["PATH"]) && isset($arResult["SECTIONS"])):?>
					<?foreach($arResult["SECTIONS"] as $arSection):?>
                         <?if($arSection["ELEMENT_CNT"] > 0):?>
							<a class="btn btn-outline-primary" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
						 <?endif?>
					<?endforeach?>
				<?endif?>
			    <?if($arResult["SECTION"]["PATH"]):?>
                        <?if($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])-1]):?>
                            <?/*<a class="btn btn-outline-secondary mb-1" href="<?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])-1]["SECTION_PAGE_URL"]?>">
							<!-- <i class="bi bi-chevron-left"></i> -->
							<?=$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])-1]["NAME"]?>
					    	</a>*/?>
                        <?else:?>
							<?/*<a href="<?=$arResult["LIST_PAGE_URL"]?>"><?=$arResult["LIST_PAGE_URL"]?></a>*/?>
                        <?endif?>
						<?foreach($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["SECTIONS"] as $arSection):?>
                            <a class="btn btn-outline-primary mb-1" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
						<?endforeach?>
                <?endif?>

				</div>

            </div>
            <div class="example portfolio__grid row gx-4 gy-5 justify-content-center align-items-center">
			    <?foreach($arResult["ITEMS"] as $arItem):?>
	                <?
	                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	                ?>
                    <div class="case col-12 col-md-10 col-lg-8 col-xl-12 col-xxl-11" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="card mb-3 border-0">
                            <div class="row justify-content-center align-items-stretch">
								<div class="article__image col-xl-6 col-xxl-5 text-center d-flex flex-column justify-content-end">
									<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
		                            	<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
		                            		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			    				    		<picture class="article__picture">
                                                <!-- <source
                                                type="image/webp"
                                                srcset="./images/portfolio/roof-rack@2x.webp"
                                                media="(min-width: 576px) and (-webkit-min-device-pixel-ratio: 1.5)" />
                                                <source
                                                type="image/webp"
                                                srcset="./images/portfolio/roof-rack.webp"/> -->
                                                <img
                                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                                class="img-fluid rounded"
                                                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                                loading="lazy">
                                            </picture>
			    				    	</a>
		                            	<?else:?>
			    				    		<picture class="article__picture">
                                                <!-- <source
                                                type="image/webp"
                                                srcset="./images/portfolio/roof-rack@2x.webp"
                                                media="(min-width: 576px) and (-webkit-min-device-pixel-ratio: 1.5)" />
                                                <source
                                                type="image/webp"
                                                srcset="./images/portfolio/roof-rack.webp"/> -->
                                                <img
                                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                                class="img-fluid rounded"
                                                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                                loading="lazy">
                                            </picture>
		                            	<?endif;?>
		                            <?endif?>
								</div>
                                <div class="article__promo col col-xl-6 col-xxl-7 card-body pt-xl-0 pb-xl-0 d-flex flex-column justify-content-between">
                                    <?/*<div class="card-body pt-xl-0 pb-xl-0 px-0 px-xl-3 d-flex flex-column h-100 justify-content-between">*/?>
									    <div class="card-badges text-center text-xl-start">
									    	<?foreach($arItem["SECTIONS"] as $arSection):?>
                                                <a class="card-badge btn btn-outline-primary btn-sm mb-1" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
									    	<?endforeach?>
									    </div>
                                        <div class="article__announce">
									    	<?if($arItem["NAME"]):?>
									    		<h2 class="h4 card-title text-center text-xl-start text-lines text-lines__amount__2">
									    			<?echo $arItem["NAME"]?>
									    		</h2>
		                                    <?endif;?>
                                            <div class="news-info row mb-1">
                                                <?/*<div class="author col small text-body-tertiary">Василий Квасов</div>*/?>
									    		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                                                    <div class="time col-auto small text-body-tertiary"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
									    		<?endif?>
                                            </div>
									    	<?if($arItem["PREVIEW_TEXT"]):?>
                                                <p class="card-text text-body-secondary mb-1 text-lines text-lines__amount__3">
		                                        	<?echo $arItem["PREVIEW_TEXT"];?>
									    	    </p>
									    	<?endif;?>
									    </div>
										<?if($arItem["NAME"] && !$arParams["HIDE_LINK_WHEN_NO_DETAIL"] && $arResult["USER_HAVE_ACCESS"]):?>
                                            <p class="card-text text-center text-xl-start">
												<a class="btn btn-primary" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
											</p>
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
    </section>


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
<? $debug = true;
if($debug){
	echo "<pre> arResult ";
	print_r($arResult);
	echo "</pre>";
}
?>