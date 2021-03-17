<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="index-page-slider">
  <?foreach ($arResult["ITEMS"] as $item) {?>
	<div class="item" style="background: url('<?=$item['PREVIEW_PICTURE']['SRC']?>') center/cover;"><a href="<?=$item["PROPERTIES"]["LINK"]["VALUE"]?>"></a></div>
  <?}?>
</div>
