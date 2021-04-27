<?
ini_set('memory_limit', '990M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$el = new CIBlockElement;

$prices_arr = [];

$prices = CPrice::GetList([], [], false, false, ["ID", "PRODUCT_ID", "PRICE"]);
while($price = $prices->Fetch())
{
  if($price["PRICE"] < 30){
    $prices_arr[] = [
      "ID" => $price["ID"],
      "PRICE" => $price["PRICE"],
      "PRODUCT_ID" => $price["PRODUCT_ID"]
    ];
  }
}

foreach ($prices_arr as $price) {
  $el->Update($price["PRODUCT_ID"], ["ACTIVE" => "N"]);
}
