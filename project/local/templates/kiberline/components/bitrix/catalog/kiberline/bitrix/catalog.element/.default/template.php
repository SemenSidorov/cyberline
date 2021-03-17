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
$this->setFrameMode(true);
?>
<?//print_r($arResult);?>
<div class="item-page">
	<?$GLOBALS['sectionsFilter'] = ["SECTION_ID" => $arResult["SECTION"]["IBLOCK_SECTION_ID"], "!ID" => $arResult["SECTION"]["ID"]];?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"header_element",
		Array(
			"ADD_SECTIONS_CHAIN" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPONENT_TEMPLATE" => "header_element",
			"COUNT_ELEMENTS" => "N",
			"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
			"FILTER_NAME" => "sectionsFilter",
			"IBLOCK_ID" => "6",
			"IBLOCK_TYPE" => "catalog",
			"SECTION_CODE" => "",
			"SECTION_FIELDS" => array(0=>"",1=>"",),
			"SECTION_ID" => "",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
			"TOP_DEPTH" => "2"
		)
	);?>
	<?unset($GLOBALS['sectionsFilter']);?>
	<div class="flex">
		<div class="photos">
			<div class="slider-for">
        <?foreach ($arResult["PROPERTIES"]["ADD_PICTURES"]["RESULT"] as $pic) {?>
				<div class="item"><a class="fancybox" rel="group" href="<?=$pic["SRC"]?>"><img src="<?=$pic["SRC"]?>"></a></div>
        <?}?>
			</div>
			<div class="slider-nav">
        <?foreach ($arResult["PROPERTIES"]["ADD_PICTURES"]["MIN_RESULT"] as $pic) {?>
				<div class="item"><img src="<?=$pic["src"]?>"></div>
        <?}?>
			</div>
		</div>
		<div class="info">
			<h1><?=$arResult["NAME"]?></h1>
			<div class="comments">
				<span>Код товара: <?=$arResult["PROPERTIES"]["VENDOR_CODE"]["VALUE"];?></span>
			</div>
			<div class="price">
				<!--<span class="old">12 990 ₽</span>-->
				<div class="new"><?=number_format($arResult["CATALOG_PRICE_1"], 2, ',', ' ')?> <i><?=$arResult["CATALOG_CURRENCY_1"] == "RUB" ? "₽" : $arResult["CATALOG_CURRENCY_1"]?></i></div>
			</div>
			<input type="button" class="cart-item" data-add="<?=$arResult["ID"]?>" value="В корзину">
			<div class="number">
				<span class="minus"></span>
				<input type="text" class="item-quantity" value="1"/>
				<span class="plus"></span>
			</div>
      <a class="fav add-favorite <?=$arResult["FAVORITE"] == "Y" ? "active" : ""?>" data-id="<?=$arResult["ID"]?>"></a>
		</div>
	</div>
	<div class="tabs">
		<ul class="tabNavigation">
			<li><a href="#t1">Описание</a></li>
			<?if(isset($arResult["PROPERTIES"]["CHARACTERISTICS"]["VALUE"][0]) && !empty($arResult["PROPERTIES"]["CHARACTERISTICS"]["VALUE"][0])){?><li><a href="#t2">Характеристики</a></li><?}?>
			<?if(isset($arResult["PROPERTIES"]["VIDEO"]["VALUE"]) && !empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])){?><li><a href="#t3">Видео</a></li><?}?>
		</ul>
    <?if(isset($arResult["PROPERTIES"]["CHARACTERISTICS"]["VALUE"][0]) && !empty($arResult["PROPERTIES"]["CHARACTERISTICS"]["VALUE"][0])){?>
		<div id="t2" class="tab-content">
      <div class="table">
				<table>
          <?foreach ($arResult["PROPERTIES"]["CHARACTERISTICS"]["~VALUE"] as $key => $value) {?>
					<?
						if($arResult["PROPERTIES"]["CHARACTERISTICS"]["~DESCRIPTION"][$key] == "Описание"){
							$desc_item = $value;
						}else{
					?>
					<tr>
						<td><?=htmlspecialcharsBack($arResult["PROPERTIES"]["CHARACTERISTICS"]["~DESCRIPTION"][$key])?></td>
						<td><?=$value?></td>
					</tr>
					<?}?>
          <?}?>
				</table>
			</div>
		</div>
    <?}?>
		<div id="t1" class="tab-content">
			<?=$arResult["DETAIL_TEXT"]?>
			<?=htmlspecialcharsBack($desc_item)?>
		</div>
    <?if(isset($arResult["PROPERTIES"]["VIDEO"]["VALUE"]) && !empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])){?>
		<div id="t3" class="tab-content">
      <?$APPLICATION->IncludeComponent(
      	"bitrix:player",
      	"",
      	Array(
      		"ADVANCED_MODE_SETTINGS" => "Y",
      		"AUTOSTART" => "N",
      		"AUTOSTART_ON_SCROLL" => "N",
      		"HEIGHT" => "300",
      		"MUTE" => "Y",
      		"PATH" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]["SRC"],
      		"PLAYBACK_RATE" => "1",
      		"PLAYER_ID" => "",
      		"PLAYER_TYPE" => "auto",
      		"PRELOAD" => "Y",
      		"PREVIEW" => "",
      		"REPEAT" => "none",
      		"SHOW_CONTROLS" => "Y",
      		"SIZE_TYPE" => "auto",
      		"SKIN" => "",
      		"SKIN_PATH" => "/bitrix/js/fileman/player/videojs/skins",
      		"START_TIME" => "0",
      		"TYPE" => "",
      		"USE_PLAYLIST" => "N",
      		"VOLUME" => "100",
      		"WIDTH" => "400"
      	)
      );?>
		</div>
    <?}?>
	</div>
  <?$GLOBALS["arrFilter"] = ["!ID" => $arResult["ID"]];?>
  <?$APPLICATION->IncludeComponent(
  	"bitrix:catalog.section",
  	"similar",
  	Array(
  		"ACTION_VARIABLE" => "action",
  		"ADD_PROPERTIES_TO_BASKET" => "Y",
  		"ADD_SECTIONS_CHAIN" => "N",
  		"ADD_TO_BASKET_ACTION" => "ADD",
  		"AJAX_MODE" => "N",
  		"AJAX_OPTION_ADDITIONAL" => "",
  		"AJAX_OPTION_HISTORY" => "N",
  		"AJAX_OPTION_JUMP" => "N",
  		"AJAX_OPTION_STYLE" => "Y",
  		"BACKGROUND_IMAGE" => "-",
  		"BASKET_URL" => "/personal/basket.php",
  		"BROWSER_TITLE" => "-",
  		"CACHE_FILTER" => "N",
  		"CACHE_GROUPS" => "Y",
  		"CACHE_TIME" => "36000000",
  		"CACHE_TYPE" => "A",
  		"COMPATIBLE_MODE" => "Y",
  		"CONVERT_CURRENCY" => "N",
  		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
  		"DETAIL_URL" => "",
  		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
  		"DISPLAY_BOTTOM_PAGER" => "N",
  		"DISPLAY_COMPARE" => "N",
  		"DISPLAY_TOP_PAGER" => "N",
  		"ELEMENT_SORT_FIELD" => "sort",
  		"ELEMENT_SORT_FIELD2" => "id",
  		"ELEMENT_SORT_ORDER" => "asc",
  		"ELEMENT_SORT_ORDER2" => "desc",
  		"ENLARGE_PRODUCT" => "STRICT",
  		"FILTER_NAME" => "arrFilter",
  		"HIDE_NOT_AVAILABLE" => "N",
  		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
  		"IBLOCK_ID" => "6",
  		"IBLOCK_TYPE" => "catalog",
  		"INCLUDE_SUBSECTIONS" => "Y",
  		"LAZY_LOAD" => "N",
  		"LINE_ELEMENT_COUNT" => "3",
  		"LOAD_ON_SCROLL" => "N",
  		"MESSAGE_404" => "",
  		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
  		"MESS_BTN_BUY" => "Купить",
  		"MESS_BTN_DETAIL" => "Подробнее",
  		"MESS_BTN_SUBSCRIBE" => "Подписаться",
  		"MESS_NOT_AVAILABLE" => "Нет в наличии",
  		"META_DESCRIPTION" => "-",
  		"META_KEYWORDS" => "-",
  		"OFFERS_LIMIT" => "5",
  		"PAGER_BASE_LINK_ENABLE" => "N",
  		"PAGER_DESC_NUMBERING" => "N",
  		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
  		"PAGER_SHOW_ALL" => "N",
  		"PAGER_SHOW_ALWAYS" => "N",
  		"PAGER_TEMPLATE" => ".default",
  		"PAGER_TITLE" => "Товары",
  		"PAGE_ELEMENT_COUNT" => "18",
  		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
  		"PRICE_CODE" => array(),
  		"PRICE_VAT_INCLUDE" => "Y",
  		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
  		"PRODUCT_ID_VARIABLE" => "id",
  		"PRODUCT_PROPS_VARIABLE" => "prop",
  		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
  		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
  		"PRODUCT_SUBSCRIPTION" => "Y",
  		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
  		"RCM_TYPE" => "personal",
  		"SECTION_CODE" => "",
  		"SECTION_CODE_PATH" => "",
  		"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
  		"SECTION_ID_VARIABLE" => "SECTION_ID",
  		"SECTION_URL" => "",
  		"SECTION_USER_FIELDS" => array("",""),
  		"SEF_MODE" => "N",
  		"SEF_RULE" => "",
  		"SET_BROWSER_TITLE" => "N",
  		"SET_LAST_MODIFIED" => "N",
  		"SET_META_DESCRIPTION" => "N",
  		"SET_META_KEYWORDS" => "N",
  		"SET_STATUS_404" => "N",
  		"SET_TITLE" => "N",
  		"SHOW_404" => "N",
  		"SHOW_ALL_WO_SECTION" => "Y",
  		"SHOW_CLOSE_POPUP" => "N",
  		"SHOW_DISCOUNT_PERCENT" => "N",
  		"SHOW_FROM_SECTION" => "N",
  		"SHOW_MAX_QUANTITY" => "N",
  		"SHOW_OLD_PRICE" => "N",
  		"SHOW_PRICE_COUNT" => "1",
  		"SHOW_SLIDER" => "Y",
  		"SLIDER_INTERVAL" => "3000",
  		"SLIDER_PROGRESS" => "N",
  		"TEMPLATE_THEME" => "blue",
  		"USE_ENHANCED_ECOMMERCE" => "N",
  		"USE_MAIN_ELEMENT_SECTION" => "N",
  		"USE_PRICE_COUNT" => "N",
  		"USE_PRODUCT_QUANTITY" => "N"
  	)
  );?>
</div>
<script>
	for(key in data_ids){
		console.log(data_ids[key]);
		$('.add-favorite[data-id="' + data_ids[key] + '"]').addClass('active');
	}
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".fancybox").fancybox();
  });
</script>
