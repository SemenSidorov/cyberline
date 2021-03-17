<?
ini_set('memory_limit', '990M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/include/pclzip.lib.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$bs = new CIBlockSection;
$el = new CIBlockElement;

$file = file_get_contents('http://www.netlab.ru/products/GoodsProperties.zip');
file_put_contents('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/GoodsProperties.zip', $file);

$zip = new ZipArchive;
if($zip->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/GoodsProperties.zip')){
  $zip->extractTo('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/');
  $zip->close();
}else{
  die;
}

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_P_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_P_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_P_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$count_el = 0;
$props_arr = [];
$reader = new XMLReader();
$reader->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/GoodsProperties.xml');
while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT) {
    if($reader->localName == 'property') {
      $id = $reader->getAttribute('id');
      $reader->read();
      $props_arr[$id] = $reader->value;
    }

    if($reader->localName == 'item') {
      $count_el++;
      $id = $reader->getAttribute('id');
      $arFields = [];
      while($reader->read()) {
        if($reader->nodeType == XMLReader::ELEMENT) {
          $name = $props_arr[$reader->name];
          $reader->read();
          $arFields["CHARACTERISTICS"][] = ["VALUE" => $reader->value, "DESCRIPTION" => $name];
        }
        if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'item')) break;
      }
      if($elemt_arr[$id]){
        $el->SetPropertyValuesEx($elemt_arr[$id], 6, $arFields);
        echo $count_el." - ".$elemt_arr[$id]."\n";
      }
    }
  }
}
