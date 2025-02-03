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
/** Получение информации о сайте */
$sites = CSite::GetList("sort", "desc", Array("ID" => SITE_ID));
while ($site = $sites->Fetch())
{
	$arResult["SITE"]["SITE_NAME"] = $site["SITE_NAME"];
    $arResult['SITE']['FORMAT_DATETIME'] = $site['FORMAT_DATETIME'];
    // echo '<pre>';
    // echo 'SITE ';
	// print_r($site);
    // echo '</pre>';
}

/** Получение даты и пользователя, создавшего элемент, для микроразметки Schema.org */
$arOrder = Array("SORT"=>"ASC");
$arFilter = Array("ID" => $arResult["ID"]);
$arGroupBy = false;
$arNavStartParams = false;
$arSelectFields = Array(
    'DATE_CREATE', // Дата создания элемента
    'TIMESTAMP_X', // Дата последнего изменения
    'ACTIVE_FROM', // Дата начала действия элемента
    'CREATED_BY', // Код пользователя, создавшего элемент
);
$elements = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
while($element = $elements->GetNextElement())
{
	$arResult["SCHEMAORG"] = $element->GetFields();
    // echo '<pre>';
    // echo 'SCHEMAORG without AUTHOR ';
	// print_r($arResult["SCHEMAORG"]);
    // echo '</pre>';
}
// Заполнение ISO-даты публикации из ACTIVE_FROM_X или DATE_CREATE
if(($arResult["SCHEMAORG"]['ACTIVE_FROM_X'] ?? '') !== ''){
    $arResult["SCHEMAORG"]["DATE_PUBLISHED"] = date_format(DateTime::createFromFormat('Y-m-d H:i:s',$arResult["SCHEMAORG"]['ACTIVE_FROM_X']), 'c');
} elseif(($arResult["SCHEMAORG"]['DATE_CREATE'] ?? '') !== '') {
    $arResult["SCHEMAORG"]["DATE_PUBLISHED"] = date_format(DateTime::createFromFormat(CDatabase::DateFormatToPHP($arResult['SITE']['FORMAT_DATETIME']),$arResult["SCHEMAORG"]['DATE_CREATE']), 'c');

}

// Заполнение ISO-даты изменения из TIMESTAMP_X
$arResult["SCHEMAORG"]["DATE_MODIFIED"] = date_format(DateTime::createFromFormat(CDatabase::DateFormatToPHP($arResult['SITE']['FORMAT_DATETIME']),$arResult["SCHEMAORG"]['TIMESTAMP_X']), 'c');

$arFilter = array("ID" => $arResult["SCHEMAORG"]['CREATED_BY']);
$arParameters = array("FIELDS" => ["NAME", "LAST_NAME","PERSONAL_WWW"]);
$users = CUser::GetList("id", "desc", $arFilter, $arParameters);
while($user = $users->GetNext()) {
    $arResult["USER"] = $user;
    $arResult["USER"]["URL"] = 'https://' . end(explode('//', $arResult["USER"]["PERSONAL_WWW"],2));
    // echo '<pre>';
    // echo 'SCHEMAORG with AUTHOR ';
	// print_r($arResult["SCHEMAORG"]);
    // echo '</pre>';
}
?>