<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<?//print_r($arResult["SEARCH"][0]);?>
<?if(!empty($arResult["SEARCH"])){?>
	<div class="index-catalog2">
		<div class="flex list">
		  <?foreach ($arResult["SEARCH"] as $key => $item) {?>
		    <div class="item">
		      <div class="image">
		        <a href="<?=$item["URL_WO_PARAMS"]?>"><img src="<?=$item["PICTURE"]["SRC"]?>"></a>
		      </div>
		      <a href="<?=$item["URL_WO_PARAMS"]?>" class="name"><?=$item["TITLE_FORMATED"]?></a>
		      <div class="flex">
		        <div class="price">
		          <?=number_format($item["PRICE"]["PRICE"], 2, ',', ' ')?> <span><?=$item["PRICE"]["CURRENCY"] == "RUB" ? "₽" : $item["PRICE"]["CURRENCY"]?></span>
		        </div>
		        <a data-add="<?=$item["ITEM_ID"]?>" class="cart"></a>
		      </div>
		    </div>
		  <?}?>
			<?=$arResult["NAV_STRING"]?><br>
			<dlv class="list2">
			  <?foreach ($arResult["SEARCH"] as $key => $item) {?>
			    <div class="item">
			      <div class="image">
			        <a href="<?=$item["URL_WO_PARAMS"]?>"><img src="<?=$item["PICTURE"]["SRC"]?>"></a>
			      </div>
			      <a href="<?=$item["URL_WO_PARAMS"]?>" class="name"><?=$item["TITLE_FORMATED"]?></a>
			      <div class="flex">
			        <div class="price">
			          <?=number_format($item["PRICE"]["PRICE"], 2, ',', ' ')?> <span><?=$item["PRICE"]["CURRENCY"] == "RUB" ? "₽" : $item["PRICE"]["CURRENCY"]?></span>
			        </div>
			        <a data-add="<?=$item["ITEM_ID"]?>" class="cart"></a>
			      </div>
			    </div>
			  <?}?>
				<?=$arResult["NAV_STRING"]?><br>
			</div>
		</div>
	</div>
<?}else{?>
	<div class="search-no-result">
		Извините, Ваш поиск не дал результатов!
	</div>
<?}?>
