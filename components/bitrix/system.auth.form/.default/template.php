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

	<table width="95%">
		<?/*<tr>
			<td colspan="2">
			<?=GetMessage("AUTH_LOGIN")?>:<br />
			<input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" />
			<script>
				BX.ready(function() {
					var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
					if (loginCookie)
					{
						var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
						var loginInput = form.elements["USER_LOGIN"];
						loginInput.value = loginCookie;
					}
				});
			</script>
			</td>
		</tr>*/?>
		<?/*<tr>
			<td colspan="2">
			<?=GetMessage("AUTH_PASSWORD")?>:<br />
			<input type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" />
<?//if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script>
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?//endif?>
			</td>
		</tr>*/?>
<?//if ($arResult["STORE_PASSWORD"] == "Y"):?>
		<?/*<tr>
			<td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label></td>
		</tr>*/?>
<?//endif?>
<?//if ($arResult["CAPTCHA_CODE"]):?>
		<?/*<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>*/?>
<?//endif?>
		<?/*<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>*/?>
<?//if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
		<?/*<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br /></td>
		</tr>*/?>
<?//endif?>

		<?/*<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex></td>
		</tr>*/?>
<?/*if($arResult["AUTH_SERVICES"]):?>
		<tr>
			<td colspan="2">
				<div class="bx-auth-lbl"><?=GetMessage("socserv_as_user_form")?></div>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"SUFFIX"=>"form",
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
			</td>
		</tr>
<?endif*/?>
	</table>
</form>

<?/*if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif*/?>

<?/*elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?//if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?//endif?>
<?//if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?//endif*/?>
		<?/*<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>*/?>
		<?/*<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>*/?>
	</table>
</form>

<?
else:
?>

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