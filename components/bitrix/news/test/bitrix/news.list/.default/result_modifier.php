<?
$arResult['XXX'] = "News List";
/* Добавляем разделы в arResult */
$arResult['SECTIONS'] = array();
$arFilter = array(
    "ACTIVE"=>"Y", // Сортировка по активности
    'IBLOCK_ID' => $arResult['ID']); 
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
?>
<? // Добавляем вложенную структуру разделов https://dev.1c-bitrix.ru/community/webdev/user/17090/blog/13344/
// $arStructured = array();
// $sectionLink = array();
// $arStructured['ROOT'] = array();
// $sectionLink[0] = &$arStructured['ROOT'];
// foreach ($arResult['SECTIONS'] as $arSection) {
//     $sectionLink[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
//     $sectionLink[$arSection['ID']] = &$sectionLink[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
// }
// unset($sectionLink);
// $arResult['STRUCTURED_SECTIONS'] = $arStructured;
?>

