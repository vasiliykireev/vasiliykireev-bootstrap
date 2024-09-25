<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_LINK" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DISPLAY_LINK"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"DEFAULT_LINK_CAPTION" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DEFAULT_LINK_CAPTION"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"DEBUG" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DEBUG"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	// "DISPLAY_DATE" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	// "DISPLAY_NAME" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	// "DISPLAY_PICTURE" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
	// "DISPLAY_PREVIEW_TEXT" => Array(
	// 	"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
	// 	"TYPE" => "CHECKBOX",
	// 	"DEFAULT" => "Y",
	// ),
);
