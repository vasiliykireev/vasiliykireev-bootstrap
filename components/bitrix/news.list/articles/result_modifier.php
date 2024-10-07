<?

if($arParams['DISPLAY_SECTIONS']){
/* Список разделов инфоблока */
    $arResult['SECTIONS'] = array();
    $arFilter = array(
        "ACTIVE"=>"Y",
        'IBLOCK_ID' => $arResult['ID'],
        'DEPTH_LEVEL' => 1,
        'CNT_ACTIVE' => "Y",
    ); 
    $arSelect = array();
    $arSections = CIBlockSection::GetList(
         Array("SORT"=>"ASC"),
         $arFilter,
         true,
         $arSelect
    );
    while ($arSection = $arSections->GetNext()) {
    	    array_push($arResult['SECTIONS'], $arSection);
    }
    
    if(!empty($arResult["SECTION"]["PATH"]) && ($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])] ?? '') !== '') {
        /* Список разделов текущего раздела*/
        $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['SECTIONS'] = array();
        $arFilter = array(
            "ACTIVE" => "Y",
            'IBLOCK_ID' => $arResult['ID'],
            'SECTION_ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["ID"],
        ); 
        $arSelect = array();
        $arSections = CIBlockSection::GetList(
             Array("SORT"=>"ASC"),
             $arFilter,
             false,
             $arSelect
        );
        while ($arSection = $arSections->GetNext()) {
        	array_push($arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['SECTIONS'], $arSection);
        }
        /* Описание текущего раздела */
        $arFilter = array(
            "ACTIVE" => "Y",
            'IBLOCK_ID' => $arResult['ID'],
            'ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["ID"],
        ); 
        $arSelect = array("DESCRIPTION");
        $arSections = CIBlockSection::GetList(
             Array("SORT"=>"ASC"),
             $arFilter,
             false,
             $arSelect
        );
        while ($arSection = $arSections->GetNext()) {
            $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["DESCRIPTION"] = $arSection["DESCRIPTION"];
        }

    }
    /* Список разделов элемента */
    if($arParams['DISPLAY_SECTIONS_BUTTONS'] == 'Y'){
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
    }
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