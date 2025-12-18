<?php

use Bitrix\Main\Web\Json;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (isset($arResult["SHOW_SMS_FIELD"]) && $arResult["SHOW_SMS_FIELD"] == true) {
	CJSCore::Init('phone_auth');
}
?>

<? if (!isset($arResult["SHOW_SMS_FIELD"]) || $arResult["SHOW_SMS_FIELD"] !== true): ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8">
				<form method="post" name="modern_profile_form" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data" class="profile-form card shadow-sm border-0 p-4 mb-4">
					<?= $arResult["BX_SESSION_CHECK"] ?>
					<input type="hidden" name="lang" value="<?= LANG ?>" />
					<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />

					<div class="mb-4">
						<h1 class="h1 mb-3">Профиль пользователя</h1>
						<p class="mb-1"><?= GetMessage('LAST_UPDATE') ?> <span class="fw-semibold"><?= $arResult["arUser"]["TIMESTAMP_X"] ?: '&mdash;' ?></span></p>
						<p class="mb-0"><?= GetMessage('LAST_LOGIN') ?> <span class="fw-semibold"><?= $arResult["arUser"]["LAST_LOGIN"] ?: '&mdash;' ?></span></p>
					</div>

					<div class="mb-4">
						<h2 class="h5 mb-3"><?= GetMessage("REG_SHOW_HIDE") ?></h2>

						<div class="card border mb-3">
							<div class="card-body">
								<label for="PERSONAL_PHOTO" class="form-label">
									<h2 class="mb-3"><?= rtrim(GetMessage("USER_PHOTO"), ':') ?></h2>
								</label>
								<div class="d-flex flex-wrap align-items-center gap-3">
									<div class="profile-photo-preview">
										<div class="mb-3">

											<?
											$personalPhotoInput = $arResult["arUser"]["PERSONAL_PHOTO_INPUT"];
											$personalPhotoInput = mb_convert_encoding($personalPhotoInput, 'HTML-ENTITIES', 'UTF-8');

											libxml_use_internal_errors(true);

											$personalPhotoInputDOM = new DOMDocument();
											$personalPhotoInputDOM->loadHTML($personalPhotoInput, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

											$personalPhotoInputXPath = new DOMXPath($personalPhotoInputDOM);

											function addClass(DOMElement $el, string $class): void
											{
												$current = trim($el->getAttribute('class'));
												$classes = $current === '' ? [] : preg_split('/\s+/', $current);
												if (!in_array($class, $classes, true)) {
													$classes[] = $class;
												}
												$el->setAttribute('class', implode(' ', $classes));
											}

											// PERSONAL_PHOTO input: классы + id + обёртка div.personal-photo
											$fileInput = $personalPhotoInputXPath->query('//input[@name="PERSONAL_PHOTO"]')->item(0);

											$personalPhotoInputDiv = null;

											if ($fileInput instanceof DOMElement) {
												// Гарантируем id
												$fileInput->setAttribute('id', 'PERSONAL_PHOTO');

												// Добавляем нужные классы (не трогаем существующие, просто дописываем)
												addClass($fileInput, 'personal-photo__input');
												addClass($fileInput, 'typefile');
												addClass($fileInput, 'form-control');

												// Оборачиваем input в <div class="personal-photo">
												$personalPhotoInputDiv = $personalPhotoInputDOM->createElement('div');
												$personalPhotoInputDiv->setAttribute('class', 'personal-photo mb-2');

												$parent = $fileInput->parentNode;
												$parent->insertBefore($personalPhotoInputDiv, $fileInput);
												$personalPhotoInputDiv->appendChild($fileInput);
											}

											// span.bx-input-file-desc: собрать form-check из чекбокса + label и удалить span
											$span = $personalPhotoInputXPath
												->query('//span[contains(concat(" ", normalize-space(@class), " "), " bx-input-file-desc ")]')
												->item(0);

											$formCheckDiv = null;

											if ($span instanceof DOMElement) {
												$delInput = $personalPhotoInputXPath
													->query('.//input[translate(@type,"CHECKBOX","checkbox")="checkbox" and @name="PERSONAL_PHOTO_del"]', $span)
													->item(0);

												$label = $personalPhotoInputXPath
													->query('.//label[@for="PERSONAL_PHOTO_del"]', $span)
													->item(0);

												if ($delInput instanceof DOMElement) {
													addClass($delInput, 'form-check-input');

													$formCheckDiv = $personalPhotoInputDOM->createElement('div');
													$formCheckDiv->setAttribute('class', 'form-check');

													$span->parentNode->insertBefore($formCheckDiv, $span);

													$formCheckDiv->appendChild($delInput);

													if ($label instanceof DOMElement) {
														addClass($label, 'form-check-label');
														$formCheckDiv->appendChild($label);
													}
												}

												$span->parentNode->removeChild($span);
											}

											libxml_clear_errors();

											// Вывод строго нужных блоков
											$personalPhotoInputFile = '';
											if ($personalPhotoInputDiv instanceof DOMElement) {
												$personalPhotoInputFile = $personalPhotoInputDOM->saveHTML($personalPhotoInputDiv) . "\n";
											}
											$personalPhotoInputDelete = '';
											if ($formCheckDiv instanceof DOMElement) {
												$personalPhotoInputDelete = $personalPhotoInputDOM->saveHTML($formCheckDiv);
											}

											echo $personalPhotoInputFile;
											echo $personalPhotoInputDelete;
											?>
										</div>

										<? if (!empty($arResult["arUser"]["PERSONAL_PHOTO_HTML"])): ?>
											<?
											// echo $arResult["arUser"]["PERSONAL_PHOTO_HTML"]
											$personalPhotoHtml = $arResult["arUser"]["PERSONAL_PHOTO_HTML"];

											libxml_use_internal_errors(true);

											$personalPhotoHtmlDOM = new DOMDocument('1.0', 'UTF-8');
											$personalPhotoHtmlDOM->loadHTML('<?xml encoding="UTF-8">' . $personalPhotoHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

											$personalPhotoHtmlXPath = new DOMXPath($personalPhotoHtmlDOM);

											$img = $personalPhotoHtmlXPath->query('//img')->item(0);
											$personalPhotoHtmlImgSrc = ($img instanceof DOMElement) ? $img->getAttribute('src') : '';

											libxml_clear_errors();

											echo htmlspecialchars($personalPhotoHtmlImgSrc, ENT_QUOTES | ENT_HTML5, 'UTF-8');
											?>
										<? else: ?>
											<span class="text-muted">Изображение не загружено</span>
										<? endif; ?>
									</div>
									<div class="flex-grow-1">
										<?= $arResult["arUser"]["PERSONAL_PHOTO_INPUT"] ?>
									</div>
								</div>
							</div>
						</div>

						<div class="card border mb-3">
							<div class="card-body">
								<h2 class="mb-3">Личные данные</h2>
								<div class="form-floating mb-2">
									<input type="text" class="form-control" name="NAME" id="profile-name" maxlength="50" value="<?= $arResult["arUser"]["NAME"] ?>" placeholder="<?= GetMessage('NAME') ?>">
									<label for="profile-name"><?= GetMessage('NAME') ?></label>
								</div>
								<div class="form-floating mb-2">
									<input type="text" class="form-control" name="LAST_NAME" id="profile-last-name" maxlength="50" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" placeholder="<?= GetMessage('LAST_NAME') ?>">
									<label for="profile-last-name"><?= GetMessage('LAST_NAME') ?></label>
								</div>
								<div class="form-floating mb-2">
									<input type="text" class="form-control" name="SECOND_NAME" id="profile-second-name" maxlength="50" value="<?= $arResult["arUser"]["SECOND_NAME"] ?>" placeholder="<?= GetMessage('SECOND_NAME') ?>">
									<label for="profile-second-name"><?= GetMessage('SECOND_NAME') ?></label>
								</div>
								<div class="form-floating mb-2">
									<input type="email" class="form-control" name="EMAIL" id="profile-email" maxlength="50" value="<?= $arResult["arUser"]["EMAIL"] ?>" placeholder="<?= GetMessage('EMAIL') ?>">
									<label for="profile-email"><?= GetMessage('EMAIL') ?><? if ($arResult["EMAIL_REQUIRED"]): ?>*<? endif ?></label>
								</div>
								<div class="form-floating mb-2">
									<input type="text" class="form-control" name="PERSONAL_WWW" id="profile-www" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_WWW"] ?>" placeholder="WWW">
									<label for="profile-www">WWW-страница</label>
								</div>
							</div>
						</div>

						<? if ($arResult['CAN_EDIT_PASSWORD']): ?>
							<div class="card border mb-3">
								<div class="card-body">
									<h2 class="mb-3">Сменить пароль</h2>
									<? if ($arResult["SECURE_AUTH"]): ?>
										<span class="bx-auth-secure" id="bx_auth_secure_modern" title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
											<div class="bx-auth-secure-icon"></div>
										</span>
										<noscript>
											<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
												<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
											</span>
										</noscript>
										<script>
											document.getElementById('bx_auth_secure_modern').style.display = 'inline-block';
										</script>
									<? endif ?>
									<div class="form-floating mb-2 position-relative">
										<input type="password" class="form-control bx-auth-input" name="NEW_PASSWORD" id="profile-new-password" maxlength="50" autocomplete="off" placeholder="<?= GetMessage('NEW_PASSWORD_REQ') ?>">
										<label for="profile-new-password"><?= GetMessage('NEW_PASSWORD_REQ') ?></label>
									</div>
									<div class="form-floating mb-2">
										<input type="password" class="form-control" name="NEW_PASSWORD_CONFIRM" id="profile-new-password-confirm" maxlength="50" autocomplete="off" placeholder="<?= GetMessage('NEW_PASSWORD_CONFIRM') ?>">
										<label for="profile-new-password-confirm"><?= GetMessage('NEW_PASSWORD_CONFIRM') ?></label>
									</div>
									<small class="text-muted d-block"><?= $arResult['GROUP_POLICY']['PASSWORD_REQUIREMENTS']; ?></small>
								</div>
							</div>
						<? endif ?>
					</div>

					<div class="d-flex flex-wrap gap-3">
						<button type="submit" name="save" class="btn btn-primary px-4"><?= ($arResult["ID"] > 0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD") ?></button>
						<button type="reset" class="btn btn-outline-secondary px-4"><?= GetMessage('MAIN_RESET'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
<? endif; ?>

<hr>
<pre>$arUser
	<? print_r($arUser) ?>
</pre>
<pre>$arResult
	<? print_r($arResult) ?>
</pre>
<hr>

<div class="bx-auth-profile">

	<? ShowError($arResult["strProfileError"]); ?>
	<?
	if (isset($arResult['DATA_SAVED']) && $arResult['DATA_SAVED'] == 'Y')
		ShowNote(GetMessage('PROFILE_DATA_SAVED'));
	?>

	<? if (isset($arResult["SHOW_SMS_FIELD"]) && $arResult["SHOW_SMS_FIELD"] == true): ?>

		<form method="post" action="<?= $arResult["FORM_TARGET"] ?>">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			<input type="hidden" name="SIGNED_DATA" value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>" />
			<table class="profile-table data-table">
				<tbody>
					<tr>
						<td><? echo GetMessage("main_profile_code") ?><span class="starrequired">*</span></td>
						<td><input size="30" type="text" name="SMS_CODE" value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off" /></td>
					</tr>
				</tbody>
			</table>

			<p><input type="submit" name="code_submit_button" value="<? echo GetMessage("main_profile_send") ?>" /></p>

		</form>

		<script>
			new BX.PhoneAuth({
				containerId: 'bx_profile_resend',
				errorContainerId: 'bx_profile_error',
				interval: <?= $arResult["PHONE_CODE_RESEND_INTERVAL"] ?>,
				data: <?= Json::encode([
							'signedData' => $arResult["SIGNED_DATA"],
						]) ?>,
				onError: function(response) {
					var errorDiv = BX('bx_profile_error');
					var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
					errorNode.innerHTML = '';
					for (var i = 0; i < response.errors.length; i++) {
						errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
					}
					errorDiv.style.display = '';
				}
			});
		</script>

		<div id="bx_profile_error" style="display:none"><? ShowError("error") ?></div>

		<div id="bx_profile_resend"></div>

	<? else: ?>

		<script>
			var opened_sections = [<?
									$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"] . "_user_profile_open"] ?? '';
									$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
									if ($arResult["opened"] <> '') {
										echo "'" . implode("', '", explode(",", $arResult["opened"])) . "'";
									} else {
										$arResult["opened"] = "reg";
										echo "'reg'";
									}
									?>];

			var cookie_prefix = '<?= $arResult["COOKIE_PREFIX"] ?>';
		</script>
		<form method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />

			<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("REG_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('reg')"><?= GetMessage("REG_SHOW_HIDE") ?></a></div>
			<div class="profile-block-<?= !str_contains($arResult["opened"], "reg") ? "hidden" : "shown" ?>" id="user_div_reg">
				<table class="profile-table data-table">
					<thead>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<?
						if ($arResult["ID"] > 0) {
						?>
							<?
							if ($arResult["arUser"]["TIMESTAMP_X"] <> '') {
							?>
								<tr>
									<td><?= GetMessage('LAST_UPDATE') ?></td>
									<td><?= $arResult["arUser"]["TIMESTAMP_X"] ?></td>
								</tr>
							<?
							}
							?>
							<?
							if ($arResult["arUser"]["LAST_LOGIN"] <> '') {
							?>
								<tr>
									<td><?= GetMessage('LAST_LOGIN') ?></td>
									<td><?= $arResult["arUser"]["LAST_LOGIN"] ?></td>
								</tr>
							<?
							}
							?>
						<?
						}
						?>
						<tr>
							<td><? echo GetMessage("main_profile_title") ?></td>
							<td><input type="text" name="TITLE" value="<?= $arResult["arUser"]["TITLE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('NAME') ?></td>
							<td><input type="text" name="NAME" maxlength="50" value="<?= $arResult["arUser"]["NAME"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('LAST_NAME') ?></td>
							<td><input type="text" name="LAST_NAME" maxlength="50" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('SECOND_NAME') ?></td>
							<td><input type="text" name="SECOND_NAME" maxlength="50" value="<?= $arResult["arUser"]["SECOND_NAME"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('LOGIN') ?><span class="starrequired">*</span></td>
							<td><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('EMAIL') ?><? if ($arResult["EMAIL_REQUIRED"]): ?><span class="starrequired">*</span><? endif ?></td>
							<td><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"] ?>" /></td>
						</tr>
						<? if ($arResult["PHONE_REGISTRATION"]): ?>
							<tr>
								<td><? echo GetMessage("main_profile_phone_number") ?><? if ($arResult["PHONE_REQUIRED"]): ?><span class="starrequired">*</span><? endif ?></td>
								<td><input type="text" name="PHONE_NUMBER" maxlength="50" value="<? echo $arResult["arUser"]["PHONE_NUMBER"] ?>" /></td>
							</tr>
						<? endif ?>
						<? if ($arResult['CAN_EDIT_PASSWORD']): ?>
							<tr>
								<td><?= GetMessage('NEW_PASSWORD_REQ') ?></td>
								<td><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
									<? if ($arResult["SECURE_AUTH"]): ?>
										<span class="bx-auth-secure" id="bx_auth_secure" title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
											<div class="bx-auth-secure-icon"></div>
										</span>
										<noscript>
											<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
												<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
											</span>
										</noscript>
										<script>
											document.getElementById('bx_auth_secure').style.display = 'inline-block';
										</script>
								</td>
							</tr>
						<? endif ?>
						<tr>
							<td><?= GetMessage('NEW_PASSWORD_CONFIRM') ?></td>
							<td><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></td>
						</tr>
					<? endif ?>
					<? if ($arResult["TIME_ZONE_ENABLED"] == true): ?>
						<tr>
							<td colspan="2" class="profile-header"><? echo GetMessage("main_profile_time_zones") ?></td>
						</tr>
						<tr>
							<td><? echo GetMessage("main_profile_time_zones_auto") ?></td>
							<td>
								<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
									<option value=""><? echo GetMessage("main_profile_time_zones_auto_def") ?></option>
									<option value="Y" <?= ($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y" ? ' SELECTED="SELECTED"' : '') ?>><? echo GetMessage("main_profile_time_zones_auto_yes") ?></option>
									<option value="N" <?= ($arResult["arUser"]["AUTO_TIME_ZONE"] == "N" ? ' SELECTED="SELECTED"' : '') ?>><? echo GetMessage("main_profile_time_zones_auto_no") ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><? echo GetMessage("main_profile_time_zones_zones") ?></td>
							<td>
								<select name="TIME_ZONE" <? if ($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"' ?>>
									<? foreach ($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
										<option value="<?= htmlspecialcharsbx($tz) ?>" <?= ($arResult["arUser"]["TIME_ZONE"] == $tz ? ' SELECTED="SELECTED"' : '') ?>><?= htmlspecialcharsbx($tz_name) ?></option>
									<? endforeach ?>
								</select>
							</td>
						</tr>
					<? endif ?>
					</tbody>
				</table>
			</div>
			<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('personal')"><?= GetMessage("USER_PERSONAL_INFO") ?></a></div>
			<div id="user_div_personal" class="profile-block-<?= !str_contains($arResult["opened"], "personal") ? "hidden" : "shown" ?>">
				<table class="data-table profile-table">
					<thead>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= GetMessage('USER_PROFESSION') ?></td>
							<td><input type="text" name="PERSONAL_PROFESSION" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PROFESSION"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_WWW') ?></td>
							<td><input type="text" name="PERSONAL_WWW" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_WWW"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_ICQ') ?></td>
							<td><input type="text" name="PERSONAL_ICQ" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_ICQ"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_GENDER') ?></td>
							<td><select name="PERSONAL_GENDER">
									<option value=""><?= GetMessage("USER_DONT_KNOW") ?></option>
									<option value="M" <?= $arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : "" ?>><?= GetMessage("USER_MALE") ?></option>
									<option value="F" <?= $arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : "" ?>><?= GetMessage("USER_FEMALE") ?></option>
								</select></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_BIRTHDAY_DT") ?> (<?= $arResult["DATE_FORMAT"] ?>):</td>
							<td><?
								$APPLICATION->IncludeComponent(
									'bitrix:main.calendar',
									'',
									array(
										'SHOW_INPUT' => 'Y',
										'FORM_NAME' => 'form1',
										'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
										'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
										'SHOW_TIME' => 'N'
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);

								//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
								?></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_PHOTO") ?></td>
							<td>
								<?= $arResult["arUser"]["PERSONAL_PHOTO_INPUT"] ?>
								<?
								if ($arResult["arUser"]["PERSONAL_PHOTO"] <> '') {
								?>
									<br />
									<?= $arResult["arUser"]["PERSONAL_PHOTO_HTML"] ?>
								<?
								}
								?>
							</td>
						<tr>
							<td colspan="2" class="profile-header"><?= GetMessage("USER_PHONES") ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_PHONE') ?></td>
							<td><input type="text" name="PERSONAL_PHONE" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PHONE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_FAX') ?></td>
							<td><input type="text" name="PERSONAL_FAX" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_FAX"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_MOBILE') ?></td>
							<td><input type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_MOBILE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_PAGER') ?></td>
							<td><input type="text" name="PERSONAL_PAGER" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PAGER"] ?>" /></td>
						</tr>
						<tr>
							<td colspan="2" class="profile-header"><?= GetMessage("USER_POST_ADDRESS") ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_COUNTRY') ?></td>
							<td><?= $arResult["COUNTRY_SELECT"] ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_STATE') ?></td>
							<td><input type="text" name="PERSONAL_STATE" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_STATE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_CITY') ?></td>
							<td><input type="text" name="PERSONAL_CITY" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_CITY"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_ZIP') ?></td>
							<td><input type="text" name="PERSONAL_ZIP" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_ZIP"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_STREET") ?></td>
							<td><textarea cols="30" rows="5" name="PERSONAL_STREET"><?= $arResult["arUser"]["PERSONAL_STREET"] ?></textarea></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_MAILBOX') ?></td>
							<td><input type="text" name="PERSONAL_MAILBOX" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_MAILBOX"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_NOTES") ?></td>
							<td><textarea cols="30" rows="5" name="PERSONAL_NOTES"><?= $arResult["arUser"]["PERSONAL_NOTES"] ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('work')"><?= GetMessage("USER_WORK_INFO") ?></a></div>
			<div id="user_div_work" class="profile-block-<?= !str_contains($arResult["opened"], "work") ? "hidden" : "shown" ?>">
				<table class="data-table profile-table">
					<thead>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= GetMessage('USER_COMPANY') ?></td>
							<td><input type="text" name="WORK_COMPANY" maxlength="255" value="<?= $arResult["arUser"]["WORK_COMPANY"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_WWW') ?></td>
							<td><input type="text" name="WORK_WWW" maxlength="255" value="<?= $arResult["arUser"]["WORK_WWW"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_DEPARTMENT') ?></td>
							<td><input type="text" name="WORK_DEPARTMENT" maxlength="255" value="<?= $arResult["arUser"]["WORK_DEPARTMENT"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_POSITION') ?></td>
							<td><input type="text" name="WORK_POSITION" maxlength="255" value="<?= $arResult["arUser"]["WORK_POSITION"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_WORK_PROFILE") ?></td>
							<td><textarea cols="30" rows="5" name="WORK_PROFILE"><?= $arResult["arUser"]["WORK_PROFILE"] ?></textarea></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_LOGO") ?></td>
							<td>
								<?= $arResult["arUser"]["WORK_LOGO_INPUT"] ?>
								<?
								if ($arResult["arUser"]["WORK_LOGO"] <> '') {
								?>
									<br /><?= $arResult["arUser"]["WORK_LOGO_HTML"] ?>
								<?
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="profile-header"><?= GetMessage("USER_PHONES") ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_PHONE') ?></td>
							<td><input type="text" name="WORK_PHONE" maxlength="255" value="<?= $arResult["arUser"]["WORK_PHONE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_FAX') ?></td>
							<td><input type="text" name="WORK_FAX" maxlength="255" value="<?= $arResult["arUser"]["WORK_FAX"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_PAGER') ?></td>
							<td><input type="text" name="WORK_PAGER" maxlength="255" value="<?= $arResult["arUser"]["WORK_PAGER"] ?>" /></td>
						</tr>
						<tr>
							<td colspan="2" class="profile-header"><?= GetMessage("USER_POST_ADDRESS") ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_COUNTRY') ?></td>
							<td><?= $arResult["COUNTRY_SELECT_WORK"] ?></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_STATE') ?></td>
							<td><input type="text" name="WORK_STATE" maxlength="255" value="<?= $arResult["arUser"]["WORK_STATE"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_CITY') ?></td>
							<td><input type="text" name="WORK_CITY" maxlength="255" value="<?= $arResult["arUser"]["WORK_CITY"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_ZIP') ?></td>
							<td><input type="text" name="WORK_ZIP" maxlength="255" value="<?= $arResult["arUser"]["WORK_ZIP"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_STREET") ?></td>
							<td><textarea cols="30" rows="5" name="WORK_STREET"><?= $arResult["arUser"]["WORK_STREET"] ?></textarea></td>
						</tr>
						<tr>
							<td><?= GetMessage('USER_MAILBOX') ?></td>
							<td><input type="text" name="WORK_MAILBOX" maxlength="255" value="<?= $arResult["arUser"]["WORK_MAILBOX"] ?>" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("USER_NOTES") ?></td>
							<td><textarea cols="30" rows="5" name="WORK_NOTES"><?= $arResult["arUser"]["WORK_NOTES"] ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?
			if ($arResult["INCLUDE_FORUM"] == "Y") {
			?>

				<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('forum')"><?= GetMessage("forum_INFO") ?></a></div>
				<div id="user_div_forum" class="profile-block-<?= !str_contains($arResult["opened"], "forum") ? "hidden" : "shown" ?>">
					<table class="data-table profile-table">
						<thead>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= GetMessage("forum_SHOW_NAME") ?></td>
								<td><input type="hidden" name="forum_SHOW_NAME" value="N" /><input type="checkbox" name="forum_SHOW_NAME" value="Y" <? if ($arResult["arForumUser"]["SHOW_NAME"] == "Y") echo "checked=\"checked\""; ?> /></td>
							</tr>
							<tr>
								<td><?= GetMessage('forum_DESCRIPTION') ?></td>
								<td><input type="text" name="forum_DESCRIPTION" maxlength="255" value="<?= $arResult["arForumUser"]["DESCRIPTION"] ?>" /></td>
							</tr>
							<tr>
								<td><?= GetMessage('forum_INTERESTS') ?></td>
								<td><textarea cols="30" rows="5" name="forum_INTERESTS"><?= $arResult["arForumUser"]["INTERESTS"]; ?></textarea></td>
							</tr>
							<tr>
								<td><?= GetMessage("forum_SIGNATURE") ?></td>
								<td><textarea cols="30" rows="5" name="forum_SIGNATURE"><?= $arResult["arForumUser"]["SIGNATURE"]; ?></textarea></td>
							</tr>
							<tr>
								<td><?= GetMessage("forum_AVATAR") ?></td>
								<td><?= $arResult["arForumUser"]["AVATAR_INPUT"] ?>
									<?
									if ($arResult["arForumUser"]["AVATAR"] <> '') {
									?>
										<br /><?= $arResult["arForumUser"]["AVATAR_HTML"] ?>
									<?
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			<?
			}
			?>
			<?
			if ($arResult["INCLUDE_BLOG"] == "Y") {
			?>
				<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('blog')"><?= GetMessage("blog_INFO") ?></a></div>
				<div id="user_div_blog" class="profile-block-<?= !str_contains($arResult["opened"], "blog") ? "hidden" : "shown" ?>">
					<table class="data-table profile-table">
						<thead>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= GetMessage('blog_ALIAS') ?></td>
								<td><input class="typeinput" type="text" name="blog_ALIAS" maxlength="255" value="<?= $arResult["arBlogUser"]["ALIAS"] ?>" /></td>
							</tr>
							<tr>
								<td><?= GetMessage('blog_DESCRIPTION') ?></td>
								<td><input class="typeinput" type="text" name="blog_DESCRIPTION" maxlength="255" value="<?= $arResult["arBlogUser"]["DESCRIPTION"] ?>" /></td>
							</tr>
							<tr>
								<td><?= GetMessage('blog_INTERESTS') ?></td>
								<td><textarea cols="30" rows="5" class="typearea" name="blog_INTERESTS"><? echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea></td>
							</tr>
							<tr>
								<td><?= GetMessage("blog_AVATAR") ?></td>
								<td><?= $arResult["arBlogUser"]["AVATAR_INPUT"] ?>
									<?
									if ($arResult["arBlogUser"]["AVATAR"] <> '') {
									?>
										<br /><?= $arResult["arBlogUser"]["AVATAR_HTML"] ?>
									<?
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			<?
			}
			?>
			<? if ($arResult["INCLUDE_LEARNING"] == "Y"): ?>
				<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('learning')"><?= GetMessage("learning_INFO") ?></a></div>
				<div id="user_div_learning" class="profile-block-<?= !str_contains($arResult["opened"], "learning") ? "hidden" : "shown" ?>">
					<table class="data-table profile-table">
						<thead>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= GetMessage("learning_PUBLIC_PROFILE"); ?>:</td>
								<td><input type="hidden" name="student_PUBLIC_PROFILE" value="N" /><input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <? if ($arResult["arStudent"]["PUBLIC_PROFILE"] == "Y") echo "checked=\"checked\""; ?> /></td>
							</tr>
							<tr>
								<td><?= GetMessage("learning_RESUME"); ?>:</td>
								<td><textarea cols="30" rows="5" name="student_RESUME"><?= $arResult["arStudent"]["RESUME"]; ?></textarea></td>
							</tr>

							<tr>
								<td><?= GetMessage("learning_TRANSCRIPT"); ?>:</td>
								<td><?= $arResult["arStudent"]["TRANSCRIPT"]; ?>-<?= $arResult["ID"] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			<? endif; ?>
			<? if ($arResult["IS_ADMIN"]): ?>
				<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('admin')"><?= GetMessage("USER_ADMIN_NOTES") ?></a></div>
				<div id="user_div_admin" class="profile-block-<?= !str_contains($arResult["opened"], "admin") ? "hidden" : "shown" ?>">
					<table class="data-table profile-table">
						<thead>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= GetMessage("USER_ADMIN_NOTES") ?>:</td>
								<td><textarea cols="30" rows="5" name="ADMIN_NOTES"><?= $arResult["arUser"]["ADMIN_NOTES"] ?></textarea></td>
							</tr>
						</tbody>
					</table>
				</div>
			<? endif; ?>
			<? // ********************* User properties ***************************************************
			?>
			<? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
				<div class="profile-link profile-user-div-link"><a title="<?= GetMessage("USER_SHOW_HIDE") ?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?= trim($arParams["USER_PROPERTY_NAME"]) <> '' ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?></a></div>
				<div id="user_div_user_properties" class="profile-block-<?= !str_contains($arResult["opened"], "user_properties") ? "hidden" : "shown" ?>">
					<table class="data-table profile-table">
						<thead>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
						</thead>
						<tbody>
							<? $first = true; ?>
							<? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
								<tr>
									<td class="field-name">
										<? if ($arUserField["MANDATORY"] == "Y"): ?>
											<span class="starrequired">*</span>
										<? endif; ?>
										<?= $arUserField["EDIT_FORM_LABEL"] ?>:
									</td>
									<td class="field-value">
										<? $APPLICATION->IncludeComponent(
											"bitrix:system.field.edit",
											$arUserField["USER_TYPE"]["USER_TYPE_ID"],
											array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField),
											null,
											array("HIDE_ICONS" => "Y")
										); ?></td>
								</tr>
							<? endforeach; ?>
						</tbody>
					</table>
				</div>
			<? endif; ?>
			<? // ******************** /User properties ***************************************************
			?>
			<p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
			<p><input type="submit" name="save" value="<?= (($arResult["ID"] > 0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD")) ?>">&nbsp;&nbsp;<input type="reset" value="<?= GetMessage('MAIN_RESET'); ?>"></p>
		</form>
		<?
		if ($arResult["SOCSERV_ENABLED"]) {
			$APPLICATION->IncludeComponent(
				"bitrix:socserv.auth.split",
				".default",
				array(
					"SHOW_PROFILES" => "Y",
					"ALLOW_DELETE" => "Y"
				),
				false
			);
		}
		?>

	<? endif ?>

</div>