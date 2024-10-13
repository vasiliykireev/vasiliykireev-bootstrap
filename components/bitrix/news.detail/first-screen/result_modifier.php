<?
/* Изменение размера картинки на фактический */
$arResult['RESIZED_DETAIL_PICTURE'] = CFile::ResizeImageGet(
    $arResult['DETAIL_PICTURE'], // file
    array("width" => 768, "height" => 384), // Size
	BX_RESIZE_IMAGE_EXACT, // resizeType
	true, // InitSizes
	false, // Filters
    true, // Immediate
    90 // jpgQuality
);