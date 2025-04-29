<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle(GetMessage("AUTH_TITLE"));
?>
<section class="auth mt-5 mb-5">
	<div class="auth__container container">
		<div class="auth__info-row row justify-content-center">
			<div class="auth__card col-auto col-xl-4 card p-3 border-0">
				<div class="auth__info text-center">
					<h1><?=GetMessage("AUTH_TITLE")?></h1>
					<p><?=GetMessage("AUTH_PLEASE_AUTH")?></p>
				</div>

				<?if (!empty($arParams["~AUTH_RESULT"])) {?>
					<div class="auth__info alert alert-danger" role="alert">
					<?=GetMessage("AUTH_RESULT_MESSAGE")?>
				</div>
				<? } ?>

				<? if (!empty($arResult['ERROR_MESSAGE'])) { ?>
					<div class="auth__alert alert alert-danger" role="alert">
					<?ShowMessage($arResult['ERROR_MESSAGE']);?>
					</div>
				<? } ?>

				<form class="auth__form" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
					<input type="hidden" name="AUTH_FORM" value="Y" />
					<input type="hidden" name="TYPE" value="AUTH" />
					<?if ($arResult["BACKURL"] <> ''):?>
						<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
					<?endif?>
					<?foreach ($arResult["POST"] as $key => $value):?>
						<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
					<?endforeach?>

					<div class="auth__login-password mb-3">
						<div class="auth__login form-floating mb-2">
							<input type="text" class="auth__login-input form-control" id="login" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
							<label class="auth__login-label" for="login"><?=GetMessage("AUTH_LOGIN")?></label>
						</div>

						<div class="auth__password form-floating">
							<input type="password" class="auth__password-input form-control" id="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
							<label class="auth__password-label" for="password"><?=GetMessage("AUTH_PASSWORD")?></label>
							<?/* Не нужно показывать информацию о защищенность
							<?if($arResult["SECURE_AUTH"]):?>
								<div class="auth__password-caption form-text bx-auth-secure" id="bx_auth_secure" style="display:none">
									<?echo GetMessage("AUTH_SECURE_NOTE")?>
								</div>
								<noscript>
								<div class="form-text bx-auth-secure" >
									<?echo GetMessage("AUTH_NONSECURE_NOTE")?>
								</div>
								</noscript>
								<script>
								document.querySelector('.auth__password-input').addEventListener('focus', function (event) {
									document.getElementById('bx_auth_secure').style.display = 'block';
								})
								</script>
							<?endif?>*/?>
						</div>
					</div>

					<?if($arResult["CAPTCHA_CODE"]):?>
						<div class="auth__captcha mb-3">
							<div class="auth__captcha-picture">
									<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
									<img class="" src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
								</div>
							<div class="auth__captcha form-floating mt-2 mb-3">
								<input type="text" class="auth__captcha-input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>">
								<label for="captcha" class="auth__captcha-label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
							</div>
						</div>
					<?endif;?>

					<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
						<div class="auth__remember form-check mb-3">
							<input class="auth__remember-input form-check-input" type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y">
							<label class="auth__remember-label form-check-label" for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>
						</div>
					<?endif?>
					
					<div class="auth__submit form-submit text-center mb-3">
						<input type="submit" class="auth__submit-button btn btn-primary w-100" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
					</div>
					<div class="auth__links">
						<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
							<noindex>
								<p class="mb-1">
									<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
								</p>
							</noindex>
						<?endif?>

						<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y"):?>
							<noindex>
								<p class="mb-1"><?=GetMessage("AUTH_FIRST_ONE")?>
									<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
								</p>
							</noindex>
						<?endif?>
					</div>
				</form>
			</div>
		</div>	
	</div>
</section>

<script>
	<?if ($arResult["LAST_LOGIN"] <> ''):?>
		try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
		try{document.form_auth.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>

<?/*

<?
if (!empty($arParams["~AUTH_RESULT"]))
{
	ShowMessage($arParams["~AUTH_RESULT"]);
}

if (!empty($arResult['ERROR_MESSAGE']))
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>
//

<div class="bx-auth">
<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>
	<div class="bx-auth-note"><?=GetMessage("AUTH_PLEASE_AUTH")?></div>

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if ($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

		<table class="bx-auth-table">
			<tr>
				<td class="bx-auth-label"><?=GetMessage("AUTH_LOGIN")?></td>
				<td><input class="bx-auth-input form-control" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label"><?=GetMessage("AUTH_PASSWORD")?></td>
				<td><input class="bx-auth-input form-control" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script>
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
				</td>
			</tr>
			<?if($arResult["CAPTCHA_CODE"]):?>
				<tr>
					<td></td>
					<td><input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
				</tr>
				<tr>
					<td class="bx-auth-label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</td>
					<td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" /></td>
				</tr>
			<?endif;?>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
			<tr>
				<td></td>
				<td><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><label for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
			</tr>
<?endif?>
			<tr>
				<td></td>
				<td class="authorize-submit-cell"><input type="submit" class="btn btn-primary" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" /></td>
			</tr>
		</table>

<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</p>
		</noindex>
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
				<?=GetMessage("AUTH_FIRST_ONE")?>
			</p>
		</noindex>
<?endif?>

	</form>
</div>

<script>
<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>

*/
