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

$arFilter = array("ID" => $arResult["SCHEMAORG"]['CREATED_BY']);
$arParameters = array("FIELDS" => ["NAME", "LAST_NAME","PERSONAL_WWW"]);
$users = CUser::GetList("id", "desc", $arFilter, $arParameters);
while($user = $users->GetNext()) {
    $arResult["AUTHOR"] = $user;
    $arResult["AUTHOR"]["URL"] = 'https://' . end(explode('//', $arResult["AUTHOR"]["PERSONAL_WWW"],2));
    // echo '<pre>';
    // echo 'SCHEMAORG with AUTHOR ';
	// print_r($arResult["SCHEMAORG"]);
    // echo '</pre>';
}