<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$GLOBALS['APPLICATION']->RestartBuffer();
echo  file_get_contents( "/home/h907190572/cyberline.store/errordocs/404.html");
