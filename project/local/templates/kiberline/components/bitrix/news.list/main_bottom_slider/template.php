<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="flex">
	<div class="index-middle-slider">
    <?foreach ($arResult["ITEMS"] as $item) {?>
  	   <div class="item" style="background: url('<?=$item['PREVIEW_PICTURE']['SRC']?>') left center/cover;"><a href="<?=$item["PROPERTIES"]["LINK"]["VALUE"]?>"></a></div>
    <?}?>
  </div>
  <div class="all-actions-block">
    <a href="#">Все <br/>акции</a>
    <a href="#" class="link"></a>
  </div>
</div>
