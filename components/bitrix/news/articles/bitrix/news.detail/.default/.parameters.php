<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** + Выводить дату элемента */
$arTemplateParameters["DISPLAY_DATE"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
// $arTemplateParameters = array(
	/** -  Выводить название элемента */
	// "DISPLAY_NAME" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	/** - Выводить детальное изображение */
	// "DISPLAY_PICTURE" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	/** -  Выводить текст анонса */
	// "DISPLAY_PREVIEW_TEXT" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	/** - Отображать панель соц. закладок*/
    // "USE_SHARE" => Array( // -
    // 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
    // 	"TYPE" => "CHECKBOX",
    // 	"MULTIPLE" => "N",
    // 	"VALUE" => "Y",
    // 	"DEFAULT" =>"N",
    // 	"REFRESH"=> "Y",
    // ),	
// );
	/** --  Отображать панель соц. закладок*/
// if ($arCurrentValues["USE_SHARE"] == "Y") // -
// {
// 	$arTemplateParameters["SHARE_HIDE"] = array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_HIDE"),
// 		"TYPE" => "CHECKBOX",
// 		"VALUE" => "Y",
// 		"DEFAULT" => "N",
// 	);

// 	$arTemplateParameters["SHARE_TEMPLATE"] = array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_TEMPLATE"),
// 		"DEFAULT" => "",
// 		"TYPE" => "STRING",
// 		"MULTIPLE" => "N",
// 		"COLS" => 25,
// 		"REFRESH"=> "Y",
// 	);
	
// 	if (trim($arCurrentValues["SHARE_TEMPLATE"]) == '')
// 		$shareComponentTemlate = false;
// 	else
// 		$shareComponentTemlate = trim($arCurrentValues["SHARE_TEMPLATE"]);

// 	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bitrix/main.share/util.php");

// 	$arHandlers = __bx_share_get_handlers($shareComponentTemlate);

// 	$arTemplateParameters["SHARE_HANDLERS"] = array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SYSTEM"),
// 		"TYPE" => "LIST",
// 		"MULTIPLE" => "Y",
// 		"VALUES" => $arHandlers["HANDLERS"],
// 		"DEFAULT" => $arHandlers["HANDLERS_DEFAULT"],
// 	);

// 	$arTemplateParameters["SHARE_SHORTEN_URL_LOGIN"] = array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_LOGIN"),
// 		"TYPE" => "STRING",
// 		"DEFAULT" => "",
// 	);
	
// 	$arTemplateParameters["SHARE_SHORTEN_URL_KEY"] = array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_KEY"),
// 		"TYPE" => "STRING",
// 		"DEFAULT" => "",
// 	);
// }
/** + Преобразовывать обычный текст детального описания из Markdown в HTML */
$arTemplateParameters["DETAIL_MARKDOWN"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_MARKDOWN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
/** + Выводить на детальной странице элемента микроразметку Schema.org JSON-LD */
$arTemplateParameters["SCHEMAORG_JSON"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_JSON"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
/** ++ Тип статьи Schema.org */
if (($arCurrentValues['SCHEMAORG_JSON'] ?? 'N') === 'Y') {
	$arTemplateParameters["SCHEMAORG_TYPE"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_TYPE"),
		"TYPE" => "LIST",
		"VALUES" => ["Article" => "Article", "NewsArticle" => "NewsArticle", "BlogPosting" => "BlogPosting"],
	);
}

?>