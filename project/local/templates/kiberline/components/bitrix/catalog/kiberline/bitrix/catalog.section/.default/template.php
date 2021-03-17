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
<div class="flex lst">
  <?foreach ($arResult["ITEMS"] as $key => $item) {?>
    <div class="item">
      <div class="badges">
        <?if($item["PROPERTIES"]["HIT"]["VALUE"] == "Y"){?>
              <img src="<?=SITE_TEMPLATE_PATH?>/img/badge1.png">
        <?}?>
        <?if($item["PROPERTIES"]["STOCK"]["VALUE"] == "Y"){?>
              <img src="<?=SITE_TEMPLATE_PATH?>/img/badge2.png">
        <?}?>
        <?if($item["PROPERTIES"]["NEW"]["VALUE"] == "Y"){?>
              <img src="<?=SITE_TEMPLATE_PATH?>/img/badge3.png">
        <?}?>
      </div>
      <a class="fav add-favorite <?=$item["FAVORITE"] == "Y" ? "active" : ""?>" data-id="<?=$item["ID"]?>"></a>
      <div class="image">
        <a href="<?=$item["DETAIL_PAGE_URL"]?>"><img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"></a>
      </div>
      <a href="<?=$item["DETAIL_PAGE_URL"]?>" class="name"><?=$item["NAME"]?></a>
      <div class="flex">
        <div class="price">
          <?=number_format($item["CATALOG_PRICE_1"], 2, ',', ' ')?> <span><?=$item["CATALOG_CURRENCY_1"] == "RUB" ? "₽" : $item["CATALOG_CURRENCY_1"]?></span>
        </div>
        <a data-add="<?=$item["ID"]?>" class="cart"></a>
      </div>
    </div>
  <?}?>
  <script>
    $('#name-count-section').html("<?=$arResult["NAME"]?> <span>" + COUNT_ELEMENT_IN_SECTION + " товаров<span>");
  </script>
  <script>
    for(key in data_ids){
      console.log(data_ids[key]);
      $('.add-favorite[data-id="' + data_ids[key] + '"]').addClass('active');
    }
  </script>
</div>
<?=$arResult["NAV_STRING"]?><br>
