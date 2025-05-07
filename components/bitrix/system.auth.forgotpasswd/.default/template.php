<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

?>

<section class="restore mt-5 mb-5">
	<div class="restore__container container">
		<div class="restore__info-row row justify-content-center">
			<div class="restore__info-col col-12 col-sm-auto col-xl-4">
				<div class="restore__card card p-3 border-1">
					<div class="restore__info text-center">
						<h1><?=GetMessage("RESTORE_TITLE")?></h1>
					</div>
					<?if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
						$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
						<div class="restore__alert alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
					<?endif?>
					<form class="restore__form" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
						<?if($arResult["BACKURL"] <> ''):?>
								<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
						<?endif?>
						<input type="hidden" name="AUTH_FORM" value="Y">
						<input type="hidden" name="TYPE" value="SEND_PWD">
						<?if(!$arResult["PHONE_REGISTRATION"]):?>
						<div class="restore__login-password mb-3">
							<div class="restore__login login form-floating mb-2">
								<input type="text" class="login__input form-control" id="login" name="USER_LOGIN" maxlength="255" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?echo GetMessage("AUTH_LOGIN_EMAIL")?>">
								<label class="login__label" for="login"><?echo GetMessage("AUTH_LOGIN_EMAIL")?></label>
								<div class="login__caption form-text"><?echo GetMessage("forgot_pass_email_note")?></div>
							</div>
						</div>
						<input type="hidden" name="USER_EMAIL" />
						<?endif?>
						<?if($arResult["PHONE_REGISTRATION"]):?>
						<div class="restore__sms mb-3">
							<div class="restore__phone phone form-floating mb-2">
								<input type="text" class="phone__input form-control" id="phone" type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" placeholder="<?echo GetMessage("forgot_pass_phone_number")?>">
								<label class="phone__label" for="phone"><?echo GetMessage("forgot_pass_phone_number")?></label>
								<div class="phone__caption form-text"><?echo GetMessage("forgot_pass_phone_number_note")?></div>
							</div>
						</div>
						<?endif?>
						<?if ($arResult["USE_CAPTCHA"]):?>
							<div class="restore__use-captcha mb-3">
								<div class="restore__captcha-picture">
										<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
										<img class="" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
									</div>
								<div class="restore__captcha captcha form-floating mt-2 mb-3">
									<input type="text" class="captcha__input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?=GetMessage("system_auth_captcha")?>">
									<label for="captcha" class="captcha__label"><?=GetMessage("system_auth_captcha")?></label>
								</div>
							</div>
						<?endif?>
						<div class="auth__submit form-submit text-center mb-3">
							<input type="submit" class="auth__submit-button btn btn-primary w-100" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>">
						</div>
						<div class="auth__links">
							<p class="mb-1"><?=GetMessage("AUTH_AUTH_TITLE")?> <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>




<?/*<div class="bx-authform">

<?if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

	<h3 class="bx-title"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h3>

	<p class="bx-authform-content-container"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></p>

	<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("AUTH_LOGIN_EMAIL")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["USER_LOGIN"]?>" />
				<input type="hidden" name="USER_EMAIL" />
			</div>
			<div class="bx-authform-note-container"><?echo GetMessage("forgot_pass_email_note")?></div>
		</div>

<?if($arResult["PHONE_REGISTRATION"]):?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("forgot_pass_phone_number")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" />
			</div>
			<div class="bx-authform-note-container"><?echo GetMessage("forgot_pass_phone_number_note")?></div>
		</div>
<?endif?>

<?if ($arResult["USE_CAPTCHA"]):?>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("system_auth_captcha")?></div>
			<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
			<div class="bx-authform-input-container">
				<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
			</div>
		</div>

<?endif?>

		<div class="bx-authform-formgroup-container">
			<input type="submit" class="btn btn-primary" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
		</div>

		<div class="bx-authform-link-container">
			<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
		</div>

	</form>

</div>

*/?>

<script>
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>