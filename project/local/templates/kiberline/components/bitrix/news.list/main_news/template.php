<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="block-name">
	Новости
</div>
<div class="index-news">
  <?foreach ($arResult["ITEMS"] as $item) {?>
  	<div class="item">
  		<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="link"></a>
  		<a href="#"><img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"></a>
<div class="date_news"><img src="/local/templates/kiberline/img/calendar_news.png">
	<p><?=CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($item["DATE_CREATE"], CSite::GetDateFormat()))?></p>
      </div>
  		<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="name"><?=$item["NAME"]?></a>
  		<?=$item["PREVIEW_TEXT"]?>
  	</div>
  <?}?>
</div>
