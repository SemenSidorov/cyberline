<?/*require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
			<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	".default", 
	array(
		"AUTH" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"SET_TITLE" => "N",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");*/?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">  
	<title>Скрипт проверки пользователя в сообществе ВКонтакте | PHP</title>
	<link type="text/css" rel="stylesheet" href="css/demo.css"> 
</head>
<body> 

<div id="content">

<?php
$community = 30444828;
$profile = 7673899;
$answer = json_decode(file_get_contents("http://api.vk.com/method/groups.isMember?gid=".$community."&uid=".$profile));
print_r($answer);
if($answer->response == 1){  
	echo"Мой аккаунт <a href='http://vk.com/id".$profile."' target='_blank'>".$profile."</a> и я уже подписан на новости сообщества!";
}
else{?>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
	<div id="vk_groups"></div>
	<script type="text/javascript">
	VK.Widgets.Group("vk_groups", {mode: 0, width: "800", height: "400", color1: 'FFFFFF', color2: '428BCA', color3: '428BCA'}, 30444828);
	</script>
<?}
?>
	
</div>	

</body>
</html>
