<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="popup-catalog">
	<a class="close"></a>
	<div class="catalog">
		<div class="logo">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/sunrise.png">
		</div>
		<div class="name">
			Каталог
		</div>
		<div class="item default">
			<div class="subs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:search.title",
					"new",
					Array(
						"CATEGORY_0" => array(0=>"iblock_catalog",),
						"CATEGORY_0_TITLE" => "",
						"CATEGORY_0_iblock_catalog" => array(0=>"6",),
						"CHECK_DATES" => "Y",
						"COMPONENT_TEMPLATE" => "new",
						"CONTAINER_ID" => "title-search",
						"INPUT_ID" => "title-search-input",
						"NUM_CATEGORIES" => "1",
						"ORDER" => "rank",
						"PAGE" => "#SITE_DIR#search/index.php",
						"SHOW_INPUT" => "Y",
						"SHOW_OTHERS" => "N",
						"TOP_COUNT" => "5",
						"USE_LANGUAGE_GUESS" => "Y"
					)
				);?>
				<div class="block-name">
					Каталог
				</div>
				<div class="list flex">
					<div class="col">
            <?$i = 0;?>
				    <?foreach ($arResult["MAIN_SECTIONS"] as $section) {?>
  						<nav>
  							<p><a href="<?=$section["SECTION_PAGE_URL"]?>"><?=$section["NAME"]?></a></p>
  						</nav>
              <?$i++;?>
              <?if($i == 4){?>
                </div>
      					<div class="col">
                <?$i = 0;?>
              <?}?>
            <?}?>
          <?if($i != 4){?>
					   </div>
          <?}?>
				</div>
			</div>
		</div>
    <?foreach ($arResult["MAIN_SECTIONS"] as $main_section) {?>
		<div class="item">
			<a class="link" href="<?=$main_section["SECTION_PAGE_URL"]?>"><img src="<?=$main_section["DETAIL_PICTURE"]["SRC"]?>"> <?=$main_section["NAME"]?></a>
			<div class="subs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:search.title",
					"new",
					Array(
						"CATEGORY_0" => array(0=>"iblock_catalog",),
						"CATEGORY_0_TITLE" => "",
						"CATEGORY_0_iblock_catalog" => array(0=>"6",),
						"CHECK_DATES" => "Y",
						"COMPONENT_TEMPLATE" => "new",
						"CONTAINER_ID" => "title-search",
						"INPUT_ID" => "title-search-input",
						"NUM_CATEGORIES" => "1",
						"ORDER" => "rank",
						"PAGE" => "#SITE_DIR#search/index.php",
						"SHOW_INPUT" => "Y",
						"SHOW_OTHERS" => "N",
						"TOP_COUNT" => "5",
						"USE_LANGUAGE_GUESS" => "Y"
					)
				);?>
				<div class="block-name">
					<?=$main_section["NAME"]?>
				</div>
				<div class="list flex">
					<div class="col">
            <?$i = 0;?>
            <?foreach ($main_section["SECTIONS"] as $section) {?>
  						<nav>
  							<p><a href="<?=$section["SECTION_PAGE_URL"]?>"><?=$section["NAME"]?></a></p>
  							<ul>
                  <?foreach ($section["CATEGORIES"] as $category) {?>
  								<li><a href="<?=$category["SECTION_PAGE_URL"]?>"><?=$category["NAME"]?></a></li>
  								<?/*<li><a href="<?=$section["SECTION_PAGE_URL"]?>filter/category-is-<?=$category?>/apply/"><?=$category?></a></li>*/?>
                    <?}?>
  							</ul>
  						</nav>
              <?$i++;?>
              <?if($i == 4){?>
                </div>
      					<div class="col">
                <?$i = 0;?>
              <?}?>
            <?}?>
          <?if($i != 4){?>
					   </div>
          <?}?>
				</div>
			</div>
		</div>
    <?}?>

		<div class="contacts">
			<div class="links">
				<a href="tel:+74872710505">+7 (4872) 71-05-05</a>
				<a href="#">г. Тула, ул. пр-т Ленина, д. 77 <i class="fa fa-angle-down"></i></a>
			</div>
		</div>
	</div>
</div>
