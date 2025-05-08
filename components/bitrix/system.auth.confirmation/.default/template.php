<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @var array $arParams
 * @var array $arResult
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");

//here you can place your own messages
switch($arResult["MESSAGE_CODE"])
{
	case "E01":
		//When user not found
		$class = "alert-warning";
		break;
	case "E02":
		//User was successfully authorized after confirmation
		$class = "alert-success";
		break;
	case "E03":
		//User already confirm his registration
		$class = "alert-warning";
		break;
	case "E04":
		//Missed confirmation code
		$class = "alert-warning";
		break;
	case "E05":
		//Confirmation code provided does not match stored one
		$class = "alert-danger";
		break;
	case "E06":
		//Confirmation was successfull
		$class = "alert-success";
		break;
	case "E07":
		//Some error occured during confirmation
		$class = "alert-danger";
		break;
	default:
		$class = "alert-warning";
}
?>

<?if($arResult["SHOW_FORM"]):?>
<noindex>
<section class="register mt-5 mb-5">
	<div class="register__container container">
		<div class="register__row row justify-content-center">
			<div class="register__col col-12 col-sm-auto col-xl-4">
				<div class="register__card card p-3 border-1">
					<div class="register__info text-center mb-4">
						<h1><?=GetMessage("CT_BSAC_TITLE")?></h1>
					</div>
					<?if($arResult["MESSAGE_TEXT"] <> ''):
						$text = str_replace(array("<br>", "<br />"), "\n", $arResult["MESSAGE_TEXT"]);?>
						<div class="register__message-text alert <?=$class?>"><?echo nl2br(htmlspecialcharsbx($text))?></div>
					<?endif?>
					<form method="post" action="<?echo $arResult["FORM_ACTION"]?>">

					<div class="register__login-info mb-4">
						<div class="register__login login form-floating mb-2">
							<input class="login__input form-control" id="login" type="text" name="<?echo $arParams["LOGIN"]?>" maxlength="50" value="<?echo $arResult["LOGIN"]?>" placeholder="<?echo GetMessage("CT_BSAC_LOGIN")?>">
							<label class="login__label" for="login"><?echo GetMessage("CT_BSAC_LOGIN")?></label>
						</div>
						<div class="register__confirm-code confirm-code form-floating mb-2">
							<input class="confirm-code__input form-control" type="text" name="<?echo $arParams["CONFIRM_CODE"]?>" maxlength="50" value="<?echo $arResult["CONFIRM_CODE"]?>" placeholder="<?echo GetMessage("CT_BSAC_CONFIRM_CODE")?>">
							<label class="confirm-code__label" for="login"><?echo GetMessage("CT_BSAC_CONFIRM_CODE")?></label>
						</div>
						<div class="register__submit form-submit text-center mb-4">
								<input class="register__submit-button btn btn-primary w-100" type="submit" name="Register" value="<?echo GetMessage("CT_BSAC_CONFIRM")?>">
							</div>
						<input type="hidden" name="<?echo $arParams["USER_ID"]?>" value="<?echo $arResult["USER_ID"]?>" />
					</form>
				</div>
			</div>
		</div>
	<div>
</section>

<?elseif(!$USER->IsAuthorized()):?>
	<?if($arResult["MESSAGE_TEXT"] <> ''):
		$text = str_replace(array("<br>", "<br />"), "\n", $arResult["MESSAGE_TEXT"]);?>
		<div class="register__container container">
			<div class="register__row row justify-content-center">
				<div class="register__col col-auto">
					<div class="register__message-text alert <?=$class?>"><?echo nl2br(htmlspecialcharsbx($text))?></div>
				</div>
			</div>
		</div>
	<?endif?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "", array());?>
<?endif?>