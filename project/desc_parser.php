<?
ini_set('memory_limit', '990M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/cyberline.store/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/include/pclzip.lib.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$bs = new CIBlockSection;
$el = new CIBlockElement;
$ibp = new CIBlockProperty;

$file = file_get_contents('http://www.netlab.ru/products/GoodsProperties.zip');
file_put_contents('/home/h907190572/cyberline.store/docs/include/catalog_update/GoodsProperties.zip', $file);

$zip = new ZipArchive;
if($zip->open('/home/h907190572/cyberline.store/docs/include/catalog_update/GoodsProperties.zip')){
  $zip->extractTo('/home/h907190572/cyberline.store/docs/include/catalog_update/');
  $zip->close();
}else{
  die;
}

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_P_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_P_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_P_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$props = CIBlockProperty::GetList([], ["IBLOCK_ID" => 6]);
$ib_props = [];
while ($prop = $props->Fetch()) {
  $ib_props[$prop["CODE"]] = 1;
}

$count_el = 0;
$props_arr = [];
$reader = new XMLReader();
$reader->open('/home/h907190572/cyberline.store/docs/include/catalog_update/GoodsProperties.xml');
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
      $arProps = [];
      while($reader->read()) {
        if($reader->nodeType == XMLReader::ELEMENT) {
          $name = $props_arr[$reader->name];
          $reader->read();
          $arProps[] = ["VALUE" => $reader->value, "NAME" => strip_tags($name), "CODE" => CUtil::translit(trim(strip_tags($name)), "ru", ["change_case" => "U"])];
          //$arFields["CHARACTERISTICS"][] = ["VALUE" => $reader->value, "DESCRIPTION" => $name];
        }
        if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'item')) break;
      }
      if($elemt_arr[$id]){
        $arPropsAdd = [];
        foreach ($arProps as $prop) {
          if($ib_props[$prop["CODE"]] !== 1){
            $arFields = [
              "IBLOCK_ID" => 6,
              "NAME" => $prop["NAME"],
              "CODE" => $prop["CODE"],
              "PROPERTY_TYPE" => "S"
            ];
            $ib_props[$prop["CODE"]] = 1;
            echo $ibp->Add($arFields) . " - " . $prop["CODE"] . "\n";
          }
          $arPropsAdd[$prop["CODE"]] = $prop["VALUE"];
        }
        $el->SetPropertyValuesEx($elemt_arr[$id], 6, $arPropsAdd);
        echo $count_el." - ".$elemt_arr[$id]."\n";
      }
    }
  }
}
