<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2024 Bitrix
 */

use Bitrix\Main\Web\Json;

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true) {
	CJSCore::Init('phone_auth');
}
?>
<noindex>
<section class="register mt-5 mb-5">
	<div class="register__container container">
		<div class="register__info-row row justify-content-center">
			<div class="register__info-col col-12 col-sm-auto col-xl-4">
				<div class="__card card p-3 border-1">
					<div class="register__info text-center">
						<h1><?=GetMessage("AUTH_REGISTER")?></h1>
					</div>

					<?//if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
						$message = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
						<div class="register__auth-result-message alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($message))?></div>
					<?//endif?>
					
					<?//if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
						<div class="register__email-sent-confirmation alert alert-success"><?echo GetMessage("AUTH_EMAIL_SENT")?></div>
					<?//endif?>
					
					<?//if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
						<div class="register__email-confirmation alert alert-warning"><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></div>
					<?//endif?>

					<?// if($arResult["SHOW_SMS_FIELD"] == true):?>

						<div id="bx_register_error" <?/*style="display:none"*/?> class="alert alert-danger"></div>

						<div id="bx_register_resend"></div>

						<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
							<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />

							<div class="register__sms mb-3">
								<div class="register__sms-code sms-code form-floating mb-2">
									<input class="sms-code__input form-control" id="sms-code" type="text" name="SMS_CODE" maxlength="255" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"] ?? '')?>" autocomplete="off" placeholder="<?echo GetMessage("main_register_sms_code")?>" required>
									<label class="sms-code__label" for="login"><?echo GetMessage("main_register_sms_code")?></label>
								</div>
								<div class="sms__submit form-submit text-center mb-3">
									<input type="submit" class="sms__submit-button btn btn-primary w-100" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />
								</div>
							</div>
						</form>

						<script>
						new BX.PhoneAuth({
							containerId: 'bx_register_resend',
							errorContainerId: 'bx_register_error',
							interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
							data:
								<?= Json::encode([
									'signedData' => $arResult["SIGNED_DATA"],
								]) ?>,
							onError:
								function(response)
								{
									var errorNode = BX('bx_register_error');
									errorNode.innerHTML = '';
									for(var i = 0; i < response.errors.length; i++)
									{
										errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
									}
									errorNode.style.display = '';
								}
						});
						</script>
					<?//elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>

						<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
							<input type="hidden" name="AUTH_FORM" value="Y" />
							<input type="hidden" name="TYPE" value="REGISTRATION" />
							
							<div class="register__names mb-4">
								<div class="register__name name form-floating mb-2">
									<input class="name__input form-control" id="name" type="text" name="USER_NAME" maxlength="255" value="<?=$arResult["USER_NAME"]?>" placeholder="<?=GetMessage("AUTH_NAME")?>">
									<label class="name__label" for="name"><?=GetMessage("AUTH_NAME")?></label>
								</div>
								<div class="register__last-name last-name form-floating mb-2">
									<input class="last-name__input form-control" id="last-name" type="text" name="USER_LAST_NAME" maxlength="255" value="<?=$arResult["USER_LAST_NAME"]?>" placeholder="<?=GetMessage("AUTH_LAST_NAME")?>">
									<label class="last-name__label" for="last-name"><?=GetMessage("AUTH_LAST_NAME")?></label>
								</div>
							</div>

							<div class="register__login-info mb-4">
								<div class="register__login login form-floating mb-2">
									<input class="login__input form-control" id="login" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" required>
									<label class="login__label" for="login"><?=GetMessage("AUTH_LOGIN")?></label>
									<div class="login__caption form-text"><?=GetMessage("AUTH_LOGIN_MIN")?></div>
								</div>
								<?if($arResult["EMAIL_REGISTRATION"]):?>
									<div class="register__email email form-floating mb-2">
										<input class="email__input form-control" id="email" type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" placeholder="<?=GetMessage("AUTH_EMAIL")?>" <?if($arResult["EMAIL_REQUIRED"]):?>required<?endif?>>
										<label class="email__label" for="email"><?=GetMessage("AUTH_EMAIL")?></label>
									</div>
								<?endif?>
								<?if($arResult["PHONE_REGISTRATION"]):?>
									<div class="register__phone phone form-floating mb-2">
										<input class="phome__input form-control" id="phone" type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" placeholder="<?=GetMessage("main_register_phone_number")?>" <?if($arResult["PHONE_REQUIRED"]):?>required<?endif?>>
										<label class="phone__label" for="email"><?=GetMessage("main_register_phone_number")?></label>
									</div>
								<?endif?>
							</div>

							<div class="register__passwords mb-4">
								<div class="register__password password form-floating mb-2">
									<input class="password__input form-control" id="password" type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>"  autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD_REQ")?>">
									<label class="password__label" for="password"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
								</div>
								<? /* Не нужно показывать информацию о защищенности. Код не стилизован!
								if($arResult["SECURE_AUTH"]):?>
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
								<?endif */?>
								<div class="register__password-confirm password-confirm form-floating mb-2">
									<input class="password-confirm__input form-control" id="password-confirm" type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
									<label class="password-confirm__label" for="password-confirm"><?=GetMessage("AUTH_CONFIRM")?></label>
									<div class="password__caption form-text"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
								</div>
							</div>

							<?/* Не понимаю, как настроить пользовательские свойства
							if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
								<div class="register__properties mb-4">
									<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
									
									<div class="register__property property form-floating mb-2">
										<input class="property__input form-control" id="name" type="text" name="USER_NAME" maxlength="255" value="<?=$arResult["USER_NAME"]?>" placeholder="<?=GetMessage("AUTH_NAME")?>">
										<label class="property__label" for="name"><?=GetMessage("AUTH_NAME")?></label>
									</div>

										<div class="bx-authform-formgroup-container">
											<div class="bx-authform-label-container"><?if ($arUserField["MANDATORY"]=="Y"):?><span class="bx-authform-starrequired">*</span><?endif?><?=$arUserField["EDIT_FORM_LABEL"]?></div>
											<div class="bx-authform-input-container">
												<?
												$APPLICATION->IncludeComponent(
												"bitrix:system.field.edit",
												$arUserField["USER_TYPE"]["USER_TYPE_ID"],
												array(
													"bVarsFromForm" => $arResult["bVarsFromForm"],
													"arUserField" => $arUserField,
													"form_name" => "bform"
												),
												null,
												array("HIDE_ICONS"=>"Y")
												);
												?>
											</div>
										</div>
								
									<?endforeach;?>
								</div>
							<?endif;*/?>

							<?if ($arResult["USE_CAPTCHA"] == "Y"):?>
								<div class="register__captcha captcha mb-3">
									<div class="captcha__picture">
											<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
											<img class="" src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
										</div>
									<div class="captcha__field form-floating mt-2 mb-3">
										<input type="text" class="captcha__input form-control" id="captcha" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" placeholder="<?=GetMessage("CAPTCHA_REGF_PROMT")?>" required>
										<label for="captcha" class="captcha__label"><?=GetMessage("CAPTCHA_REGF_PROMT")?></label>
									</div>
								</div>
							<?endif;?>




						<?/*if ($arResult["USE_CAPTCHA"] == "Y"):?>
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						
							<div class="bx-authform-formgroup-container">
								<div class="bx-authform-label-container">
									<span class="bx-authform-starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>
								</div>
								<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
								<div class="bx-authform-input-container">
									<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
								</div>
							</div>
						<?endif*/?>
							<div class="register__agreement form-check mb-3">
								<div class="bx-authform-input-container">
									<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
										array(
											"ID" => COption::getOptionString("main", "new_user_agreement", ""),
											"IS_CHECKED" => "Y",
											"AUTO_SAVE" => "N",
											"IS_LOADED" => "Y",
											"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
											"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
											"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
											"REPLACE" => array(
												"button_caption" => GetMessage("AUTH_REGISTER"),
												"fields" => array(
													rtrim(GetMessage("AUTH_NAME"), ":"),
													rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
													rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
													rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
													rtrim(GetMessage("AUTH_EMAIL"), ":"),
												)
											),
										)
									);?>
								</div>
							</div>

							<div class="register__submit form-submit text-center mb-3">
								<input type="submit" class="register__submit-button btn btn-primary w-100" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>">
							</div>
								
							<?/*<div class="bx-authform-description-container">Обязательные поля: 
								<span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_REQ")?>
							</div>*/?>
								
							<? /* Авторизация */ ?>
							<div class="auth__links">
								<p class="mb-1"><?=GetMessage("AUTH_AUTH_TITLE")?> <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a></p>
							</div>
								
						</form>
								
						<script>
						document.bform.USER_NAME.focus();
						</script>

						<?//endif?>

                </div>
            </div>
        </div>
    </div>
</section>
</noindex>