<?
// Open Graph https://marketplace.1c-bitrix.ru/solutions/dev2fun.opengraph/#tab-about-link
// \Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
// \Dev2fun\Module\OpenGraph::Show($arResult['ID'],'section'); 

if($arParams["DISPLAY_HEADER"] == 'Y' && empty($arResult["SECTION"]["PATH"])) {
    $arResult['IBLOCK_PICTURE'] = CFile::GetFileArray(CIBlock::GetArrayByID($arResult['ID'], 'PICTURE'));
    /* Изменение размера картинки на фактический */
    $arResult['IBLOCK_RESIZED_PICTURE'] = CFile::ResizeImageGet(
        $arResult['IBLOCK_PICTURE'], // file
        array("width" => 512, "height" => 256), // Size
        BX_RESIZE_IMAGE_EXACT, // resizeType
        true, // InitSizes
        false, // Filters
        true, // Immediate
        90 // jpgQuality
    );
}

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
        /* Описание и изображения текущего раздела */
        $arFilter = array(
            "ACTIVE" => "Y",
            'IBLOCK_ID' => $arResult['ID'],
            'ID' => $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["ID"],
        ); 
        $arSelect = array(/*"DESCRIPTION"*/);
        $arSections = CIBlockSection::GetList(
             Array("SORT"=>"ASC"),
             $arFilter,
             false,
             $arSelect
        );
        while ($arSection = $arSections->GetNext()) {
            $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["PICTURE"] = CFile::GetFileArray($arSection["PICTURE"]);
            /* Изменение размера картинки на фактический */
            $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]['RESIZED_PICTURE'] = CFile::ResizeImageGet(
                $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["PICTURE"], // file
                array("width" => 512, "height" => 256), // Size
                BX_RESIZE_IMAGE_EXACT, // resizeType
                true, // InitSizes
                false, // Filters
                true, // Immediate
                90 // jpgQuality
            );
            // $arResult["SECTION"]["PATH"][array_key_last($arResult["SECTION"]["PATH"])]["DETAIL_PICTURE"] = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
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
        }
    }
}
foreach($arResult['ITEMS'] as &$arItem){
    if(($arItem['MODIFIED_BY'] ?? '') !== '') {
        $filter = Array (
            "ID" => $arItem['MODIFIED_BY'],
        );
        $arParameters["FIELDS"] = Array ("NAME", "LAST_NAME");
        $arItem['AUTHOR'] = CUser::GetList(($by="id"), ($order="desc"), $filter, $arParameters)->fetch();
    }
}
?>