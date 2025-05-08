<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle(GetMessage("AUTH_TITLE"));
?>
<section class="auth mt-5 mb-5">
	<div class="auth__container container">
		<div class="auth__row row justify-content-center">
			<div class="auth__col col-12 col-sm-auto col-xl-4">
				<div class="auth__card card p-3 border-1">
					<div class="auth__info text-center mb-4">
						<h1><?=GetMessage("AUTH_TITLE")?></h1>
						<p><?=GetMessage("AUTH_PLEASE_AUTH")?></p>
					</div>
					<?if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
						$message = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
					?>
						<div class="auth__alert-auth-result-message alert alert-danger"><?=nl2br(htmlspecialcharsbx($message))?>
					</div>
					<?endif?>
					<?if (!empty($arResult['ERROR_MESSAGE'])):
						$message = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
					?>
						<div class="auth__alert-error-message alert alert-danger"><?=nl2br(htmlspecialcharsbx($message))?>
					</div>
					<?endif?>
					<form class="auth__form" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
						<input type="hidden" name="AUTH_FORM" value="Y" />
						<input type="hidden" name="TYPE" value="AUTH" />
						<?if ($arResult["BACKURL"] <> ''):?>
							<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
						<?endif?>
						<?foreach ($arResult["POST"] as $key => $value):?>
							<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
						<?endforeach?>

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
						<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
							<div class="auth__remember remember form-check mb-4">
								<input class="remember__input form-check-input" type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y">
								<label class="remember__label form-check-label" for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>
							</div>
						<?endif?>
						<div class="auth__submit form-submit text-center mb-4">
							<input class="auth__submit-button btn btn-primary w-100" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
						</div>
						<div class="auth__links">
							<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
								<noindex>
									<p class="mb-1">
									<?=GetMessage("AUTH_FORGOT_PASSWORD_TITLE")?> <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
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
	</div>
</section>
<script>
	<?if ($arResult["LAST_LOGIN"] <> ''):?>
		try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
		try{document.form_auth.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>