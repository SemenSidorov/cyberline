	</div>
	<div class="bottom-search-form">
		<div class="wrap">
			<div class="successSubscriptionForm"></div>
			<div class="errorSubscriptionForm"></div>
			<form class="flex" id="SubscriptionForm">
				<p>Получайте самые интересные предложения первыми!</p>
				<input type="text" class="emailSubscription">
				<input type="text" class="testSubscription">
				<input type="submit" value="Подписаться">
			</form>
		</div>
	</div>
	<footer class="footer">
		<a href="#top" class="totop"></a>
		<div class="wrap">
			<div class="flex">
				<div class="sunrise">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/sunrise.png">
				</div>
				<div class="dev">
					Разработка корпоративного сайта <br/>
					<a href="#">интернет-агентство BREVIS</a>
				</div>
			</div>
			<div class="line"></div>
			<div class="flex">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer_menu_one.php"
					)
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer_menu_two.php"
					)
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/footer_menu_three.php"
					)
				);?>
				<div class="contacts">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/footer_contacts.php"
						)
					);?>
					<div class="buttons">
						<a href="#" class="button button-callback"><span>Перезвоните мне</span></a>
						<a href="#" class="button button-question"><span>Задать вопрос</span></a>
					</div>
				</div>
			</div>
			<div class="line"></div>
			<div class="flex">
				<div class="copy">
					© Киберлайн, 2021
				</div>
				<div class="payment">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/payment.png">
				</div>
				<div class="politic">
					<a href="#">Политика обработки персональных данных</a>
				</div>
			</div>
		</div>
	</footer>
		<?$APPLICATION->IncludeComponent(
			"bitrix:form.result.new",
			"callback",
			Array(
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"CHAIN_ITEM_LINK" => "",
				"CHAIN_ITEM_TEXT" => "",
				"EDIT_URL" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"LIST_URL" => "",
				"SEF_MODE" => "N",
				"SUCCESS_URL" => "",
				"USE_EXTENDED_ERRORS" => "Y",
				"VARIABLE_ALIASES" => array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID",),
				"WEB_FORM_ID" => "1"
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:form.result.new",
			"question",
			Array(
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"CHAIN_ITEM_LINK" => "",
				"CHAIN_ITEM_TEXT" => "",
				"EDIT_URL" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"LIST_URL" => "",
				"SEF_MODE" => "N",
				"SUCCESS_URL" => "",
				"USE_EXTENDED_ERRORS" => "Y",
				"VARIABLE_ALIASES" => array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID",),
				"WEB_FORM_ID" => "2"
			)
		);?>
	<div class="popup user" style="display: none;">
		<div class="window">
			<a class="close"></a>
			<div class="name other">
				<a class="a1">Вход</a> / <a class="a2 active">Регистрация</a>
			</div>
			<div class="content c1 active">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.register",
				"new",
				Array(
					"AUTH" => "Y",
					"COMPONENT_TEMPLATE" => "templates",
					"REQUIRED_FIELDS" => array(0=>"EMAIL",1=>"NAME",),
					"SET_TITLE" => "N",
					"SHOW_FIELDS" => array(0=>"EMAIL",1=>"NAME",),
					"SUCCESS_PAGE" => "",
					"USER_PROPERTY" => array(),
					"USER_PROPERTY_NAME" => "",
					"USE_BACKURL" => "N"
				)
			);?>
			</div>
			<div class="content c2">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"new",
					Array(
						"FORGOT_PASSWORD_URL" => "/personal/forget.php",
						"PROFILE_URL" => "",
						"REGISTER_URL" => "",
						"SHOW_ERRORS" => "N"
					)
				);?>
			</div>
		</div>
	</div>
</body>
</html>
