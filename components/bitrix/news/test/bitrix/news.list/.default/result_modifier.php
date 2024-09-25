<?
$arResult['XXX'] = "News List";
/* Добавляем разделы в arResult */
$arResult['SECTIONS'] = array();
$arFilter = array('IBLOCK_ID' => $arResult['ID']); 
$arSelect = array();
$arSections = CIBlockSection::GetList(
     Array("SORT"=>"ASC"),
     $arFilter,
     false,
     $arSelect
);
while ($arSection = $arSections->GetNext()) {
    array_push($arResult['SECTIONS'], $arSection);
}
/* Добавляем элементы в разделы в arResults */
// foreach($arResult["ITEMS"] as $arItem) {
//     $arSection = 
    // $arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"] = array();
    // array_push($arResult['SECTIONS'][$arItem["IBLOCK_SECTION_ID"]], $arItem);
// }

