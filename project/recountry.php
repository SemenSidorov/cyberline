<?
die;
ini_set('memory_limit', '3000M');
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");
$el = new CIBlockElement;
$elemt_arr = [];

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$count = 0;

$reader = new XMLReader();
$reader->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.xml');
while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'offer') {

    $id = $reader->getAttribute('id');
    $prop = [];
    if(isset($elemt_arr[$id]) && !empty($elemt_arr[$id])){
      while($reader->read()) {

        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Colour') {
          $reader->read();
          $Colour = strtoupper(substr(trim($reader->value), 0, 1)) . mb_strtolower(substr(trim($reader->value), 1));
          $prop["COLOR"] = $Colour;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'LastCountry') {
          $reader->read();
          $Country = strtoupper(substr(trim($reader->value), 0, 1)) . mb_strtolower(substr(trim($reader->value), 1));
          $prop["COUNTRY"] = $Country;
        }

        if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
      }

      if($prop){
        $el->SetPropertyValuesEx($elemt_arr[$id], 6, $prop);
        $count++;
        echo $count . " - " . $elemt_arr[$id] . "\n";
      }
    }
  }
}
