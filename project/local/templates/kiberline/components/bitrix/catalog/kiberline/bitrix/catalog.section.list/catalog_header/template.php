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
<div class="catalog">
  <?foreach ($arResult["SECTIONS"] as $item) {?>
  	<div class="item">
  		<a href="<?=$item["SECTION_PAGE_URL"]?>" class="link"></a>
  		<div class="image">
  			<img src="<?=$item["PICTURE"]["src"]?$item["PICTURE"]["src"]:$item["PICTURE"]["SRC"]?>">
  		</div>
  		<a href="<?=$item["SECTION_PAGE_URL"]?>"><span><?=$item["NAME"]?></span></a>
  	</div>
  <?}?>
</div>
