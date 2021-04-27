<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="block-name">
	Каталог товаров
</div>
<div class="index-catalog2">
	<!--nav class="menu">
		<ul>
			<li><a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/tab1.png"> Хиты продаж</a></li>
			<li><a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/tab2.png"> Товары по акции</a></li>
			<li><a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/tab3.png"> Новинки</a></li>
		</ul>
		<select>
			<option>Хиты продаж</option>
			<option>Товары по акции</option>
			<option>Новинки</option>
		</select>
	</nav-->
	<div class="flex list">
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

	<dlv class="list2">
    <?foreach ($arResult["ITEMS"] as $item) {?>
  		<div class="item">
  			<div class="badges">
          <?if($item["PROPERTIES"]["HIT"]["VALUE"] == "Y"){?>
  				      <img src="<?=SITE_TEMPLATE_PATH?>/img/badge1.png">
          <?}?>
  				<!--<img src="<?=SITE_TEMPLATE_PATH?>/img/badge2.png">-->
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
	</dlv>
	<a href="/catalog/" class="bottom-link">Смотреть весь каталог</a>
</div>

<script>
	for(key in data_ids){
		console.log(data_ids[key]);
		$('.add-favorite[data-id="' + data_ids[key] + '"]').addClass('active');
	}
</script>
