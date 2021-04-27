<?die;
ini_set('memory_limit', '3000M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");

$elel = new CIBlockElement;
$elements = CIBlockElement::GetList(["ID" => "asc"], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'NAME', 'PROPERTY_VENDOR_CODE']);

$count_el = 0;
while($el = $elements->Fetch()){
  $count_el++;
  if($count_el <= 184173) continue;
  $name = $el["NAME"];
  $namearr = explode('[', $name);
  $newName = '';
  foreach ($namearr as $value) {
    $newName .= preg_replace('/.*\]/', '', $value);
  }
  $name = $newName;
  $namearr = explode('{', $name);
  $newName = '';
  foreach ($namearr as $value) {
    $newName .= preg_replace('/.*\}/', '', $value);
  }
  $newName = trim(preg_replace('/\s+/', ' ', $newName));
  $elel->Update($el["ID"], ["NAME" => $newName, "CODE" => Cutil::translit($newName, "ru", [])."-".$el["PROPERTY_VENDOR_CODE_VALUE"]]);
  echo $el["ID"]." - ".$count_el."\n";
}
