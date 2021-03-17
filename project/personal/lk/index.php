<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");?>
<div class="wrap lk">
	<div class="buttons">
		<button id="lk-order">Текущий заказ</button>
		<button id="lk-history-orders">История заказов</button>
		<button id="lk-info">Информация</button>
	</div>
	<div class="lk-order">

	</div>
	<div class="lk-history-orders">

	</div>
	<div data-id="info">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.profile",
			"",
			Array(
				"CHECK_RIGHTS" => "N",
				"SEND_INFO" => "N",
				"SET_TITLE" => "Y",
				"USER_PROPERTY" => array(),
				"USER_PROPERTY_NAME" => ""
			)
		);?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
