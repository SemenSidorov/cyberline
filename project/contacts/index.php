<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь"); ?><div class="wrap">
	<div class="glav_contacts">
		<div class="contacts_block">
			<div>
 <img src="/local/templates/kiberline/img/contatcs_point.png" alt="">
			</div>
			<div>
 <span class="contacts_block_span">Адрес:</span><br>
				 г. Тула, ул. пр-т Ленина, д. 77,<br>
				 цокольный этаж (Центр бизнеса и торговли, вход со стороны двора)
			</div>
		</div>
		<div class="contacts_block">
			<div>
 <img src="/local/templates/kiberline/img/contacts_phone.png" alt="">
			</div>
			<div>
 <span class="contacts_block_span">Телефон:</span><br>
 <a itemprop="telephone" href="tel:+74872710505">+7 (4872) 71-05-05</a>
			</div>
		</div>
		<div class="contacts_block">
			<div>
 <img src="/local/templates/kiberline/img/contacts_email.png" alt="">
			</div>
			<div>
 <span class="contacts_block_span">E-mail:</span><br>
 <a href="mailto:info@kiberline.ru">info@kiberline.ru </a>
			</div>
		</div>
		<div class="contacts_block">
			<div>
 <img src="/local/templates/kiberline/img/contacts_clock.png" alt="">
			</div>
			<div>
				 Режим работы: <br>
				 Пн-Сб с 10.00 до 19.00<br>
				 Вс с 10.00 до 17.00
			</div>
		</div>
	</div>
</div>
<p class="scheme_map_contacts">
	 Схема проезда
</p>
<div class="slide_pages-map" style="width: auto; height: 400px" id="slide_pages-map">
</div>
      	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=89467f71-02c1-496d-ad22-a859427c30ea" type="text/javascript"></script>
        <script>
          ymaps.ready(function () {
        	var myMap = new ymaps.Map('slide_pages-map', {
        			center: [54.179893, 37.603891],
        			zoom: 16
        		});
      		var myPlacemark = new ymaps.Placemark([54.179893, 37.603891], {
      				balloonContentHeader: "Киберлайн",
              hintContent: 'г. Тула, ул. пр-т Ленина, д. 77',
balloonContentBody: "<p>г. Тула, ул. пр-т Ленина, д. 77</p>"
      				
      			}, {
      				iconLayout: 'default#image',
      				iconImageHref: '<?=SITE_TEMPLATE_PATH?>/img/been-here-marker.png',
      				iconImageSize: [50, 56],
      				iconImageOffset: [-5, -38],
              preset: 'islands#blueDotIconWithCaption'
            });
      			myMap.geoObjects.add(myPlacemark);
          });
        </script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>