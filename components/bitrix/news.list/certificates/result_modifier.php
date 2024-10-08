<?
/* Добавляем разделы в arResult */
if(($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] ?? '') !== '') {
    $arFilter = array(
        "ACTIVE" => "Y",
        'IBLOCK_ID' => $arResult['ID'],
        'ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])],
    ); 
    $arSelect = array("DESCRIPTION");
    $arSections = CIBlockSection::GetList(
         Array("SORT"=>"ASC"),
         $arFilter,
         false,
         $arSelect
    );
    while ($arSection = $arSections->GetNext()) {
    	$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] = array_merge($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])], $arSection);
    }
}