<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__DIR__ . '/user_consent.php');
$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);

$linkClassName = 'main-user-consent-request-announce';
if ($arResult['URL'])
{
	$url = htmlspecialcharsbx(\CUtil::JSEscape($arResult['URL']));
	$label = htmlspecialcharsbx($arResult['LABEL']);
	$label = explode('%', $label);
	$label = implode('', array_merge(
		array_slice($label, 0, 1),
		['<a href="' . $url  . '" target="_blank">'],
		array_slice($label, 1, 1),
		['</a>'],
		array_slice($label, 2)
	));
}
else
{
	$label = htmlspecialcharsbx($arResult['INPUT_LABEL']);
	$linkClassName .= '-link';
}
?>
<div data-bx-user-consent="<?=htmlspecialcharsbx($config)?>" class="form-check main-user-consent-request" data-bs-toggle="modal" data-bs-target="#consentRequest">
	<input class="form-check-input" id="consent-request" type="checkbox" value="Y" <?=($arParams['IS_CHECKED'] ? 'checked' : '')?> name="<?=htmlspecialcharsbx($arParams['INPUT_NAME'])?>" required>
	<label for="consent-request" class="form-check-label <?=$linkClassName?>"><?=$label?></label>
</div>

<!-- Modal -->
<div class="modal fade" id="consentRequest" tabindex="-1" aria-labelledby="<?=$arResult["NAME"]?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
	  <?=$arResult['CONFIG']['text'];?>
      </div>
      <div class="modal-footer">
	  	<button type="button" class="modal__accept btn btn-primary" data-bs-dismiss="modal"><?=GetMessage("MAIN_USER_CONSENT_REQUEST_BTN_ACCEPT")?></button>
        <button type="button" class="modal__reject btn btn-secondary" data-bs-dismiss="modal"><?=GetMessage("MAIN_USER_CONSENT_REQUEST_BTN_REJECT")?></button>
      </div>
    </div>
  </div>
</div>

<script>
	let consentRequest = document.querySelector("#consent-request");
	consentRequest.addEventListener('click', function () {
		consentRequest.checked = true;
	});
	let modalAcceptButton = document.querySelector(".modal__accept");
	modalAcceptButton.addEventListener('click', function () {
		consentRequest.checked = true;
	});
	let modalRejectButton = document.querySelector(".modal__reject");
	modalRejectButton.addEventListener('click', function () {
		consentRequest.checked = false;
	})

</script>

<?/* <div data-bx-template="main-user-consent-request-loader" style="display: none;">
	<div class="main-user-consent-request-popup">
		<div class="main-user-consent-request-popup-cont">
			<div data-bx-head="" class="main-user-consent-request-popup-header"></div>
			<div class="main-user-consent-request-popup-body">
				<div data-bx-loader="" class="main-user-consent-request-loader">
					<svg class="main-user-consent-request-circular" viewBox="25 25 50 50">
						<circle class="main-user-consent-request-path" cx="50" cy="50" r="20" fill="none" stroke-width="1" stroke-miterlimit="10"></circle>
					</svg>
				</div>
				<div data-bx-content="" class="main-user-consent-request-popup-content">
					<div class="main-user-consent-request-popup-textarea-block">
						<div data-bx-textarea="" class="main-user-consent-request-popup-text"></div>
						<div data-bx-link="" style="display: none;" class="main-user-consent-request-popup-link">
							<div><?=Loc::getMessage('MAIN_USER_CONSENT_REQUEST_URL_CONFIRM')?></div>
							<div><a target="_blank"></a></div>
						</div>
					</div>
					<div class="main-user-consent-request-popup-buttons">
						<span data-bx-btn-accept="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-acc">Y</span>
						<span data-bx-btn-reject="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-rej">N</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
*/?>
<?/*
<pre> arParams

	<?print_r($arParams);?>
</pre>

<pre> arResult

	<?print_r($arResult);?>
</pre>
*/?>