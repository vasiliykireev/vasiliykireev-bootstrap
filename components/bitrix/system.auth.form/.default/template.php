<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();

if($arParams["SHOW_CAPTCHA"]) {
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$GLOBALS['cpt'] = new CCaptcha();
$GLOBALS['cpt']->SetCodeLength(5);
$GLOBALS['cpt']->SetCode();
$captchaSID = $GLOBALS['cpt']->GetSID();
};
?>

<div class="auth__card card p-3 border-1 m-5">
	<?if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE'])):
		$message = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']['MESSAGE']);?>
		<div class="auth__alert-auth-result-message alert alert-danger">
			<?=nl2br(htmlspecialcharsbx($message))?>
		</div>
	<?endif?>
	<?if($arResult["FORM_TYPE"] == "login"):?>
		<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<div class="auth__login-password mb-4">
				<div class="auth__login login form-floating mb-2">
					<input class="login__input form-control" id="login" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
					<label class="login__label" for="login"><?=GetMessage("AUTH_LOGIN")?></label>
				</div>
				<div class="auth__password password form-floating">
					<input class="password__input form-control" id="password" name="USER_PASSWORD" type="password" maxlength="255" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
					<label class="password__label" for="password"><?=GetMessage("AUTH_PASSWORD")?></label>
				</div>
			</div>
			<?if($arResult["CAPTCHA_CODE"]):?>
				<div class="auth__captcha captcha mb-4">
					<div class="auth__captcha-picture mb-2">
							<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
							<img class="captcha__image" src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
						</div>
					<div class="captcha__field form-floating mb-2">
						<input class="captcha__input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>">
						<label for="captcha" class="captcha__label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
					</div>
				</div>
			<?endif;?>
			<?if ($arParams["STORE_PASSWORD"] == "Y"):?>
				<div class="auth__remember remember form-check mb-4">
					<input class="remember__input form-check-input" type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y">
					<label class="remember__label form-check-label" for="USER_REMEMBER_frm">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>
				</div>
			<?endif?>
			<div class="auth__submit form-submit text-center mb-4">
				<input class="auth__submit-button btn btn-primary w-100" type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
			</div>
			<div class="auth__links">
				<?if ($arParams["SHOW_LINKS"] == "Y"):?>
					<noindex>
						<p class="mb-1">
						<?=GetMessage("AUTH_FORGOT_PASSWORD_TITLE")?> <a href="<?=$arParams["FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
						</p>
					</noindex>
				<?endif?>
				<?if($arParams["SHOW_LINKS"] == "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y"):?>
					<noindex>
						<p class="mb-1"><?=GetMessage("AUTH_FIRST_ONE")?>
							<?=GetMessage("AUTH_REGISTER_TITLE")?> <a href="<?=$arParams["REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
						</p>
					</noindex>
				<?endif?>
			</div>
		</form>
	<?else:?>
		<form class="user" action="<?=$arResult["AUTH_URL"]?>">
			<div class="user__buttons">
				<a class="user__name btn btn-link" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?></a>
				<?foreach ($arResult["GET"] as $key => $value):?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?endforeach?>
				<?=bitrix_sessid_post()?>
				<input type="hidden" name="logout" value="yes" />
			<input class="user__logout btn btn-danger" type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>">
		</form>
	<?endif?>
</div>