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

<section class="first-screen">
    <div class="container">
        <div class="first-screen__row row-cols-1 row justify-content-center align-items-center">
            <div class="col-12 row justify-content-center align-items-center">
			    <?if(($arResult["DETAIL_PICTURE"] ?? '') !== ''):?>
                    <picture class="col-12 col-md-10 col-lg-8 col-xl-8 col-xxl-7 first-screen__banner col px-0 py-3 d-block text-center">
					    <?if(($arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP_2X"] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP_2X"]["FILE_VALUE"]["CONTENT_TYPE"]?>"
						    srcset="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP_2X"]["FILE_VALUE"]["SRC"]?>"
                            class="first-screen__image-source first-screen__image-source_size_2x-desktop"
                            media="(min-width: 576px) and (-webkit-min-device-pixel-ratio: 1.5)" />
						<?endif?>
						<?if(($arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP"] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP"]["FILE_VALUE"]["CONTENT_TYPE"]?>"
						    srcset="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_DESKTOP"]["FILE_VALUE"]["SRC"]?>"
                            class="first-screen__image-source first-screen__image-source_size_desktop"
                            media="(min-width: 576px)" />
						<?endif?>
						<?if(($arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_2X"] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_2X"]["FILE_VALUE"]["CONTENT_TYPE"]?>"
						    srcset="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP_2X"]["FILE_VALUE"]["SRC"]?>"
						    class="first-screen__image-source first-screen__image-source_size_2x-mobile"
                            media="(max-width: 575.98px) and (-webkit-min-device-pixel-ratio: 1.5)" />
						<?endif?>
						<?if(($arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP"] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP"]["FILE_VALUE"]["CONTENT_TYPE"]?>"
						    srcset="<?=$arResult["DISPLAY_PROPERTIES"]["IMAGE_WEBP"]["FILE_VALUE"]["SRC"]?>"
                            class="first-screen__image-source first-screen__image-source_size_mobile"
                            media="(max-width: 575.98px)" />
						<?endif?>
                        <img
                        src="<?=$arResult["DETAIL_PICTURE"]["SAFE_SRC"]?>"
                        class="first-screen__image first-screen__image_size_default img-fluid rounded"
                        alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>!"
                        title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                    </picture>
				<?endif?>
            </div>
            <div class="first-screen__caption col-auto pt-3 pb-5">
				<?if(($arResult["PREVIEW_TEXT"] ?? '') !== ''):?>
                    <h1 class="first-screen__heading h1"><?=$arResult["PREVIEW_TEXT"]?></h1>
				<?endif?>
				<div class="first-screen__content">
				<?if(($arResult["DETAIL_TEXT"] ?? '') !== ''):?>
                    <?=$arResult["DETAIL_TEXT"]?>
				<?endif?>
            </div>
            <div class="first-screen__spacer col-12 py-1"></div>
            <div class="first-screen__spacer col-12 py-1"></div>
        </div>
    </div>
</section>
<hr>
<pre>
	<?print_r($arResult);?>
</pre>
<hr>
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
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && ($arResult["FIELDS"]["PREVIEW_TEXT"] ?? '') !== ''):?>
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