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
		<div class="restore__row row justify-content-center">
			<div class="restore__col col-12 col-sm-auto col-xl-4">
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
					<?endif?>
					<?if($arParams["~AUTH_RESULT"]["TYPE"] == "OK"){?>
						<div class="restore__links">
							<p class="mb-1"><a class="restore__auth-link btn btn-primary w-100"href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></p>
						</div>
					<?} else {?>
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
								<div id="bx_chpass_resend"></div>
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
							<div class="restore__captcha captcha mb-4">
								<div class="captcha__picture mb-2">
										<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
										<img class="captcha__image" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
									</div>
								<div class="captcha__field form-floating mb-2">
									<input class="captcha__input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?=GetMessage("system_auth_captcha")?>">
									<label for="captcha" class="captcha__label"><?=GetMessage("system_auth_captcha")?></label>
								</div>
							</div>
						<?endif?>
						<div class="restore__submit form-submit text-center mb-4">
							<input class="restore__submit-button btn btn-primary w-100" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_CHANGE")?>">
						</div>
						<div class="restore__links">
							<p class="mb-1"><?=GetMessage("AUTH_AUTH_TITLE")?> <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></p>
						</div>
						<?}?>
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