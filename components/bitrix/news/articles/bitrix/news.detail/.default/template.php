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
// if(($arParams['SCHEMAORG_JSON'] ?? 'N' ) === 'Y' && ($arParams['SCHEMAORG_TYPE'] ?? '') !== '') {
// $schemaOrgArticle = '<script type="application/ld+json">';
// if(($arResult['DETAIL_PAGE_URL'] ?? '') !== ''){
//     $schemaOrgArticle = $schemaOrgArticle."\n".
//     '{'."\n".
//     "  ".'"@context": "http://schema.org",'."\n".
//     "  ".'"@type": "'.$arParams['SCHEMAORG_TYPE'].'",'."\n".
//     "  ".'"mainEntityOfPage": {'."\n".
//     "    ".'"@type": "WebPage",'."\n".
//     "    ".'"@id": "'.$arResult['DETAIL_PAGE_URL'].'"'."\n".
//     "  ".'},'."\n";
// };
// if(($arResult['MOBILE_RESIZED_DETAIL_PICTURE']['src'] ?? '') !== ''){
//     $schemaOrgArticle = $schemaOrgArticle .
//     "  ".'"image": {'."\n".
//     "  ".'"@type": "ImageObject",'."\n".
//     "    ".'"url": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['src'].'",'."\n";
//     if(($arResult['MOBILE_RESIZED_DETAIL_PICTURE']['width'] ?? '') !== ''){
//       $schemaOrgArticle = $schemaOrgArticle.
//       "    ".'"width": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['width'].'",'."\n";
//     }
//     if(($arResult['MOBILE_RESIZED_DETAIL_PICTURE']['height'] ?? '') !== '') { 
//       $schemaOrgArticle = $schemaOrgArticle.
//       "    ".'"height": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['height'].'"'."\n";
//     }
//     $schemaOrgArticle = $schemaOrgArticle.
//     "  ".'},';
// }
// if(($arResult['TIMESTAMP_X'] ?? '') !== ''){
//   if(($arResult['ACTIVE_FROM_X'] ?? '') !== '') {
//     $schemaOrgArticle = $schemaOrgArticle."\n".
//     '"datePublished": "'. date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult['ACTIVE_FROM_X']), 'c') . '"';
//   }
//   elseif (($arResult['DATE_CREATE'] ?? '') !== '') {
//     '"dateModified": "' . date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult['DATE_CREATE']), 'c') . '"';
//   }
//   else {
//     '"dateModified": "' . date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult['TIMESTAMP_X']), 'c') . '"';
//   }
//     $schemaOrgArticle = $schemaOrgArticle."\n".
//     '"dateModified": "' . date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult['TIMESTAMP_X']), 'c') . '"';
// }

// $schemaOrgArticle = $schemaOrgArticle."\n".
// "".'}';
// $schemaOrgArticle = $schemaOrgArticle . '</script>';
// $APPLICATION->AddHeadString($schemaOrgArticle);
// }
// $APPLICATION->AddHeadString('<script type="application/ld+json">
//   {
//     "@context": "http://schema.org",
//     "@type": "Article",
//     "mainEntityOfPage": {
//       "@type": "WebPage",
//       "@id": "'.$arResult['DETAIL_PAGE_URL'].'"
//     },
//     "headline": "'.$arResult['NAME'].'",
//     "image": {
//       "@type": "ImageObject",
//       "url": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['src'].'",
//       "width": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['width'].'",
//       "height": "'.$arResult['MOBILE_RESIZED_DETAIL_PICTURE']['height'].'"
//     },
//     "datePublished": "2025-01-23T10:34:43+03:00", // '. date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult['ACTIVE_FROM_X']), 'c').'
//     "dateModified": "2025-01-24T17:53:10+03:00", // ' . date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult['TIMESTAMP_X']), 'c') .'
//     "author": {
//       "@type": "Person",
//       "name": "Сергей Просветов"
//     },
//     "publisher": {
//       "@type": "Person",
//       "name": "Пиксель Плюс",
//     },
//     "description": "'.$arResult['PREVIEW_TEXT'].'",
//     "interactionStatistic": [
//       {
//         "@type": "InteractionCounter",
//         "interactionType": "http://schema.org/CommentAction",
//         "userInteractionCount": "0"
//       }
//     ],
//     "comment": [
//     ]
//   }
// ');
?>

    <?if(($arParams["SCHEMAORG_AUTHOR"] ?? '') !== '') {?>
        <span itemprop="author" itemscope itemtype="https://schema.org/<?=$arParams["SCHEMAORG_AUTHOR"]?>">
            <?if($arParams["SCHEMAORG_AUTHOR"] === 'Person' && (($arResult['AUTHOR']['NAME'] ?? '') !== '' || ($arResult['AUTHOR']['LAST_NAME']?? '') !== '')) {?>
                <meta itemprop="name" content="<?
                    if(($arResult['AUTHOR']['NAME'] ?? '') !== '') echo($arResult['AUTHOR']['NAME']);
                    if(($arResult['AUTHOR']['NAME'] ?? '') !== '' && ($arResult['AUTHOR']['LAST_NAME']?? '') !== '') echo " ";
                    if(($arResult['AUTHOR']['LAST_NAME'] ?? '') !== '') echo($arResult['AUTHOR']['LAST_NAME'])
                    ?>">
                    <?if(($arResult['AUTHOR']['URL'] ?? '') !== ''){?>
                        <meta itemprop="url" content="<?=$arResult['AUTHOR']['URL']?>">
                    <?}?>
            <?} elseif ($arParams["SCHEMAORG_AUTHOR"] === 'Organization') {?>
                <meta itemprop="name" content="<?=$arResult['SITE']['SITE_NAME']?>">
                <meta itemprop="url" content="<?='https://'.SITE_SERVER_NAME?>">
            <?}?>
        </span>
        <?}?>
        <?if(($arParams["SCHEMAORG_PUBLISHER"] ?? '') !== '') {?>
            <span itemprop="publisher" itemscope itemtype="https://schema.org/<?=$arParams["SCHEMAORG_PUBLISHER"]?>">
                <?if($arParams["SCHEMAORG_PUBLISHER"] === 'Person' && (($arResult['AUTHOR']['NAME'] ?? '') !== '' || ($arResult['AUTHOR']['LAST_NAME']?? '') !== '')) {?>
                    <meta itemprop="name" content="<?
                        if(($arResult['AUTHOR']['NAME'] ?? '') !== '') echo($arResult['AUTHOR']['NAME']);
                        if(($arResult['AUTHOR']['NAME'] ?? '') !== '' && ($arResult['AUTHOR']['LAST_NAME']?? '') !== '') echo " ";
                        if(($arResult['AUTHOR']['LAST_NAME'] ?? '') !== '') echo($arResult['AUTHOR']['LAST_NAME'])
                        ?>">
                        <?if(($arResult['AUTHOR']['URL'] ?? '') !== ''){?>
                            <meta itemprop="url" content="<?=$arResult['AUTHOR']['URL']?>">
                        <?}?>
                <?} elseif ($arParams["SCHEMAORG_PUBLISHER"] === 'Organization') {?>
                    <meta itemprop="name" content="<?=$arResult['SITE']['SITE_NAME']?>">
                    <meta itemprop="url" content="<?='https://'.SITE_SERVER_NAME?>">
            <?}?>
            </span>
        <?}?>
        <meta itemprop="datePublished" content="<?=$arResult["SCHEMAORG"]["DATE_PUBLISHED"]?>">
        <meta itemprop="dateModified" content="<?=$arResult["SCHEMAORG"]["DATE_MODIFIED"]?>">
        <?/*if(($arResult["SCHEMAORG"]['TIMESTAMP_X'] ?? '') !== ''){
            if(($arResult["SCHEMAORG"]['ACTIVE_FROM_X'] ?? '') !== '') {
                echo '<meta itemprop="datePublished" content="'. date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult["SCHEMAORG"]['ACTIVE_FROM_X']), 'c') . '">';
            }
            elseif (($arResult["SCHEMAORG"]['DATE_CREATE'] ?? '') !== '') {
                echo '<meta itemprop="datePublished" content="'. date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult["SCHEMAORG"]['DATE_CREATE']), 'c') . '">';
            }
            else {
                echo '<meta itemprop="datePublished" content="'. date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult["SCHEMAORG"]['TIMESTAMP_X']), 'c') . '">';
            }
                echo '<meta itemprop="dateModified" content="'. date_format(DateTime::createFromFormat('d.m.Y H:i:s',$arResult["SCHEMAORG"]['TIMESTAMP_X']), 'c') . '">';
        }
        */?>
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
                title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>"
                itemprop="image">
            </picture>
	    </div>
    <?endif?>
<div class="article__info">
    <div class="article__info-container mx-auto">
	    <div class="article__info-row row">
            <?if($arParams["DISPLAY_DATE"]!="N" && (($arResult["DISPLAY_ACTIVE_FROM"] ?? '') !== '')):?>
                <div class="article__time col small text-body-tertiary mb-2"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
	        <?endif?>  
            <?if($arParams["DISPLAY_AUTHOR"] === 'Y') {?>
            <div class="article__author col-auto small text-body-tertiary">
                <?if(($arResult['AUTHOR']['NAME'] ?? '') !== '' || ($arResult['AUTHOR']['LAST_NAME']?? '') !== '') {?>
                    <span itemprop="name"><?
                        if(($arResult['AUTHOR']['NAME'] ?? '') !== '') echo($arResult['AUTHOR']['NAME']);
                        if(($arResult['AUTHOR']['NAME'] ?? '') !== '' && ($arResult['AUTHOR']['LAST_NAME']?? '') !== '') echo " ";
                        if(($arResult['AUTHOR']['LAST_NAME'] ?? '') !== '') echo($arResult['AUTHOR']['LAST_NAME']);
                        ?></span>
                <?}?>
            </div>
            <?}?>          
	    </div>
    </div>
</div>
<?if(($arResult["PREVIEW_TEXT"] ?? '') !== ''):?>
    <div class="article__preview">
	    <div class="article__preview-text mx-auto text-secondary mb-5">
            <span itemprop="description"><?echo $arResult["PREVIEW_TEXT"];?></span>
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
<?
// echo '<pre> arParams:';
// print_r($arParams);
// echo '</pre><pre> arResult:';
// print_r($arResult);
// echo '</pre>';
?>