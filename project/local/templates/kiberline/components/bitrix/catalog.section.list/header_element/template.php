<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<nav class="menu">
  <?foreach ($arResult["SECTIONS"] as $item) {?>
    <a href="<?=$item["SECTION_PAGE_URL"]?>"><?=$item["NAME"]?></a>
  <?}?>
</nav>
