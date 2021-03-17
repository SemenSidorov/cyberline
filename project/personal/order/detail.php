<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");?><div class="wrap lk">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"DISALLOW_CANCEL" => "N",
		"ID" => $ID,
		"PATH_TO_CANCEL" => "/personal/order/order_cancel.php?ID=#ID#",
		"PATH_TO_COPY" => "/personal/order/?COPY_ORDER=Y&ID=#ID#",
		"PATH_TO_LIST" => "/personal/order/",
		"PATH_TO_PAYMENT" => "",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "1",
		"PICTURE_WIDTH" => "110",
		"REFRESH_PRICES" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array(
			0 => "0",
		),
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>