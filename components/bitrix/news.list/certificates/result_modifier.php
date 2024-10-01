<?
/* Добавляем разделы в arResult */
if(($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] ?? '') !== '') {
    // $arResult['SECTIONS'] = array();
    $arFilter = array(
        "ACTIVE" => "Y", // Сортировка по активности
        'IBLOCK_ID' => $arResult['ID'],
        'ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])],
    ); 
    $arSelect = array("DESCRIPTION");
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
    	$arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] = array_merge($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])], $arSection);
    }
}

// echo "<pre> result_modifier arResult ";
// print_r($arResult);
// echo "</pre>";