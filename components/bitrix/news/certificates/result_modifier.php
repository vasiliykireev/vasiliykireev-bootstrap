<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
/** @var array $arParams */
$arParams['USE_SHARE'] = (string)($arParams['USE_SHARE'] ?? 'N');
$arParams['USE_SHARE'] = $arParams['USE_SHARE'] === 'Y' ? 'Y' : 'N';
$arParams['SHARE_HIDE'] = (string)($arParams['SHARE_HIDE'] ?? 'N');
$arParams['SHARE_HIDE'] = $arParams['SHARE_HIDE'] === 'Y' ? 'Y' : 'N';
$arParams['SHARE_TEMPLATE'] = (string)($arParams['SHARE_TEMPLATE'] ?? 'N');
$arParams['SHARE_HANDLERS'] ??= [];
$arParams['SHARE_HANDLERS'] = is_array($arParams['SHARE_HANDLERS']) ? $arParams['SHARE_HANDLERS'] : [];
$arParams['SHARE_SHORTEN_URL_LOGIN'] = (string)($arParams['SHARE_SHORTEN_URL_LOGIN'] ?? 'N');
$arParams['SHARE_SHORTEN_URL_KEY'] = (string)($arParams['SHARE_SHORTEN_URL_KEY'] ?? 'N');


if(CModule::IncludeModule("iblock")) { 
$arResult['XXX'] = "News List";
/* Добавляем разделы в arResult */
$arResult['SECTIONS'] = array();
$arFilter = array(
    "ACTIVE"=>"Y", // Сортировка по активности
    'IBLOCK_ID' => $arParams['IBLOCK_ID']); 
$arSelect = array();
$arSections = CIBlockSection::GetList( // CIBlockSection — раздел!
     Array("SORT"=>"ASC"),
     $arFilter,
     false,
     $arSelect
);
while ($arSection = $arSections->GetNext()) {
	    array_push($arResult['SECTIONS'], $arSection);
}
}

/* Выводим элементы в arResult */
if(isset($arResult["SECTIONS"])){
	foreach($arResult["SECTIONS"] as &$arSection){
		$arSection['YYY'] = "News List";
		$arSection['ITEMS'] = array();
$arFilter = Array(
    'SECTION_ID' => $arSection["ID"],
); 
$arSelect = array();
$arItems = CIBlockElement::GetList( // CIBlockElement — элемент!
     Array("SORT"=>"ASC"),
     $arFilter,
     false,
     $arSelect
);
while ($arItem = $arItems->GetNext()) {
	array_push($arSection['ITEMS'], $arItem);
	    // echo "<pre>";
		// echo "arItem ";
	    // print_r($arItem);
		// echo "</pre>";
}
}
}


?>
<?
/* Добавляем элементы в разделы в arResults */
// if(isset($arResult["SECTIONS"])){
// 	foreach($arResult["SECTIONS"] as &$arSection){
// 		foreach($arResult["ITEMS"] as $arItem){
// 			if($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]){
// 				if(!isset($arSection["ITEMS"])){
//                     $arSection["ITEMS"] = array();}
// 				array_push($arSection["ITEMS"], $arItem);
// 			}
// 		}
// 	}
// }
