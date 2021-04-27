<?
die;
ini_set('memory_limit', '990M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/include/pclzip.lib.php");
CModule::IncludeModule("iblock");
$el = new CIBlockElement;

$file = file_get_contents('http://www.netlab.ru/products/pricexml4.zip');
file_put_contents('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.zip', $file);

$zip = new ZipArchive;
if($zip->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.zip')){
  $zip->extractTo('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/');
  $zip->close();
}else{
  die;
}

$elemt_arr = [];

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$count_el = 0;
$reader = new XMLReader();
$reader->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.xml');
while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'offer') {
    $count_el++;
    $id = $reader->getAttribute('id');
    while($reader->read()) {

      if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'uid') {
        $reader->read();
        $newId = $reader->value;
      }

      if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
    }

    $el->SetPropertyValuesEx($elemt_arr[$id], 6, ["P_VENDOR_CODE" => $newId]);
    echo $count_el." - ".$id.", ".$newId.", ".$elemt_arr[$id]."\n";
  }
}
