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
$arResult['MOBILE_RESIZED_DETAIL_PICTURE'] = CFile::ResizeImageGet(
    $arResult['DETAIL_PICTURE'], // file
    array("width" => 512, "height" => 256), // Size
	BX_RESIZE_IMAGE_EXACT, // resizeType
	true, // InitSizes
	false, // Filters
    true, // Immediate
    90 // jpgQuality
);
/* Автор */
if(($arResult['MODIFIED_BY'] ?? '') !== '') {
    $filter = Array (
        "ID" => $arResult['MODIFIED_BY'],
    );
    $arParameters["FIELDS"] = Array ("NAME", "LAST_NAME");
    $arResult['AUTHOR'] = CUser::GetList(($by="id"), ($order="desc"), $filter, $arParameters)->fetch();
}