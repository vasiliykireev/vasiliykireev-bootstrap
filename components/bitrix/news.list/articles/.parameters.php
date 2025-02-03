<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** + Выводить дату элемента */
$arTemplateParameters["DISPLAY_DATE"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
/** Выводить автора элемента */
$arTemplateParameters["DISPLAY_AUTHOR"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_AUTHOR"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
// $arTemplateParameters = array(
	/** - Выводить название элемента */
	// "DISPLAY_NAME" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	/** - Выводить изображение для анонса */
	// "DISPLAY_PICTURE" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	/** - Выводить текст анонса */
	// "DISPLAY_PREVIEW_TEXT" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
// );
/** + Выводить заголовок */
$arTemplateParameters["DISPLAY_HEADER"] = array(
    "NAME" => GetMessage("T_IBLOCK_DESC_NEWS_HEADER"),
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
);
/** + Выводить разделы */
$arTemplateParameters["DISPLAY_SECTIONS"] = array(
    "NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTIONS"),
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
);
/** ++ Выводить разделы элемента */
if (($arCurrentValues['DISPLAY_SECTIONS'] ?? 'N') === 'Y') {
    $arTemplateParameters["DISPLAY_SECTIONS_BUTTONS"] = array(
        "NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTION_BUTTONS"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
    );
}
/** + Выводить ссылку на элемент */
$arTemplateParameters["DISPLAY_DETAIL_LINK"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DISPLAY_DETAIL_LINK"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
/** ++ Текст ссылки на элемент*/
if (($arCurrentValues['DISPLAY_DETAIL_LINK'] ?? 'N') === 'Y') {
    $arTemplateParameters["DEFAULT_DETAIL_LINK_CAPTION"] = array(
    	"NAME" => GetMessage("T_IBLOCK_DESC_DEFAULT_DETAIL_LINK_CAPTION"),
    	"TYPE" => "STRING",
    	"DEFAULT" => GetMessage("T_IBLOCK_DESC_DEFAULT_DETAIL_LINK_CAPTION_VALUE"),
    );
}
/** + Выводить внешнюю ссылку элемента */
$arTemplateParameters["DISPLAY_EXTERNAL_LINK"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DISPLAY_EXTERNAL_LINK"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
/** ++ Текст внешней ссылки по умолчанию */
if (($arCurrentValues['DISPLAY_EXTERNAL_LINK'] ?? 'N') === 'Y') {
    $arTemplateParameters["DEFAULT_EXTERNAL_LINK_CAPTION"] = array(
    	"NAME" => GetMessage("T_IBLOCK_DESC_DEFAULT_EXTERNAL_LINK_CAPTION"),
    	"TYPE" => "STRING",
    	"DEFAULT" => GetMessage("T_IBLOCK_DESC_DEFAULT_EXTERNAL_LINK_CAPTION_VALUE"),
    );
}
/** + Устанавливать канонический URL разделов */
$arTemplateParameters["SECTION_SET_CANONICAL_URL"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTION_CANONICAL"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
?>
