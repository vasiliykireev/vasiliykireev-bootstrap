<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?if (!empty($arResult)):?>
<ul class="list-group list-group-horizontal-lg border-0 mb-2 mb-lg-0">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel && $arItem["DEPTH_LEVEL"] <= $arParams["MAX_LEVEL"]):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if($arItem["IS_PARENT"]):?>

		<?if($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="navbar-menu__item navbar-menu__item_is-parent_true navbar-menu__item_depth-level_1 list-group-item btn-group border-0 p-0 m-1 me-lg-0 my-lg-0">
                <a
                class="navbar-menu__link list-item btn btn-dark focus-ring focus-ring-dark pe-2 border-end-0 <?if($arItem["SELECTED"]):?>active<?else:?>not-active<?endif?>"
                href="<?=$arItem["LINK"]?>"
                role="button">
                    <?=$arItem["TEXT"]?>
                </a><button type="button" class="btn btn-dark focus-ring focus-ring-dark border-start-0 dropdown-toggle dropdown-toggle-split <?if($arItem["SELECTED"]):?>active<?endif?>" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
				<ul class="navbar-menu__child navbar-menu__child_depth-level_1 dropdown-menu dropdown-menu-lg-end px-2">
		<?elseif($arItem["DEPTH_LEVEL"] <= $arParams["MAX_LEVEL"]):?>
			<li class="navbar-menu__item navbar-menu__item_is-parent_true navbar-menu__item_depth-level_else list-group-item border-0 p-0 m-1 me-0">
                <a
                class="navbar-menu__link dropdown-item list-item rounded <?if($arItem["SELECTED"]):?>active<?endif?>"
                href="<?=$arItem["LINK"]?>"
                role="button">
                    <?=$arItem["TEXT"]?>
                </a>
				<ul class="navbar-menu__child navbar-menu__child_depth-level_else list-group ms-3">
		<?endif?>

	<?else:?>

		<?if($arItem["PERMISSION"] > "D"):?>

			<?if($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="navbar-menu__item navbar-menu__item_is-parent_else navbar-menu__item_permission_d navbar-menu__item_depth-level_1 list-group-item border-0 p-0 m-1 me-lg-0 my-lg-0">
                    <a 
                    class="navbar-menu__link nav-item btn btn-dark focus-ring focus-ring-dark <?if($arItem["SELECTED"]):?>active<?else:?>not-active<?endif?>"
                    href="<?=$arItem["LINK"]?>"
                    role="button">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
			<?elseif($arItem["DEPTH_LEVEL"] <= $arParams["MAX_LEVEL"]):?>
				<li class="navbar-menu__item navbar-menu__item_is-parent_else navbar-menu__item_permission_d navbar-menu__item_depth-level_else list-group-item border-0 p-0 m-1 me-0">
                    <a
                    class="navbar-menu__link dropdown-item list-item rounded <?if($arItem["SELECTED"]):?>active<?endif?>"
                    href="<?=$arItem["LINK"]?>"
                    role="button">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
            
			<?endif?>

		<?else:?>

			<?if($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="navbar-menu__item navbar-menu__item_is-parent_else navbar-menu__item_permission_else navbar-menu__item_depth-level_1 list-group-item border-0 p-0 m-1 me-lg-0 my-lg-0">
                    <a
                    class="navbar-menu__link nav-item btn btn-dark focus-ring focus-ring-dark <?if ($arItem["SELECTED"]):?>active<?else:?>not-active<?endif?>"
                    href=""
                    title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"
                    >
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
			<?elseif($arItem["DEPTH_LEVEL"] <= $arParams["MAX_LEVEL"]):?>
				<li class="navbar-menu__item navbar-menu__item_is-parent_else navbar-menu__item_permission_else navbar-menu__item_depth-level_else list-group-item border-0 p-0 m-1 me-0">
                    <a
                    class="navbar-menu__link dropdown-item list-item rounded"
                    href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>