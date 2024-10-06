<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arCurrentValues */

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"USE_SHARE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" =>"N",
		"REFRESH"=> "Y",
	),
	"DISPLAY_HEADER" => Array(
    	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_HEADER"),
    	"TYPE" => "CHECKBOX",
    	"DEFAULT" => "N",
	),
	"DISPLAY_SECTIONS" => Array(
    	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTIONS"),
    	"TYPE" => "CHECKBOX",
    	"DEFAULT" => "N",
	),
	"DISPLAY_SECTIONS_BUTTONS" => Array(
    	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SECTION_BUTTONS"),
    	"TYPE" => "CHECKBOX",
    	"DEFAULT" => "N",
	),
	"DISPLAY_DETAIL_LINK" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DISPLAY_DETAIL_LINK"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_EXTERNAL_LINK" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DISPLAY_EXTERNAL_LINK"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"DEFAULT_EXTERNAL_LINK_CAPTION" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DEFAULT_EXTERNAL_LINK_CAPTION"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DETAIL_MARKDOWN" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_MARKDOWN"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
);

if (($arCurrentValues['USE_SHARE'] ?? 'N') === 'Y')
{
	$arTemplateParameters["SHARE_HIDE"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_HIDE"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "N",
	);

	$arTemplateParameters["SHARE_TEMPLATE"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_TEMPLATE"),
		"DEFAULT" => "",
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"COLS" => 25,
		"REFRESH"=> "Y",
	);

	$shareComponentTemplate = (trim((string)($arCurrentValues["SHARE_TEMPLATE"] ?? '')));
	if ($shareComponentTemplate === '')
	{
		$shareComponentTemplate = false;
	}

	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bitrix/main.share/util.php");

	$arHandlers = __bx_share_get_handlers($shareComponentTemplate);

	$arTemplateParameters["SHARE_HANDLERS"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SYSTEM"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arHandlers["HANDLERS"],
		"DEFAULT" => $arHandlers["HANDLERS_DEFAULT"],
	);

	$arTemplateParameters["SHARE_SHORTEN_URL_LOGIN"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_LOGIN"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);

	$arTemplateParameters["SHARE_SHORTEN_URL_KEY"] = array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_SHARE_SHORTEN_URL_KEY"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
}