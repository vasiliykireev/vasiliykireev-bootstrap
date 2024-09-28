<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true); ?>

<?require_once(__DIR__ . '/example.php');
//echo example();
?>

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
/* Выводим элементы в arResult */
// if(isset($arResult["SECTIONS"])){
// 	foreach($arResult["SECTIONS"] as $arSection){
// $arFilter = Array(
//     'SECTION_ID' => $arSection["ID"],
// ); 
// $arSelect = array();
// $arItems = CIBlockElement::GetList( // CIBlockElement — элемент!
//      Array("SORT"=>"ASC"),
//      $arFilter,
//      false,
//      $arSelect
// );
// while ($arItem = $arItems->GetNext()) {
// 	    echo "<pre>";
// 		echo "arItem ";
// 	    print_r($arItem);
// 		echo "</pre>";
// }
// }
// }
?>
<?
if(isset($arResult["SECTIONS"])):?>
	<?foreach($arResult["SECTIONS"] as $arSection):?>
        <div class="section">
		    <div class="fw-bold"><?=$arSection["NAME"]?></div>
			<?if(isset($arSection["ITEMS"])):?>
				<?foreach($arSection["ITEMS"] as $arItem):?>
					<div class="ps-3"><?=$arItem["NAME"]?></div>
				<?endforeach;?>
			<?endif?>
	    </div>
	<?endforeach;?>
<?endif
?>

<?/*foreach($arResult["SECTIONS"] as $arSection):?>
		<?if($arSection["DEPTH_LEVEL"]>$depthLevel){
			$depthLevel = $arSection["DEPTH_LEVEL"];
		}?>
<?endforeach?>
<div>Максимальный уровень вложенности: <?=$depthLevel?></div>
<?if(isset($arResult["SECTIONS"])):?>
	<?foreach($arResult["SECTIONS"] as $arSection):?>
        <div class="py-2">
			<div class="fw-bold"><?=$arSection["NAME"]?></div>
			<div>Уровень вроженности: <?=$arSection["DEPTH_LEVEL"]?></div>
		    <?foreach($arResult["ITEMS"] as $arItem):?>
		    	<?if($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]):?>
		    		<div class="ps-5 is-list-created-<?=$isListCreated?>"><?=$arItem["NAME"]?></div>
		    	<?endif?>
		    <?endforeach?>
		</div>
	<?endforeach;?>
<?endif*/?>

<?/*if(isset($arResult["SECTIONS"])):?>
	<div class="top-lever">
	<? $depthLevel = 0?>
	<?foreach($arResult["SECTIONS"] as $arSection):?>
		<?if($arSection["DEPTH_LEVEL"]>$depthLevel){
			$depthLevel = $arSection["DEPTH_LEVEL"];
		}?>
	<?endforeach?>
	<?="Максимальный уровень вложенности: ".$depthLevel?>
    <? $depthLevelBefore = $depthLevel?>
	<?foreach($arResult["SECTIONS"] as $arSection):?>
		<?if($depthLevelBefore<$depthLevel):?>
			<ul>
		<?endif?>
		<?if($arSection["DEPTH_LEVEL"] <= $depthLevel):?>
                <li class="section-level"><?="Раздел: ".$arSection["NAME"]." / Уровень: ".$depthLevel-$arSection["DEPTH_LEVEL"]?>
				    <?$isListCreated = false;?>
				    <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?//=$arItem["IBLOCK_SECTION_ID"]."/".$arSection["ID"]?>
						<?if($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]):?>
							<?if($isListCreated == false):?>
						        <ul class="is-list-created-<?=$isListCreated?>">
								<?$isListCreated = true;?>
							<?endif?>
							<li class="is-list-created-<?=$isListCreated?>"><?=$arItem["NAME"]?></li>
						<?endif?>
					<?endforeach?>
					<?if($isListCreated == true):?>
						        </ul><!-- end section level -->
					<?endif?>
			<?endif?>
			<?if($depthLevelBefore == $depthLevel):?>
			</ul><!-- end depth level -->
		    <?endif?>
		<? $depthLevelBefore = $depthLevel-$arSection["DEPTH_LEVEL"]?>
		<?="Уровень до: ".$depthLevelBefore?>
	<?endforeach;?>
			</div>
<?endif*/?>

	<? /*
    <ul>
        <?foreach($arResult["SECTIONS"] as $arSection):?>
			<?if($arSection["DEPTH_LEVEL"] == 1):?>
                <li><?=$arSection["NAME"]?>
			<?endif?>
			<?if($arSection["DEPTH_LEVEL"] > 1):?>
				<ul><li><?=$arSection["NAME"]?>
			<?endif?>
    			<?if(isset($arResult["ITEMS"])):?>
    				<?$isListCreated = false?>
    			    <?foreach($arResult["ITEMS"] as $arItem):?>
    			    	<?if($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]):?>
    						<?if($isListCreated == false):?>
    					<ul>
    						<?endif?>
                            <li><?=$arItem["NAME"]?></li>
    						<?$isListCreated = true;?>
    			    	<?endif?>
    			    <?endforeach?>
    			    <?if($isListCreated == true):?>
    				    </ul>
    				<?endif?>
    			<?endif?>
				<?if($arSection["DEPTH_LEVEL"] > 1):?>
				</ul>
			    <?endif?>
				<?if($arSection["DEPTH_LEVEL"] == 1):?>
                </li>
			    <?endif?>
        <?endforeach;?>
    </ul>
<?endif */?>

<pre>$arParams:
<?//print_r($arParams);?>
</pre>
<pre>$arResult:
<?print_r($arResult);?>
</pre>
<?/*
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
*/ ?>