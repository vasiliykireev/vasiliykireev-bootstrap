<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
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
);
?>
