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
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<?
$isExistExternalLinkCaption = ($arResult['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE'] ?? '') !== '';
$isExistExternalLinkDefaultCaption = ($arParams['DEFAULT_EXTERNAL_LINK_CAPTION'] ?? '') !== '';
$isShowExternalLink = ($arParams['DISPLAY_EXTERNAL_LINK'] == "Y") &&
    (($arResult['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE'] ?? '') !== '') &&
    ($isExistExternalLinkCaption || $isExistExternalLinkDefaultCaption);
?>

<div class="article mt-3 mb-3" id="<?=$this->GetEditAreaId($arResult['ID']);?>">
    <div class="article__container container">
	    <?if(is_array($arResult["DETAIL_PICTURE"])):?>
		    <div class="article__picture-row row justify-content-center pt-3 pb-2">
                <div class="article__picture-col col-auto">
			    	<picture class="article__picture">
					    <?/*if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X'] ?? '') !== ''):?>
                            <source
                            type="<?=$$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['CONTENT_TYPE']?>"
					        srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['SRC']?>"
					        class="article__image-source article-screen__image-source_size_2x"
						<?//media="(-webkit-min-device-pixel-ratio: 1.5)"?>/>
					    <?endif*/?>
					    <?/*<?if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP'] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['CONTENT_TYPE']?>"
					        srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['SRC']?>"
                            class="article__image-source article-screen__image-source_size_normal">
					    <?endif?>*/?>
                        <?/*<img
                        src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                        class="article__image rounded"
                        alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                        loading="lazy">*/?>
						<source
                        type="<?=$arResult['DETAIL_PICTURE']['CONTENT_TYPE']?>"
						srcset="<?=$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['src']?>"
                        class="article__image-source article__image-source_size_mobile"
                        media="(max-width: 575.98px)" />
                        <img
                        src="<?=$arResult['RESIZED_DETAIL_PICTURE']['src']?>"
                        class="article__image article__image_size_default img-fluid rounded"
                        alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>"
                        title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
                    </picture>
                    </picture>
    	        </div>
            </div>
        <?endif?>
	    <?if($arResult["NAME"]):?>
	    	<div class="article__heading-row row justify-content-center pt-3 pb-2">
                <div class="article__heading-col col-auto">
                    <h1 class="article__heading">
						<?$APPLICATION->ShowTitle(false)?>
					</h1>	
                </div>
            </div>
	    <?endif?>
		<div class="article__info row justify-content-center mb-1">
			<div class="article__info-container">
			    <?/*<div class="article__author col small text-body-tertiary">
			    To Do: Добавить вывод автора
			    </div>*/?>
				<div class="article__info-row row">
			        <?if($arParams["DISPLAY_DATE"]!="N" && (($arResult["DISPLAY_ACTIVE_FROM"] ?? '') !== '')):?>
                        <div class="article__time col-auto small text-body-tertiary px-md-0"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
			        <?endif?>
				</div>
			</div>
        </div>
		<?if(($arResult["PREVIEW_TEXT"] ?? '') !== ''):?>
			<div class="article__preview-text mx-auto text-secondary mb-5">
		        <?echo $arResult["PREVIEW_TEXT"];?>
				<?if($isShowExternalLink):?>
			        <div class="article__buttons text-center">
                        <a
                        class="solution__button btn btn-primary"
                        href="<?=$arResult['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE']?>"
                        target="<?
                        if(str_contains($arResult['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE'], "://")){
                        	echo '_blank';
                        } else {
                        	echo "_self";
                        } ?>">
                        <?if($isExistExternalLinkCaption):?>
                        	<?=$arResult['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE']?>
                        <?else:?>
                        	<?=$arParams['DEFAULT_EXTERNAL_LINK_CAPTION']?>
                        <?endif?>
                        </a>
			        </div>
                <?endif?>
		    </div>
		<?endif;?>
		<?if(($arResult["DETAIL_TEXT"] ?? '') !== ''):?>
			<div class="article__detail-text mx-auto">
			<?require_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/libraries/parsedown/parsedown.php');?>
			    <?if($arResult['DETAIL_TEXT_TYPE'] == "text" && $arParams['DETAIL_MARKDOWN'] == "Y") {
                    $Parsedown = new Parsedown();
                    echo $Parsedown->text($arResult["~DETAIL_TEXT"]);
			    } else {
			    	echo $arResult["DETAIL_TEXT"];
			    }?>
		    </div>
		<?endif?>
    </div>
</div>


<?/*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && ($arResult["FIELDS"]["PREVIEW_TEXT"] ?? '')):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
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