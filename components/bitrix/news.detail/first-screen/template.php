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
    <div class="first-screen__container container">
        <div class="first-screen__row row-cols-1 row justify-content-center align-items-center">
            <div class="first-screen__column col-12 row justify-content-center align-items-center">
			    <?if(($arResult['DETAIL_PICTURE'] ?? '') !== ''):?>
                    <picture class="first-screen__banner col-12 col-md-10 col-lg-8 col-xl-8 col-xxl-7 col px-0 py-3 d-block text-center">
					    <?if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP_2X'] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP_2X']['FILE_VALUE']['CONTENT_TYPE']?>"
						    srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP_2X']['FILE_VALUE']['SRC']?>"
                            class="first-screen__image-source first-screen__image-source_size_2x-desktop"
                            media="(min-width: 576px) and (-webkit-min-device-pixel-ratio: 1.5)" />
						<?endif?>
						<?if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP'] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP']['FILE_VALUE']['CONTENT_TYPE']?>"
						    srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_DESKTOP']['FILE_VALUE']['SRC']?>"
                            class="first-screen__image-source first-screen__image-source_size_desktop"
                            media="(min-width: 576px)" />
						<?endif?>
						<?if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X'] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['CONTENT_TYPE']?>"
						    srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP_2X']['FILE_VALUE']['SRC']?>"
						    class="first-screen__image-source first-screen__image-source_size_2x-mobile"
                            media="(max-width: 575.98px) and (-webkit-min-device-pixel-ratio: 1.5)" />
						<?endif?>
						<?if(($arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP'] ?? '') !== ''):?>
                            <source
                            type="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['CONTENT_TYPE']?>"
						    srcset="<?=$arResult['DISPLAY_PROPERTIES']['IMAGE_WEBP']['FILE_VALUE']['SRC']?>"
                            class="first-screen__image-source first-screen__image-source_size_mobile"
                            media="(max-width: 575.98px)" />
						<?endif?>
                        <img
                        src="<?=$arResult['DETAIL_PICTURE']['SAFE_SRC']?>"
                        class="first-screen__image first-screen__image_size_default img-fluid rounded"
                        alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>"
                        title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
                    </picture>
				<?endif?>
            </div>
            <div class="first-screen__content col-auto pt-3 pb-5">
				<?if(($arResult['PREVIEW_TEXT'] ?? '') !== ''):?>
                    <h1 class="first-screen__heading h1"><?=$arResult['PREVIEW_TEXT']?></h1>
				<?endif?>
				<div class="first-screen__text">
				    <?if(($arResult['DETAIL_TEXT'] ?? '') !== ''):?>
                        <?=$arResult['DETAIL_TEXT']?>
				    <?endif?>
                </div>
            </div>
            <div class="first-screen__spacer col-12 py-1"></div>
            <div class="first-screen__spacer col-12 py-1"></div>
        </div>
    </div>
</section>