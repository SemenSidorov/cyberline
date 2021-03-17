<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?if($arResult["ITEMS"]){?>
  <div class="block-name">
    Похожие товары
  </div>
  <div class="products-slider">
    <?foreach ($arResult["ITEMS"] as $item) {?>
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
            <?=number_format($item["PRICE"]["PRICE"], 2, ',', ' ')?> <span><?=$item["PRICE"]["CURRENCY"] == "RUB" ? "₽" : $item["PRICE"]["CURRENCY"]?></span>
          </div>
          <a data-add="<?=$item["ID"]?>" class="cart"></a>
        </div>
      </div>
    <?}?>
  </div>
<?}?>
<script>
  for(key in data_ids){
    console.log(data_ids[key]);
    $('.add-favorite[data-id="' + data_ids[key] + '"]').addClass('active');
  }
</script>
