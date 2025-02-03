<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arCurrentValues */


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
	"DEFAULT" => "N",
);
// $arTemplateParameters = array(
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
	/** - Отображать панель соц. закладок*/
	// "USE_SHARE" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" =>"N",
	// 	"REFRESH"=> "Y",
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
	/** + Преобразовывать обычный текст детального описания из Markdown в HTML */
$arTemplateParameters["DETAIL_MARKDOWN"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_MARKDOWN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
/** + Устанавливать канонический URL разделов */
$arTemplateParameters["SECTION_SET_CANONICAL_URL"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTION_CANONICAL"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
/** + Выводить на детальной странице элемента структурированные данные Schema.org для статей в JSON-LD */
// $arTemplateParameters["SCHEMAORG_JSON"] = array(
// 	"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_JSON"),
// 	"TYPE" => "CHECKBOX",
// 	"DEFAULT" => "Y",
// );
/** + Тип статьи Schema.org */
$arTemplateParameters["SCHEMAORG_TYPE"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_TYPE"),
	"TYPE" => "LIST",
	"VALUES" => ["Article" => "Article", "NewsArticle" => "NewsArticle", "BlogPosting" => "BlogPosting"],
);
/** Тип автора Schema.org */
$arTemplateParameters["SCHEMAORG_AUTHOR"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_AUTHOR"),
	"TYPE" => "LIST",
	"VALUES" => ["Person" => "Person", "Organization" => "Organization"],
);
/** Тип издателя Schema.org */
$arTemplateParameters["SCHEMAORG_PUBLISHER"] = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_SCHEMAORG_PUBLISHER"),
	"TYPE" => "LIST",
	"VALUES" => ["Person" => "Person", "Organization" => "Organization"],
);

/** -- Отображать панель соц. закладок*/
// if (($arCurrentValues['USE_SHARE'] ?? 'N') === 'Y')
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

// 	$shareComponentTemplate = (trim((string)($arCurrentValues["SHARE_TEMPLATE"] ?? '')));
// 	if ($shareComponentTemplate === '')
// 	{
// 		$shareComponentTemplate = false;
// 	}

// 	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bitrix/main.share/util.php");

// 	$arHandlers = __bx_share_get_handlers($shareComponentTemplate);

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