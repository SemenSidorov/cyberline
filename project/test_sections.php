<?
die;
ini_set('memory_limit', '3000M');
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/price_config.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$bs = new CIBlockSection;
$el = new CIBlockElement;

$count_elements = 0;
foreach ($ar_extra_charge as $parentSect) {
  $elements = CIBlockElement::GetList(["ID" => "ASC"], ["SECTION_ID" => $parentSect["ID"], "INCLUDE_SUBSECTIONS" => "Y"], false, false, ["ID"]);
  while($elem = $elements->Fetch()){
    $count_elements++;
    if($count_elements <= 100179) continue;
    $price = CPrice::GetList([], ["PRODUCT_ID" => $elem["ID"]], false, false, ["ID", "PRICE"]);
    $price = $price->Fetch();
    $price_count = $price["PRICE"] + $price["PRICE"]/100*$parentSect["PERCENT"];
    if(fmod($price_count, 1)){
      $price_count = $price_count - fmod($price_count, 1) + 1;
    }

    CPrice::Update($price["ID"], ["PRICE" => $price_count], false);
    echo $parentSect["ID"] . " - " . $elem["ID"] . " - " . $count_elements . "\n";
  }
}
