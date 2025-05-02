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

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>

<section class="register mt-5 mb-5">
	<div class="register__container container">
		<div class="register__info-row row justify-content-center">
			<div class="register__info-col col-12 col-sm-auto col-xl-4">
				<div class="__card card p-3 border-1">
					<div class="register__info text-center">
						<h1><?=GetMessage("AUTH_REGISTER")?></h1>
					</div>

					<?//if (!empty($arParams["~AUTH_RESULT"])) {?>
						<div class="register__info alert alert-danger" role="alert">
							<?=GetMessage("AUTH_RESULT_MESSAGE")?>
						</div>
					<?// } ?>

					<?//if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
						<div class="register__info alert alert-success" role="alert">
							<?echo GetMessage("AUTH_EMAIL_SENT")?>
						</div>
					<?//endif;?>

					<?// if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
						<div class="register__info alert alert-success" role="alert">
							<?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?>
						</div>
					<? //endif ?>

					<noindex>
						<?if($arResult["SHOW_SMS_FIELD"] == true):?>
							<form method="post" class="register__form-sms sms" action="<?=$arResult["AUTH_URL"]?>" name="regform">
								<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
								<div class="sms__form-floating form-floating mb-3">
									<input type="text" class="sms__input form-control" size="30" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off"  placeholder="<?echo GetMessage("main_register_sms_code")?>">
									<label class="sms__label" for="login"><?echo GetMessage("main_register_sms_code")?></label>
								</div>
								<div class="sms__submit form-submit text-center mb-3">
									<input type="submit" class="sms__submit-button btn btn-primary w-100" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />
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
										var errorDiv = BX('bx_register_error');
										var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
										errorNode.innerHTML = '';
										for(var i = 0; i < response.errors.length; i++)
										{
											errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
										}
										errorDiv.style.display = '';
									}
							});
							</script>
							<? /* Не понимаю, как работают эти два div, но, видимо, они нужны для SMS-авторизации... если она работает */?>
							<div role="alert" id="bx_register_error" <?/*style="display:none"*/?>><?ShowError("error")?></div>
							<div role="alert" id="bx_register_resend"></div>

						<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
							<form method="post" class="register__form-login" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
								<input type="hidden" name="AUTH_FORM" value="Y" />
								<input type="hidden" name="TYPE" value="REGISTRATION" />

								<div class="register__names mb-4">
									<div class="register__name name form-floating mb-2">
										<input class="name__input form-control" id="name" type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>"  placeholder="<?=GetMessage("AUTH_NAME")?>">
										<label class="name__label" for="name"><?=GetMessage("AUTH_NAME")?></label>
									</div>
									<div class="register__last-name last-name form-floating mb-2">
										<input class="last-name__input form-control" id="last-name" type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>"  placeholder="<?=GetMessage("AUTH_LAST_NAME")?>">
										<label class="last-name__label" for="last-name"><?=GetMessage("AUTH_LAST_NAME")?></label>
									</div>
								</div>
								<div class="register__login-info mb-4">
									<div class="register__login login form-floating mb-2">
										<input class="login__input form-control" id="login" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
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

						<?endif?>
					</noindex>

				</div>
			</div>
		</div>
	</div>
</section>

<div class="bx-auth">
	<?/*if (!empty($arParams["~AUTH_RESULT"])) {
		ShowMessage($arParams["~AUTH_RESULT"]);
	}*/?>
	<?/*if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
		<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
	<?endif;*/?>

	<? /* if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
		<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
	<?endif */ ?>
	<noindex>

	<?/* if($arResult["SHOW_SMS_FIELD"] == true):?>
		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
			<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
			<table class="data-table bx-registration-table">
				<tbody>
					<tr>
						<td><span class="starrequired">*</span><?echo GetMessage("main_register_sms_code")?></td>
						<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
					</tr>
				</tfoot>
			</table>
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
					var errorDiv = BX('bx_register_error');
					var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
					errorNode.innerHTML = '';
					for(var i = 0; i < response.errors.length; i++)
					{
						errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
					}
					errorDiv.style.display = '';
				}
		});
		</script>

		<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

		<div id="bx_register_resend"></div>

	<?*/ //elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
# Не SMS 
		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="REGISTRATION" />

			<table class="data-table bx-registration-table">
				<thead>
					<tr>
						<td colspan="2"><b><?=GetMessage("AUTH_REGISTER")?></b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=GetMessage("AUTH_NAME")?></td>
						<td><input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" /></td>
					</tr>
					<tr>
						<td><?=GetMessage("AUTH_LAST_NAME")?></td>
						<td><input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" /></td>
					</tr>
					<tr>
						<td><span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?></td>
						<td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input" /></td>
					</tr>
					<tr>
						<td><span class="starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></td>
						<td><input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
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
					<tr>
						<td><span class="starrequired">*</span><?=GetMessage("AUTH_CONFIRM")?></td>
						<td><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" /></td>
					</tr>

					<?if($arResult["EMAIL_REGISTRATION"]):?>
						<tr>
							<td><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?><?=GetMessage("AUTH_EMAIL")?></td>
							<td><input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" /></td>
						</tr>
					<?endif?>

					<?if($arResult["PHONE_REGISTRATION"]):?>
						<tr>
							<td><?if($arResult["PHONE_REQUIRED"]):?><span class="starrequired">*</span><?endif?><?echo GetMessage("main_register_phone_number")?></td>
							<td><input type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" class="bx-auth-input" /></td>
						</tr>
					<?endif?>

					<?// ********************* User properties ***************************************************?>
					<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
						<tr><td colspan="2"><?=trim($arParams["USER_PROPERTY_NAME"]) <> '' ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
						<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
						<tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
							?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
								<?$APPLICATION->IncludeComponent(
									"bitrix:system.field.edit",
									$arUserField["USER_TYPE"]["USER_TYPE_ID"],
									array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
						<?endforeach;?>
					<?endif;?>
					<?// ******************** /User properties ***************************************************

					/* CAPTCHA */
					if ($arResult["USE_CAPTCHA"] == "Y") {?>
						<tr>
							<td colspan="2"><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							</td>
						</tr>
						<tr>
							<td><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</td>
							<td><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" /></td>
						</tr>
					<? }
					/* CAPTCHA */?>
					<tr>
						<td></td>
						<td>
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
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td><input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" /></td>
					</tr>
				</tfoot>
			</table>
		</form>

		<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
		<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

		<p><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>

		<script>
		document.bform.USER_NAME.focus();
		</script>

	<?// endif?>

	</noindex>
</div>