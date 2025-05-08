<?php

use Bitrix\Main\Web\Json;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
?>
<section class="restore mt-5 mb-5">
	<div class="restore__container container">
		<div class="restore__info-row row justify-content-center">
			<div class="restore__info-col col-12 col-sm-auto col-xl-4">
				<div class="restore__card card p-3 border-1">
					<div class="restore__info text-center mb-4">
						<h1><?=GetMessage("AUTH_CHANGE_PASSWORD")?></h1>
					</div>
					<?if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
						$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
						<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
					<?endif?>
					<?if($arResult["PHONE_REGISTRATION"]):?>
						<div class="alert alert-danger" id="bx_chpass_error" style="display:none"></div>
						<div id="bx_chpass_resend"></div>
					<?endif?>
					<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
						<?if ($arResult["BACKURL"] <> ''): ?>
							<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
						<? endif ?>
						<input type="hidden" name="AUTH_FORM" value="Y">
						<input type="hidden" name="TYPE" value="CHANGE_PWD">
						<?if($arResult["PHONE_REGISTRATION"]):?>
							<div class="restore__sms mb-4">
								<div class="restore__phone phone form-floating mb-2">
									<input class="phone__input form-control" id="phone" type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" disabled="disabled"  placeholder="<?echo GetMessage("change_pass_phone_number")?>">
									<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
									<label class="phone__label" for="phone"><?echo GetMessage("change_pass_phone_number")?></label>
								</div>
								<div class="restore__sms-code sms-code form-floating mb-2">
									<input class="sms-code__input form-control" id="sms-code" type="text" name="USER_CHECKWORD" maxlength="255" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off"  placeholder="<?echo GetMessage("change_pass_code")?>">
									<label class="sms-code__input" for="sms-code"><?echo GetMessage("change_pass_code")?></label>
								</div>
							</div>
						<?else:?>
							<div class="restore__login-password mb-4">
								<div class="restore__login login form-floating mb-2">
									<input class="login__input form-control" id="login" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
									<label class="login__label" for="login"><?=GetMessage("AUTH_LOGIN")?></label>
								</div>

								<?if($arResult["USE_PASSWORD"]):?>
									<div class="restore__password password form-floating mb-2">
										<input class="password__input form-control" id="password" type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="<?=$arResult["USER_CURRENT_PASSWORD"]?>" autocomplete="new-password" placeholder="<?echo GetMessage("system_change_pass_current_pass")?>">
										<label class="password__label" for="password"><?echo GetMessage("system_change_pass_current_pass")?></label>
									</div>
								<?else:?>
									<div class="restore__checkword checkword form-floating mb-2">
										<input class="checkword__input form-control" id="checkword" type="text" name="USER_CHECKWORD" maxlength="255" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_CHECKWORD")?>">
										<label class="checkword__label" for="password"><?=GetMessage("AUTH_CHECKWORD")?></label>
									</div>
								<?endif;?>
							</div>
						<?endif?>
						<div class="restore__passwords mb-4">
							<div class="restore__password password form-floating mb-2">
								<input class="restore__input form-control" id="password" type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="new-password" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>">
								<label class="restore__label" for="password"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></label>
							</div>
							<div class="restore__password-confirm password-confirm form-floating mb-2">
								<input class="password-confirm__input form-control" id="password-confirm" type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="new-password" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>">
								<label class="password-confirm__label" for="password-confirm"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></label>
								<div class="password__caption form-text"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
							</div>
						</div>

						<?if ($arResult["USE_CAPTCHA"]):?>
							<div class="restore__use-captcha mb-4">
								<div class="restore__captcha-picture mb-2">
										<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
										<img class="" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
									</div>
								<div class="restore__captcha captcha form-floating mb-2">
									<input type="text" class="captcha__input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?=GetMessage("system_auth_captcha")?>">
									<label for="captcha" class="captcha__label"><?=GetMessage("system_auth_captcha")?></label>
								</div>
							</div>
						<?endif?>
						<div class="auth__submit form-submit text-center mb-4">
							<input type="submit" class="auth__submit-button btn btn-primary w-100" name="send_account_info" value="<?=GetMessage("AUTH_CHANGE")?>">
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
<script>
	document.bform.USER_CHECKWORD.focus();
</script>
<?if($arResult["PHONE_REGISTRATION"]):?>
	<script>
	new BX.PhoneAuth({
		containerId: 'bx_chpass_resend',
		errorContainerId: 'bx_chpass_error',
		interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
		data:
			<?= Json::encode([
				'signedData' => $arResult["SIGNED_DATA"]
			]) ?>,
		onError:
			function(response)
			{
				var errorNode = BX('bx_chpass_error');
				errorNode.innerHTML = '';
				for(var i = 0; i < response.errors.length; i++)
				{
					errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
				}
				errorNode.style.display = '';
			}
	});
	</script>
<?endif?>

<?/*
<div class="bx-authform">

<?
if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

<?if($arResult["SHOW_FORM"]):?>

	<h3 class="bx-title"><?=GetMessage("AUTH_CHANGE_PASSWORD")?></h3>

	<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
<?if ($arResult["BACKURL"] <> ''): ?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<? endif ?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="CHANGE_PWD">

<?if($arResult["PHONE_REGISTRATION"]):?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("change_pass_phone_number")?></div>
			<div class="bx-authform-input-container">
				<input type="text" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" disabled="disabled" />
				<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"])?>" />
			</div>
		</div>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("change_pass_code")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_CHECKWORD" maxlength="255" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
			</div>
		</div>
<?else:?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=GetMessage("AUTH_LOGIN")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
			</div>
		</div>
<?
	if($arResult["USE_PASSWORD"]):
?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?echo GetMessage("system_change_pass_current_pass")?></div>
			<div class="bx-authform-input-container">
<?if($arResult["SECURE_AUTH"]):?>
				<div class="bx-authform-psw-protected" id="bx_auth_secure_pass" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>

<script>
document.getElementById('bx_auth_secure_pass').style.display = '';
</script>
<?endif?>
				<input type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="<?=$arResult["USER_CURRENT_PASSWORD"]?>" autocomplete="new-password" />
			</div>
		</div>
<?
	else:
?>
		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=GetMessage("AUTH_CHECKWORD")?></div>
			<div class="bx-authform-input-container">
				<input type="text" name="USER_CHECKWORD" maxlength="255" value="<?=$arResult["USER_CHECKWORD"]?>" autocomplete="off" />
			</div>
		</div>
<?
	endif;
?>
<?endif?>

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></div>
			<div class="bx-authform-input-container">
<?if($arResult["SECURE_AUTH"]):?>
				<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>

<script>
document.getElementById('bx_auth_secure').style.display = '';
</script>
<?endif?>
				<input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="new-password" />
			</div>
		</div>

		<div class="bx-authform-formgroup-container">
			<div class="bx-authform-label-container"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></div>
			<div class="bx-authform-input-container">
<?if($arResult["SECURE_AUTH"]):?>
				<div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>

<script>
document.getElementById('bx_auth_secure_conf').style.display = '';
</script>
<?endif?>
				<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="new-password" />
			</div>
		</div>

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
			<input type="submit" class="btn btn-primary" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
		</div>

		<div class="bx-authform-description-container">
			<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
		</div>
	</form>

<script>
document.bform.USER_CHECKWORD.focus();
</script>

<?if($arResult["PHONE_REGISTRATION"]):?>

<script>
new BX.PhoneAuth({
	containerId: 'bx_chpass_resend',
	errorContainerId: 'bx_chpass_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?= Json::encode([
			'signedData' => $arResult["SIGNED_DATA"]
		]) ?>,
	onError:
		function(response)
		{
			var errorNode = BX('bx_chpass_error');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
			}
			errorNode.style.display = '';
		}
});
</script>

<div class="alert alert-danger" id="bx_chpass_error" style="display:none"></div>

<div id="bx_chpass_resend"></div>

<?endif?>

<?endif;?>

	<div class="bx-authform-link-container">
		<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
	</div>

</div>
*/?>