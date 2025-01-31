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
$isExistExternalLinkCaption = ($arResult['DISPLAY_PROPERTIES']['LINK_CAPTION']['VALUE'] ?? '') !== '';
$isExistExternalLinkDefaultCaption = ($arParams['DEFAULT_EXTERNAL_LINK_CAPTION'] ?? '') !== '';
$isShowExternalLink = ($arParams['DISPLAY_EXTERNAL_LINK'] == "Y") &&
    (($arResult['DISPLAY_PROPERTIES']['EXTERNAL_LINK']['VALUE'] ?? '') !== '') &&
    ($isExistExternalLinkCaption || $isExistExternalLinkDefaultCaption);
?>
<?
// $dateActiveFromХ = date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult['ACTIVE_FROM_X']), 'c');

echo '<pre>';
print_r($arResult['ACTIVE_FROM_X']);
print_r($arResult['TIMESTAMP_X']);
$timestampX = DateTime::createFromFormat('Y-m-d H:i:s',$arResult['TIMESTAMP_X']);
print_r($timestampX);
print_r(date_get_last_errors());
echo date('c');
echo '</pre>';
?>
<?if($arParams['SCHEMAORG_JSON'] === 'Y') {
$schemaOrgArticle = '<script type="application/ld+json">';
$schemaOrgArticle = $schemaOrgArticle .
'{"@context": "http://schema.org",'."\n".
'"@type": "Article",'."\n".
'"mainEntityOfPage": {'."\n".'"@type": "WebPage",'."\n".
'"@id": "'.$arResult['DETAIL_PAGE_URL'].'" },';
$schemaOrgArticle = $schemaOrgArticle . '</script>';
$APPLICATION->AddHeadString($schemaOrgArticle);
}
$APPLICATION->AddHeadString('<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Article",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "'.$arResult['DETAIL_PAGE_URL'].'"
    },
    "headline": "'.$arResult['NAME'].'",
    "image": {
      "@type": "ImageObject",
      "url": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['src'].'",
      "width": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['width'].'",
      "height": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['height'].'"
    },
    "datePublished": "2025-01-23T10:34:43+03:00", // '. date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult['ACTIVE_FROM_X']), 'c').'
    "dateModified": "2025-01-24T17:53:10+03:00", // ' . date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult['TIMESTAMP_X']), 'c') .'
    "author": {
      "@type": "Person",
      "name": "Сергей Просветов"
    },
    "publisher": {
      "@type": "Person",
      "name": "Пиксель Плюс",
    },
    "description": "'.$arResult['PREVIEW_TEXT'].'",
    "interactionStatistic": [
      {
        "@type": "InteractionCounter",
        "interactionType": "http://schema.org/CommentAction",
        "userInteractionCount": "0"
      }
    ],
    "comment": [
    ]
  }
');
?>

<?
'<script type="application/ld+json">{
    "@context": "https://schema.org/",
    "@type": "CreativeWorkSeries",
    "name": "Идеальное описание товара — какое оно?",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "21"
    }
</script>'
?>
    <?if(is_array($arResult["DETAIL_PICTURE"])):?>
        <div class="article__picture-container mt-3 mb-2">
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
                class="article__image article__image_size_default img-fluid rounded d-block mx-auto"
                alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>"
                title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
            </picture>
	    </div>
    <?endif?>
<div class="article__info">
    <div class="article__info-container mx-auto">
	    <div class="article__info-row row">
	    	<?/*<div class="article__author col small text-body-tertiary">
	        To Do: Добавить вывод автора
	        </div>*/?>
	        <?if($arParams["DISPLAY_DATE"]!="N" && (($arResult["DISPLAY_ACTIVE_FROM"] ?? '') !== '')):?>
                <div class="article__time col-auto small text-body-tertiary mb-2"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
	        <?endif?>
	    </div>
    </div>
</div>
<?if(($arResult["PREVIEW_TEXT"] ?? '') !== ''):?>
    <div class="article__preview">
	    <div class="article__preview-text mx-auto text-secondary mb-5">
            <?echo $arResult["PREVIEW_TEXT"];?>
	    	<?if($isShowExternalLink):?>
	            <div class="article__buttons text-center mt-3">
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
<pre>
<?print_r($arResult)?>
</pre>