<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** + Выводить дату элемента */
$arTemplateParameters["SHOW_CAPTCHA"] = array(
	"NAME" => GetMessage("SHOW_CAPTCHA"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
$arTemplateParameters["STORE_PASSWORD"] = array(
	"NAME" => GetMessage("STORE_PASSWORD"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
$arTemplateParameters["SHOW_LINKS"] = array(
	"NAME" => GetMessage("SHOW_LINKS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
$arTemplateParameters["NEW_USER_REGISTRATION"] = array(
	"NAME" => GetMessage("NEW_USER_REGISTRATION"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);