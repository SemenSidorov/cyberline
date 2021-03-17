<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="block-name">
	Новости
</div>
<div class="index-news">
  <?foreach ($arResult["ITEMS"] as $item) {?>
  	<div class="item">
  		<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="link"></a>
  		<a href="#"><img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"></a>
  		<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="name"><?=$item["NAME"]?></a>
  		<?=$item["PREVIEW_TEXT"]?>
  	</div>
  <?}?>
</div>
