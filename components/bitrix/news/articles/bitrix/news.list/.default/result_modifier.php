<?
/* Добавляем разделы в arResult */
$arResult['SECTIONS'] = array();
$arFilter = array(
    "ACTIVE"=>"Y", // Сортировка по активности
    'IBLOCK_ID' => $arResult['ID'],
    'DEPTH_LEVEL' => 1,
    'CNT_ACTIVE' => "Y",
); 
$arSelect = array();
$arSections = CIBlockSection::GetList( // CIBlockSection — раздел!
     Array("SORT"=>"ASC"),
     $arFilter,
     true,
     $arSelect
);
while ($arSection = $arSections->GetNext()) {
	    array_push($arResult['SECTIONS'], $arSection);
}

/* Добавляем разделы в arResult */
if(!empty($arResult["SECTION"]["PATH"]) && ($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] ?? '') !== '') {
    $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['SECTIONS'] = array();
    $arFilter = array(
        "ACTIVE" => "Y", // Сортировка по активности
        'IBLOCK_ID' => $arResult['ID'],
        'SECTION_ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["ID"],
    ); 
    $arSelect = array();
    $arSections = CIBlockSection::GetList( // CIBlockSection — раздел!
         Array("SORT"=>"ASC"),
         $arFilter,
         false,
         $arSelect
    );
    while ($arSection = $arSections->GetNext()) {
        // echo "<pre> result_modifier arSection ";
        // print_r($arSection);
        // echo "</pre>";
    	array_push($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['SECTIONS'], $arSection);
    }
}
foreach($arResult['ITEMS'] as &$arItem){
    $arItem['SECTIONS'] = array();
    $arSections = CIBlockElement::GetElementGroups($arItem["ID"], true);
    while ($arSection = $arSections->GetNext()) {
    	array_push($arItem['SECTIONS'], $arSection);
    }
    // echo "<pre> result_modifier arSections ";
    //     print_r($arSections);
    // echo "</pre>";
}

/* Добавляем разделы в arResult */
// $arResult['ITEMS_TRUE'] = "TRUE";
// if(!empty($arResult['ITEMS'])){
//     foreach($arResult['ITEMS'] as &$arItem){
//     $arItem['SECTIONS'] = array();
//     $arFilter = array(
//         "ACTIVE"=>"Y", // Сортировка по активности
//         'ID' => $arItem['IBLOCK_SECTION_ID']); 
//     $arSelect = array();
//     $arSections = CIBlockSection::GetList( // CIBlockSection — раздел!
//          Array("SORT"=>"ASC"),
//          $arFilter,
//          false,
//          $arSelect
//     );
//     while ($arSection = $arSections->GetNext()) {
//     	array_push($arItem['SECTIONS'], $arSection);
//     }
//     }
// }

?>