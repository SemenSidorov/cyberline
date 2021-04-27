<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Интернет-маркетинговое агентство BREVIS | www.brevis-site.ru" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


	<meta name="yandex-verification" content="131cc8fd679c2fe3" />

  <?$APPLICATION->ShowHead();?>

  <title><?$APPLICATION->ShowTitle()?></title>

  <!-- Styles -->
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css", true);?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css", true);?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.min.css", true);?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery-ui.min.css", true);?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.fancybox.min.css", true);?>

  <!-- Scripts -->
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-3.2.1.min.js');?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/slick.min.js');?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/common.js');?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-ui.min.js');?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.min.js');?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js');?>

	<?
	$GLOBALS['USER'];
		if(!$USER->IsAuthorized()){
			echo '<script>var user_auth = false</script>';
		}else{
			echo '<script>var user_auth = true</script>';
		}
	?>

</head>
<body id="top">
<?$APPLICATION->ShowPanel()?>
	<div class="menubg"></div>
	<?$APPLICATION->IncludeComponent(
		"kiberline:catalog.menu",
		"",
		Array(
			"IBLOCK_ID" => 6
		)
	);?>
	<header class="header">
		<div class="wrap flex">
			<div class="logo">
				<a href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png"></a>
			</div>
			<div class="menu-button"></div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"new",
				Array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(0=>"",),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "top",
					"USE_EXT" => "N"
				)
			);?>
			<div class="header_contacts">
				<div class="adress">
					г. Тула, <span>ул. пр-т Ленина, д. 77</span>
				</div>
				<div class="adress">
					Пн-Сб с 10.00 до 19.00<br>
					Вс с 10.00 до 17.00
				</div>
			</div>
			<div class="links">
				<a class="button-user-login" <?=$USER->IsAuthorized() ? 'href="/personal/"' : ''?>></a>
				<a class="favorites-header" href="/favorites/">
					<?
					global $USER;

					if($USER->IsAuthorized()){
					  $data = CUser::GetList(($by="ID"), ($order="ASC"), array('ID' => $USER->GetID()), array("SELECT" => array("UF_FAVORITES")));
					  $data = $data->Fetch();
						$count_favorites = count(json_decode($data["UF_FAVORITES"]));
					}else{
						$count_favorites = count(json_decode($_COOKIE["UF_FAVORITES"]));
					}
					?>
					<span><?=$count_favorites?></span>
				</a>
				<a class="cart-header" href="/personal/basket.php">
					<?
					CModule::IncludeModule('sale');
					$data = CSaleBasket::GetList([], ["FUSER_ID" => CSaleBasket::GetBasketUserID(), "ORDER_ID" => false], false, false, []);
					$count_basket = 0;
					while($d = $data->Fetch()){
						$count_basket++;
					}
					?>
					<span><?=$count_basket?></span>
				</a>
			</div>
			<!-- <div class="social">
				<a href="#"></a>
				<a href="#"></a>
				<a href="#"></a>
			</div> -->
			<a class="search-link"></a>
		</div>
	</header>
	<div class="top-catalog-line">
		<div class="wrap flex">
			<div class="catalog-button">
				<span><i></i> Каталог товаров</span>
			</div>
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
			<a href="tel:+74872710505" class="phone">+7 (4872) 71-05-05</a>
		</div>
	</div>
  <?if($APPLICATION->GetCurPage() !== '/'){?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"new",
			Array(
				"PATH" => "",
				"SITE_ID" => "s1",
				"START_FROM" => "0"
			)
		);?>
  <?}?>
	<div class="wrap">
		<?if(strpos($APPLICATION->GetCurPage(), '/catalog/') === false && $APPLICATION->GetCurPage() != '/'){?>
		<div class="block-name"><?=$APPLICATION->ShowTitle()?></div>
		<?}?>
