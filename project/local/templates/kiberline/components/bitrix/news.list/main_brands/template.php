<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="block-name">
	Популярные бренды
</div>
<div class="index-brands">
  <?foreach ($arResult["ITEMS"] as $key => $item) {?>
    <?if($key % 2 !== 0) continue;?>
  	<div class="item">
  		<div class="image"><img src="<?=$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]?>"></div>
      <?if(isset($arResult["ITEMS"][$key+1]["PREVIEW_PICTURE"]["SRC"]) && !empty($arResult["ITEMS"][$key+1]["PREVIEW_PICTURE"]["SRC"])){?>
  		    <div class="image"><img src="<?=$arResult["ITEMS"][$key+1]["PREVIEW_PICTURE"]["SRC"]?>"></div>
      <?}?>
  	</div>
  <?}?>
</div>
