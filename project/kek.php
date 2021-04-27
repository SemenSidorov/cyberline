<?die;
ini_set('memory_limit', '990M');
$_SERVER['DOCUMENT_ROOT'] = "/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");

$reader = new XMLReader();
$reader->open('Price.xml');
$element_count = 0;
$el = new CIBlockElement;

$sections_arr = $elemt_arr = [];

$sections = CIBlockSection::GetList([], ["IBLOCK_ID" => 6, "!UF_VENDOR_CODE" => false], false, ["UF_VENDOR_CODE"], false);
while($section = $sections->Fetch()){
  $sections_arr[$section["UF_VENDOR_CODE"]] = $section["ID"];
}

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_VENDOR_CODE_VALUE"]] = $element["ID"];
}

while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'offer') {
    $element_count++;
    if($element_count <= 182643) continue;
    $id = $reader->getAttribute('id');

    while($reader->read()) {
      if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'categoryId') {
        $reader->read();
        $sect_id = $reader->value;
        if(isset($sect_id) && !empty($sect_id)){
           $el->Update($elemt_arr[$id], ["IBLOCK_SECTION_ID" => $sections_arr[$sect_id]]);
        }
      }
      if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
    }
    echo $element_count." - ".$elemt_arr[$id]."\n";

  }
}
